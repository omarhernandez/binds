<?php

//$strImage1 = "";
//$strImage2 = "";
//$userUpdate = new UserInfo();


if (!empty($_FILES["imageUser"])) {
	if (isset($_FILES["imageUser"])) {
		$resultado = validateImage("imageUser");
		$strImage1 = $resultado["exito"] ? "".$resultado['nombreImagen']."" : "";
		echo $strImage1;
	}
	if (isset($_FILES["imageBack"])){
		$resultado = validateImage("imageBack");
		$strImage1 = $resultado["exito"] ? "".$resultado['nombreImagen']."" : "";
		echo $strImage1;
	}
}

function validateImage($nImage) {
	//extraemos los datos
	$image_name = $_FILES[$nImage]['name'];

	$tamaño = $_FILES[$nImage]['size'];
	$tempNameImage = $_FILES[$nImage]['tmp_name'];
	$allowed_ext = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
	$imageExt = strtolower(end(explode('.', $image_name)));
	$resultado = array();
	$error = false;
	if (empty($image_name)) {
		$error = true;
		$resultado["exito"] = false;
		$resultado["error"] = 'Archivo vacio';
	} else {
		if (!in_array($imageExt, $allowed_ext)) {
			$error = true;
			$resultado["exito"] = false;
			$resultado["error"] = 'Extensión no permitida';
		}

		if ($tamaño > 8388608) {
			$error = true;
			$resultado["exito"] = false;
			$resultado["error"] = 'Tu archivo es muy grande';
		}
	}

	if (!$error) {
		$newname = md5(rand() * time() * time()) . '.' . $imageExt;
		//@move_uploaded_file($tempNameImage, getcwd() . '/' . basename($image_name));
		move_uploaded_file($tempNameImage, "../../userpic/{$newname}");
		//echo $newname;
		//rename($image_name, "userpic/" . $newname);
		$resultado = array(
			"exito" => true,
			"nombreImagen" => $newname,
			"extension" => $imageExt,
			"ruta" => "photo"
		);

		return $resultado;
	}
}

?>
