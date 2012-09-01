<?php
include "../../class/class.php";

$userInfo = new UserInfo();
$userInfo->getUserInfo($_POST["id"]);
?>