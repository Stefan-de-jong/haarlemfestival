CMS Users:<br>
<?php
function UserButton($id,$name){
    return "
<form action='user' method='GET'>
    <input type='hidden' value='${id}' name='id'>
    <input type='submit' value='${name}'>
</form>
";
}

foreach ($data['users'] as $user){
    echo UserButton($user->id,$user->firstname);
}
?>