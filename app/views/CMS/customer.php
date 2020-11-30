<?php require APPROOT . '/views/inc/CMSHeader.php'; ?>
<?php
$user = $data['customer'];
echo $user->first_name."<br>";
echo $user->last_name."<br>";
echo $user->email."<br>";
echo $user->password."<br>";
?>


