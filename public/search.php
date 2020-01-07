<?php

//I am thinking of transfering this file to view/pages but then the crawl_page function might not work correctly anymore
//Things I consider improving: -> Hide the pages that are being loaded instead of placing a white background over them
//GET->request to POST->request is not really fancy, don't know a better way but would like to implement something else if possible


//code from: https://stackoverflow.com/questions/2313107/how-do-i-make-a-simple-crawler-in-php by "hobodave"

if (!isset($crawler))
{$crawler = new Crawler();}
$pages = array();
$dom = new DOMDocument('1.0');
echo "<section style='padding:100%; background-color: white;'></section>"; //<- make everything white so costumer does not see the pages being load (sloppy, but effective)
echo "<section id=historic>";
$page = "historic";
echo "<section id=historic_crawler>"; //I add a section crawler to more easily get specific content later
$crawler->crawl_page("http://localhost/haarlemfestival/$page", 2);
echo "</section>";
echo "<section id=food_crawler>";
$page = "food";
$crawler->crawl_page("http://localhost/haarlemfestival/$page", 2);
echo "</section>";
echo "<section id=dance_crawler>";
$page = "dance";
$crawler->crawl_page("http://localhost/haarlemfestival/$page", 2);
echo "</section>";
$query = $_GET['q'];


class Crawler
{
    function crawl_page($url, $depth = 5) //this function crawls through the pages of the event(s) you requested
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
    if (strpos($url, $page)) //I added this so it will only echo pages that are part of your requested page (otherwise it will index more than needed)
    {echo "URL:",$url,PHP_EOL,"CONTENT:",PHP_EOL,$dom->saveHTML(),PHP_EOL,PHP_EOL;}
}
}

//important to note: this function should be able to load dynamic pages. Just make sure your database connection works.
//if for some reason your dynamic pages fail to load, errors will be taken into the query
//currently,, only text in the elements with a tag <p> will be included. Please put all important event data in here!

?>

<script src="../haarlemfestival/js/crawler.js"></script>
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