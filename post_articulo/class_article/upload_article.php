<?php

include('../../class/class.php');

 // esta clase sube el contenido a la DB 


$setData_article = new Articulo();


$setData_article->set_articulo(    $_POST['content'],   $_POST['create_']   ,   $_POST['setdata']);

?>
