<?php require APPROOT . '/views/inc/CMSHeader.php'; ?>
    Customers:<br>
<?php
function UserButton($id,$name){
    return "
<form action='customer' method='GET'>
    <input type='hidden' value='${id}' name='id'>
    <input type='submit' value='${name}'>
</form>
";
}

foreach ($data['customers'] as $user){
    echo UserButton($user->id,$user->first_name);
}
?>