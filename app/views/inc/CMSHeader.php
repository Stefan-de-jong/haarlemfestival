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
function build_addTable($content){
     ?>
    <form action="<?php echo URLROOT . "/CMS/AddObject"?>" method="post">
        <?php
        foreach($content[0] as $k=>$v){
         ?>
            <input type="text" name="<?php echo $v; ?>" placeholder="<?php echo $v ?>">
        <?php
        }?>
        <input type="hidden" name="action" value="<?php echo $content['action']  ?>">
        <input type="submit" value="Add">
        <?php
        ?>
    </form>
<?php
}

function build_table($array,$skipFields = [],$extraButtons = []){
    $groupArtists = $array[0]->action == "7cda127b9c7c0fa6430b710f04d0b08f";
    $readonlyFields = [];
    if ($array[0]->action == 'e'){
        array_push($readonlyFields,'venue_name');
    }
    $skip = ['action','id','idValue','readOnly','editablePasswordId'];
    foreach ($skipFields as $spec){
        array_push($skip,$spec);
    }
    if ($groupArtists){
        $readonlyFields= ['artist_name','venue_name'];
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
    $html = "<table id = 'editable'>";
    $html .= '<tr>';
    foreach($array[0] as $key=>$value){
        if (!in_array($key,$skip)) {
            $html .= '<th>' . htmlspecialchars(translateRow($key)) . '</th>';
        }
    }
    $html .= '<th>Update</th>';
    $html .= '<th>Extra</th>';
    $html .= '</tr>';
    foreach( $array as $key=>$value){
        $html .= '<tr>';
        $html .= formStart();
        foreach($value as $key2=>$value2){
            if (!in_array($key2,$skip)) {
                if (in_array($key2,$readonlyFields) or $array[0]->readOnly){
                    if ($key2 == 'ticket_price'){
                        $value2 = "€".number_format($value2,2);
                    }
                    $html .= '<td>' . formInputReadonly(htmlspecialchars($value2), $key2) . '</td>';
                }else {
                    $html .= '<td>' . formInput(htmlspecialchars($value2), $key2) . '</td>';
                }
            }
        }
        $html .= meta($value->action,$value->idValue);
        $html .= updateButton($array[0]->readOnly);
        $html .= formEnd();
        if (count($extraButtons) > 0){
            foreach ($extraButtons as $extra){
                $injected = str_replace('%id',$value->id,$extra);
                $injected  = str_replace('%action',$value->action,$injected);
                $html .= "<td>" .$injected . "</td>";
            }
        }
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
function updateButton($readOnly){
    if ($readOnly){
        return "<td><input type='hidden' value='Update'></td>";
    }else {
        return "<td><input type='submit' value='Update'></td>";
    }
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
    echo '<a class = "btn" href='. $href  .'>Home</a><br>';
}
function translateRow($column){
    $column = strtolower($column);
    $translations = [
            'firstname'=>'First Name',
        'lastname' => 'Last Name',
        'email'=>'Email',
        'first_name'=>'First Name',
        'last_name' => 'Last Name',
        'artist_name' => 'Artist',
        'venue_name' => 'Venue',
        'date' => 'Date',
        'begin_time' => 'Start',
        'end_time' => 'End',
        'address' => 'Address',
        'name' => 'Name',
        'stars' => 'Rating',
        'type' => 'Type',
        'ticket_price' => 'Ticket Price',
        'buyer_email' => 'Email'

    ];
    if (isset($translations[$column])){
        return $translations[$column];
    }else{
        return $column;
    }
}
if (isset($_SERVER['QUERY_STRING'])) {
    if (!(strpos($_SERVER['QUERY_STRING'], 'login') !== false))  {
        backButton();
    }
}
if (isset($_GET['msg'])){
    echo $_GET['msg'];
}
?>
<body>