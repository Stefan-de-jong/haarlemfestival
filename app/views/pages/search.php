<?php
$search = new search();
$query = $_GET['q'];
$historic = 'Haarlem is a city and municipality in the Netherlands. It is the capital of the province of North Holland and is situated at the northern edge of the Randstad, one of the most populated metropolitan areas in Europe.
Haarlem has a rich history dating back to pre-medieval times. Haarlem became wealthy with toll revenues that it collected from ships and travellers moving on the busy North-South route. However, as shipping became increasingly important economically, the city of Amsterdam became the main Dutch city of North Holland during the Dutch Golden Age. The town of Halfweg became a suburb, and Haarlem became a quiet bedroom community, and for this reason Haarlem still has many of its central medieval buildings intact. Nowadays many of them are on the Dutch Heritage register known as Rijksmonuments.
The city is located on the river Spaarne, giving it its nickname "Spaarnestad" (Spaarne city). It is situated about 20 km (12 mi) west of Amsterdam and near the coastal dunes. Haarlem has been the historical centre of the tulip bulb-growing district for centuries and bears its other nickname "Bloemenstad" (flower city) for this reason.
Beer brewing has been a very important industry for Haarlem going back to the 15th century, when there were no fewer than 100 breweries in the city. When the towns 750th anniversary was celebrated in 1995 a group of enthusiasts re-created an original Haarlem beer and brewed it again. The beer is called Jopenbier, or Jopen for short, named after an old type of beer barrel.
In 1658, Peter Stuyvesant, the Director-General of the Dutch colony of Nieuw Nederland (New Netherland), founded the settlement of Nieuw Haarlem in the northern part of Manhattan Island as an outpost of Nieuw Amsterdam (New Amsterdam) at the southern tip of the island.
After the English capture of New Netherland in 1664, the new English colonial administration renamed both the colony and its principal city "New York," but left the name of Haarlem more or less unchanged. The spelling changed to Harlem in keeping with contemporary English usage, and the district grew (as part of the borough of Manhattan) into the vibrant centre of African American culture in New York City and the United States generally by the 20th century.';
$h_number = substr_count(strtoupper($historic), strtoupper($query));
$page = "historic/about";
if ($h_number > 0)
{
$search->executeQuery($h_number, $historic, $query, $page);
$historic = 'Post your own pictures on Instagram, along with #HaarlemHistoric #HaarlemFestival and a hashtag corresponding to your location, and you might win a dinner for two at one of our partner restaurants!';
$page = "historic";
$search->executeQuery($h_number, $historic, $query, $page);
}
else
{
echo "No results found for the historic pages";
}

class search{
    function executeQuery($number, $string, $query, $page)
    {
    echo "We found " . $number . " results for '" . $query . "' on the page " . $page;
    $pos = 0;
    $querylength = strlen($query);
    $searchresults = array();
    $linenumber = array();
    for ($i = 0; $i < $number; $i++)
    {
    $pos = stripos($string, $query, $pos);
    $pos += $querylength;
    array_push($searchresults, substr($string, $pos, 30));
    array_push($linenumber, $pos);
    }
    for($i = 0; $i < $number; $i++)
    {
    echo '<br>';
    echo "..." . $searchresults[$i] . "..." . " char" . $linenumber[$i];
    }
    echo '<br>';
    echo '<a href=../' . $page . '>Go to ' . $page . '</a>';
    echo '<br>';
    }
}
?>