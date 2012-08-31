<?php
include('../../class/class.php');

 // esta clase sube el contenido a la DB 

$setData_article = new Photo();

$setData_article->set_Photo( $_POST['content'],$_POST['desc'],   $_POST['create_']   ,   $_POST['setdata']);

?>
