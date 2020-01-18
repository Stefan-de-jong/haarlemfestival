<?php

//code partly from: https://stackoverflow.com/questions/2313107/how-do-i-make-a-simple-crawler-in-php by "hobodave"

if (!isset($crawler))
{$crawler = new Crawler();}
$pages = array();
$dom = new DOMDocument('1.0');
echo "<section id=historic style='opacity:0;'>";
$page = "historic";
echo "<section id=historic_crawler style='opacity:0;'>"; //add a section crawler to more easily get specific content later
$crawler->crawl_page("http://hfa4.infhaarlem.nl/$page", 3);
echo "</section>";
echo "<section id=food_crawler style='opacity:0;'>";
$page = "food";
$crawler->crawl_page("http://hfa4.infhaarlem.nl/$page", 1);
echo "</section>";
echo "<section id=dance_crawler style='opacity:0;'>";
$page = "dance";
$crawler->crawl_page("http://hfa4.infhaarlem.nl/$page", 1);
echo "</section>";
$query = $_GET['q'];

class Crawler
{
    function crawl_page($url, $depth) //this function crawls throught all the pages with $page in their name, if there are links of them at the requested URL
    {
    static $seen = array();
    if (isset($seen[$url]) || $depth === 0) {
        return;
    }

    $seen[$url] = true;

    $dom = new DOMDocument('1.0'); //make new dom document
    @$dom->loadHTMLFile($url); //load html file url

    $anchors = $dom->getElementsByTagName('a'); //get all tags from the loaded dom file with <a> (links)
    foreach ($anchors as $element) { //foreach anchors, aka for each link found on the webpage...
        {
        $href = $element->getAttribute('href'); //get the attribute of the link(href)
        if (0 !== strpos($href, 'http')) {
            $path = '/' . ltrim($href, '/'); //if $href is not http
            if (extension_loaded('http')) { //check if extension is loaded
                $href = http_build_url($url, array('path' => $path)); //if extension is loaded, build the href url
            } else { //in the case the website it not a http website, like localhost, then...
                $parts = parse_url($url); //get parts of the url
                $href = $parts['scheme'] . '://'; //get the href
                if (isset($parts['user']) && isset($parts['pass'])) { //if $parts['user'] and $parts['pass'] are set...
                    $href .= $parts['user'] . ':' . $parts['pass'] . '@'; //add them to the href
                }
                $href .= $parts['host']; //add the host to the href
                if (isset($parts['port'])) { //if the port is set
                    $href .= ':' . $parts['port']; //add the port to the href
                }
                $href .= dirname($parts['path'], 1).$path; //add the directory name
            }
        }
        $this->crawl_page($href, $depth - 1);
    }
    }
    global $page;
    if (strpos($url, $page)) //added this so it will only echo pages that are part of your requested page (otherwise it makes it hard to seperate pages into categories)
    {echo "URL:",$url,PHP_EOL,"CONTENT:",PHP_EOL,$dom->saveHTML(),PHP_EOL,PHP_EOL;}
}
}

?>

<script src="../public/js/crawler.js"></script>
<script src="../public/js/jquery.min.js"></script>
<script>
var q = '<?php echo $query; ?>'; //get the requested query
var historic = document.getElementById('historic_crawler'); //get the correct webpage
var food  = document.getElementById('food_crawler');
var dance = document.getElementById('dance_crawler');
var texthistoric = historic.getElementsByTagName('p'); //get element p, which we assume have the text we want to search through
var textfood =  food.getElementsByTagName('p');
var textdance = dance.getElementsByTagName('h4');
var listhistoric = ""; //create an empty array
var listfood = "";
var listdance = "";
for (var i = 0; i < texthistoric.length; i++) //getElementsByTagName returns an array which we can loop through 
{
listhistoric += texthistoric[i].innerText; //fill the array
}
for (var i = 0; i < textfood.length; i++)
{
listfood += textfood[i].innerText;
}
for (var i = 0; i < textdance.length; i++)
{
listdance += textdance[i].innerText;
}
$('body').empty(); //clear the body
var response = executeAjax(listhistoric, listfood, listdance, q); //send data with ajax, wait for a response from the search page
$('body').append(response); //add the data received from the search page to our current page
</script>