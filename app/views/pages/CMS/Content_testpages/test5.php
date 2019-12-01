<?php
require_once(APPROOT."/models/Page.php");
require_once(APPROOT."/models/PageRepository.php");
$repo=new PageRepository();
echo $repo->findId(5)->html;
?>