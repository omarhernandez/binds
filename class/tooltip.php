<?php
session_start();
require_once("class.php");



$id_user = $_GET['id'];

$data = login::get_user_data($id_user);

echo " <img style='float:left;' width='60' src='userpic_thumb/".$data[0]['current_image_user']."'/>";

echo "<ul style='float:left;'>";

echo "<li>";
echo "<div style='font-size:12px;padding-left:7px;margin-bottom:4px;'> ".$data[0]['name']." ".$data[0]['lastname'].' </div>';
echo "</li>";

 


echo "<li>";
echo "<div style='font-size:10px;padding-left:7px;margin-bottom:4px'>Ing. Cs Computacion </div>";
echo "</li>";

echo "<li>";
echo "<div style='font-size:10px;padding-left:7px;margin-bottom:4px'>Mexico,puebla </div>";
echo "</li>";

echo "</ul>";
 

?>
