<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo URLROOT."/public/css/style.css";?>">
    <title><?php echo $data["title"];   ?></title>
</head>

<body>
<?php
echo build_table($data['content'])
?>
</body>
</html>


<?php
function build_table($array){
    $skip = ['action','id','idValue','snippet_id'];
    // start table
    $html = '<table>';
    // header row
    $html .= '<tr>';
    foreach($array[0] as $key=>$value){
        if (!in_array($key,$skip)) {
            $html .= '<th>' . htmlspecialchars($key) . '</th>';
        }
    }
    $html .= '</tr>';

    // data rows

    foreach( $array as $key=>$value){
        $html .= '<tr>';
        $html .= formStart();
        foreach($value as $key2=>$value2){
            if (!in_array($key2,$skip)) {
                $html .= '<td>' . formInput(htmlspecialchars($value2), $key2) . '</td>';
            }
        }
        $html .= meta($value->action,$value->idValue);
        $html .= updateButton();
        $html .= formEnd();
        $html .= '</tr>';
    }

    // finish table and return it

    $html .= '</table>';
    return   $html;
}
function formStart(){
    return "<form method='POST' action='".  URLROOT  ."/test/Process'>";
}
function formEnd(){
    return "</form>";
}
function formInput($data,$n){
    return str_replace('%d',$data,
        "<input type='text' name='$n' value='%d'>"
    );
}
function updateButton(){
    return "<td><input type='submit'></td>";
}
function meta($a,$id){
    return
        "<input type='hidden' name='action' value='{$a}'>".
        "<input type='hidden' name='id' value='{$id}'>"
        ;
}
?>