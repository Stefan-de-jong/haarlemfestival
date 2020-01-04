<?php
//uitleg variabelen: $string is de string die je wilt doorzoeken met $query, de $page is de pagina waar je klanten heen wilt sturen als er zoekresultaten gevonden zijn
require_once APPROOT . '/views/inc/header.php';
if (!isset($search))
{
$search = new search();
}
if (!isset($url))
{
$url = URLROOT;
}
if (isset($_GET['q']))
{
$query = $_GET['q'];
}
echo
"<section style='margin-left: 40%;'>
<form action='";
if(isset($query))
{
echo $url . '/pages/search/' . $query;
}
echo
 "'>Search the website!<br>
<input type='text' name='q' value='' placeholder='Search'><br>
<input type='submit' value='Submit'>
</form><br>";
//historic begint hier
$string = 'Haarlem is a city and municipality in the Netherlands. It is the capital of the province of North Holland and is situated at the northern edge of the Randstad, one of the most populated metropolitan areas in Europe.
Haarlem has a rich history dating back to pre-medieval times. Haarlem became wealthy with toll revenues that it collected from ships and travellers moving on the busy North-South route. However, as shipping became increasingly 
important economically, the city of Amsterdam became the main Dutch city of North Holland during the Dutch Golden Age. The town of Halfweg became a suburb, and Haarlem became a quiet bedroom community, and for this reason Haarlem 
still has many of its central medieval buildings intact. Nowadays many of them are on the Dutch Heritage register known as Rijksmonuments.
The city is located on the river Spaarne, giving it its nickname "Spaarnestad" (Spaarne city). It is situated about 20 km (12 mi) west of Amsterdam and near the coastal dunes. Haarlem has been the historical centre of the tulip 
bulb-growing district for centuries and bears its other nickname "Bloemenstad" (flower city) for this reason.
Beer brewing has been a very important industry for Haarlem going back to the 15th century, when there were no fewer than 100 breweries in the city. When the towns 750th anniversary was celebrated in 1995 a group of enthusiasts 
re-created an original Haarlem beer and brewed it again. The beer is called Jopenbier, or Jopen for short, named after an old type of beer barrel.
In 1658, Peter Stuyvesant, the Director-General of the Dutch colony of Nieuw Nederland (New Netherland), founded the settlement of Nieuw Haarlem in the northern part of Manhattan Island as an outpost of Nieuw Amsterdam (New Amsterdam) 
at the southern tip of the island.
After the English capture of New Netherland in 1664, the new English colonial administration renamed both the colony and its principal city "New York," but left the name of Haarlem more or less unchanged. The spelling changed to Harlem 
in keeping with contemporary English usage, and the district grew (as part of the borough of Manhattan) into the vibrant centre of African American culture in New York City and the United States generally by the 20th century.';
$page = "historic/about";
if(isset($query) && $query = ""){$search->executeQuery($string, $page, $query);}
$string = 'Post your own pictures on Instagram, along with #HaarlemHistoric #HaarlemFestival and a hashtag corresponding to your location, and you might win a dinner for two at one of our partner restaurants!';
$page = "historic";
//food begint hier
if(isset($query) && $query = ""){$search->executeQuery($string, $page, $query);}
$page = "food/info/1";
$string = "Mr & Mrs is a 4 star Dutch, fish and seafood, European restaurant.";
if(isset($query) && $query = ""){$search->executeQuery($string, $page, $query);}
$page = "food/info/2";
$string = "Ratatouille is a 4 star French, fish and seafood, European restaurant. Reservations are mandatory.";
if(isset($query) && $query = ""){$search->executeQuery($string, $page, $query);}
$page = "food/info/3";
$string = "Fris is a 4 star Dutch, French, European restaurant.";
if(isset($query) && $query = ""){$search->executeQuery($string, $page, $query);}
$page = "food/info/4";
$string = "Specktakel is a 3 star Europees, Internationaal, Aziatisch restaurant.";
if(isset($query) && $query = ""){$search->executeQuery($string, $page, $query);}
$page = "food/info/5";
$string = "Grand cafe Brinkman is a 3 star Dutch, European, Modern restaurant.";
if(isset($query) && $query = ""){$search->executeQuery($string, $page, $query);}
$page = "food/info/6";
$string = "Urban frenchy bistro toujours is a 3 star Dutch, fish and seafood, European restaurant.";
if(isset($query) && $query = ""){$search->executeQuery($string, $page, $query);}
$page = "food/info/7";
$string = "The golden bull is a 3 star Steakhouse, Argentinian, European restaurant.";
if(isset($query) && $query = ""){$search->executeQuery($string, $page, $query);}
$page = "food/info/8";
$string = "Restaurant ML is a 4 star Dutch, fish and seafood, European restaurant.";
if(isset($query) && $query = ""){$search->executeQuery($string, $page, $query);}
//dance begint hier
$page = "dance/purchase";
$string = "Nick Rotteveel (Dutch pronunciation: [nik rɔtəvel fɑn χɔtʏm]; born 6 January 1989), professionally known as Nicky Romero, is a Dutch musician, DJ, record producer and remixer from Amerongen.[1] 
He has worked with, and received support from DJs, such as Tiësto, Fedde le Grand, Sander van Doorn, David Guetta, Calvin Harris, Armand Van Helden, Avicii and Hardwell.[3] He currently ranks at number 43
on DJ Mag's annual Top 100 DJs poll.[4] He is known for his viral hit song 'Toulouse'.";
if(isset($query) && $query = ""){$search->executeQuery($string, $page, $query);}
$string = "Tiësto, stage name of Tijs Michiel Verwest, is a Dutch disc jockey and music producer who often performs at major dance events. He has been voted best DJ in the world several times.";
if(isset($query) && $query = ""){$search->executeQuery($string, $page, $query);}
$string = "Nick van de Wall (Dutch: [ˈnɪk fɑn də ˈʋɑl]; born September 9, 1987), professionally known as Afrojack, is a Dutch DJ, music programmer, record producer and remixer from Spijkenisse. ... Afrojack
 regularly features as one of the ten best artists in the Top 100 DJs published by DJ Mag. He is also the CEO of LDH Europe.";
 if(isset($query) && $query = ""){$search->executeQuery($string, $page, $query);}
 $string = "Robbert Van de Corput was born on 7 January 1988 in Breda, to Anneke and Cor van de Corput. At the age of four he began taking piano lessons and attended a music school. At the age of twelve, he produced his first songs in the field of electro, while performing as a hip-hop-DJ.";
 if(isset($query) && $query = ""){$search->executeQuery($string, $page, $query);}
 $string = "Born on December 25, 1976 in Leiden, Holland, van Buuren became interested in music at an early age (his father was an avid record buyer). A close friend introduced him to the world of dance music, and the Dutch DJ and remixer Ben Liebrand quickly became his main inspiration.";
 if(isset($query) && $query = ""){$search->executeQuery($string, $page, $query);}
 $string = "Martin Garrix was born as Martijn Gerard Garritsen on May 14, 1996 in Amstelveen, a municipality in the province of North Holland, Netherlands, to Gerard and Karin Garritsen. He has a sister, Laura. He graduated from the 'Herman Brood Academie' in 2013 with the MBO diploma in 'artistic pop music'";
//jazz begint hier

//eindig searchresult section en laad de footer
echo "</section><br>";
require_once APPROOT . '/views/inc/footer.php';
class search{
    function executeQuery($string, $page, $query)
    {
    $number = substr_count(strtoupper($string), strtoupper($query));
    if ($number > 0)
    {
    echo " We found " . $number . " results for '" . $query . "' on the page " . $page;
    $pos = 0;
    $querylength = strlen($query);
    $searchresults = array();
    $linenumber = array();
    for ($i = 0; $i < $number; $i++)
    {
    $pos = stripos($string, $query, $pos);
    array_push($searchresults, substr($string, $pos, 30));
    $pos += $querylength;
    array_push($linenumber, $pos);
    }
    for($i = 0; $i < $number; $i++)
    {
    echo '<br>';
    echo "..." . $searchresults[$i] . "..." . " char:" . $linenumber[$i];
    echo '<br>';
    }   
    echo '<a href=../' . $page . '>Go to ' . $page . '</a>';
    echo '<br>'; 
    }
    }
    }
?>