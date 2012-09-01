<?php

$url = $_POST["en"];
$arreglo = @getimagesize($url);

if (is_array($arreglo)) {
	
	if (($arreglo[0] > 250 && $arreglo[1] > 50) || ($arreglo[0] > 50 && $arreglo[1] > 250)) {
		$NombreArchivo = md5(rand() * time() * time());
		$donsize = substr($url, -3);
		copy($url, "../../photo/" . $NombreArchivo . "." . $donsize);
		$cadena = array("rems" => "true", "nombre" => $NombreArchivo . '.' . $donsize);
	}
	
	else {
		$cadena = array("rems" => "La imagen es muy pequeña");
	}
} 

else {
	$cadena = array("rems" => "Error, tu enlace es incorrecto");
}

echo json_encode(array("rslImage" => $cadena));
?>
