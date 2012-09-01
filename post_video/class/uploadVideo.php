<?php
include '../../class/class.php';

$setVideo = new video();
$setVideo->set_video($_POST['content'],$_POST['desc'],   $_POST['create_']   ,   $_POST['setdata']);
?>
