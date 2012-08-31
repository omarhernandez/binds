<?php
include ("../../class/class.php");

$user	= $_POST["currUser"];
$from	= $_POST["from"];
$to		= $_POST["to"];

$datos		= new subscriptions();
$resultad = $datos ->getSubscriptions($user,$from,$to);

echo json_encode(array("result" => $resultad));

?>
