<?php require APPROOT . '/views/inc/CMSHeader.php'; ?>

<?php
$user = $data['user'];
echo $user->firstname."<br>";
echo $user->lastname."<br>";
echo $user->email."<br>";
echo $user->password."<br>";
echo $user->role."<br>";
?>


