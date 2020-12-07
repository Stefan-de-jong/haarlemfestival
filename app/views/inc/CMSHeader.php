<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/CMS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title><?php echo SITENAME; ?></title>
</head>
<script src="<?php echo URLROOT; ?>/js/CMS.js"></script>
<?php
function translateRow($rowName){
        switch ($rowName) {
            case "id":
                return "ID";
            case "event_id":
                return "Item";
            case "ticket_type":
                return "Category";
            case "ticket_price":
                return "Price";
            case "buyer_email":
                return "Customer email";
            case "snippet_id":
                return "ID";
            case "snippet_page":
                return "Page";
            case "snippet_name":
                return "Name";
            case "snippet_text":
                return "Text";
            case "begin_time":
                return "Start";
            case "end_time":
                return "end";
            default:
                return $rowName;
        }
    }
function build_table($array){
    // start table
    $html = '<table>';
    // header row
    $html .= '<tr>';
    foreach($array[0] as $key=>$value){
        if ($key != 'id'){
        $html .= '<th>' .  htmlspecialchars(translateRow($key)) . '</th>';
        }
    }
    $html .= '</tr>';

    // data rows

    foreach( $array as $key=>$value){

        $html .= '<tr>';
        foreach($value as $key2=>$value2){
            $html .= '<td>' . htmlspecialchars($value2) . '</td>';
        }

        $html .= '</tr>';
    }

    // finish table and return it

    $html .= '</table>';
    return $html;
}
function backButton(){
    $href = URLROOT."/CMS";
    $url = $_REQUEST['url'];
    if (strtolower($url) != strtolower('CMS/Home'))
    echo '<a href="{$href}">Home</a><br>';
}
backButton();
?>
<body>