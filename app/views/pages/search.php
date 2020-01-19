<?php
//uitleg variabelen: $string is de string die je wilt doorzoeken met $query, de $page is de pagina waar je klanten heen wilt sturen als er zoekresultaten gevonden zijn
require_once APPROOT . '/views/inc/header.php';
$h_strings = $_POST['historic'];
$d_strings = $_POST['dance'];
$f_strings = $_POST['food'];
$query = $_POST['query'];

if (!isset($search))
{
$search = new search();
}
$url = "http://hfa4.infhaarlem.nl";
echo
"<section style='padding-bottom: 20px; margin-bottom: -30px; padding-left: 40%'>
<form  action='";
if(isset($query))
{
echo 'http://hfa4.infhaarlem.nl/search.php';
}
echo
 "'>Search the website!<br>
<input type='text' name='q' value='' placeholder='Search'><br>
<input type='submit' value='Submit'>
</form>";
echo "</section>";
echo "<section style='margin-left: 40%'>";
$page = 'historic';
$search->executeQuery($h_strings, $page, $query);
$page = 'food';
$search->executeQuery($f_strings, $page, $query);
$page = 'dance';
$search->executeQuery($d_strings, $page, $query);
echo "</section>";
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
    echo '<a href=http://hfa4.infhaarlem.nl/' . $page . '>Go to ' . $page . '</a>';
    echo '<br>'; 
    }
    }
    }
?>