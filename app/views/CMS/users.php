<?php require APPROOT . '/views/inc/CMSHeader.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo URLROOT."/public/css/style.css";?>">
    <title><?php echo $data["title"]; ?></title>
</head>

<body>
<?php
function passwordResetButton(){
    return
        " <form method='POST' action='".  URLROOT  ."/CMS/ResetPassword'>
    <input type='hidden' name='id' value='%id'>
    <input type='hidden' name='action' value='%action'>
    <input type='submit' value='Reset Password'>
    </form>
    ";
}

function deleteButton(){
     return
        " <form method='POST' action='".  URLROOT  ."/CMS/DeleteObject'>
    <input type='hidden' name='id' value='%id'>
    <input type='hidden' name='action' value='%action'>
    <input type='submit' value='Delete'>
    </form>
    ";
}
echo build_table($data['content'],['password','role'], [
        passwordResetButton(),
    deleteButton()
]);

echo build_addtable($data['content']);
?>
</body>
</html>


<?php
?>