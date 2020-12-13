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
function indexInArray($entry, $array)
{
    for ($i=0; $i<count($array); $i++){
        if ($array[$i]->id === $entry->id){
            return $i;
        }
    }
    return -1;
}
function build_table($array,$specialFields = [],$readonlyFields= [],$groupArtists=false){
    $skip = ['action','id','idValue'];
    foreach ($specialFields as $spec){
        array_push($skip,$spec);
    }
    if ($groupArtists){
        $grouped = [];
    foreach($array as $row){
        $index = indexInArray($row,$grouped);
        if ($index == -1){
            array_push($grouped,$row);
        }else{
            $grouped[$index]->artist_name .= ", " .$row->artist_name;
        }
    }
    $array = $grouped;
    }
    $html = '<table>';
    $html .= '<tr>';
    foreach($array[0] as $key=>$value){
        if (!in_array($key,$skip)) {
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
    }
    $html .= '</tr>';
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        $html .= formStart();
        foreach($value as $key2=>$value2){
            if (!in_array($key2,$skip)) {
                if (in_array($key2,$readonlyFields)){
                    $html .= '<td>' . formInputReadonly(htmlspecialchars($value2), $key2) . '</td>';
                }else {
                    $html .= '<td>' . formInput(htmlspecialchars($value2), $key2) . '</td>';
                }
            }
        }
        $html .= meta($value->action,$value->idValue);
        $html .= updateButton();
        $html .= formEnd();
        $html .= '</tr>';
    }
    $html .= '</table>';
    return   $html;
}
function formStart(){
    return "<form method='POST' action='".  URLROOT  ."/CMS/Process'>";
}
function formEnd(){
    return "</form>";
}
function formInput($data,$n){
    return str_replace('%d',$data,
        "<input type='text' name='$n' value='%d'>"
    );
}
function formInputReadonly($data,$n){
    return str_replace('%d',$data,
        "<input disabled style='width: 400px;' type='text' name='$n' value='%d'>"
    );
}
function updateButton(){
    return "<td><input type='submit' value='Update'></td>";
}
function meta($a,$id){
    return
        "<input type='hidden' name='action' value='{$a}'>".
        "<input type='hidden' name='id' value='{$id}'>"
        ;
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