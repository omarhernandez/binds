<?php

if (isset($_FILES['foto'])) {
	$image_name = $_FILES['foto']['name'];
	$tamaño = $_FILES['foto']['size'];
	$tempNameImage = $_FILES['foto']['tmp_name'];
	$allowed_ext = array('jpg', 'jpeg', 'bmp', 'png', 'gif');
	$imageExt = strtolower(end(explode('.', $image_name)));

	$errors = array();

	if (empty($image_name))
		$errors[] = 'Archivo dañado';

	else {
		if (!in_array($imageExt, $allowed_ext)) {
			$errors[] = 'Extensión no permitida';
		}

		if ($tamaño > 8388608) {
			$errors[] = 'Tu archivo es muy grande';
		}
	}

	if (empty($errors)) {
		@move_uploaded_file($tempNameImage, getcwd() . '/' . basename($image_name));
		$newname = md5(rand() * time() * time()) . '.' . $imageExt;
		rename($image_name, "../photo/" . $newname);

		$imgResul = array(
			"exito" => "true",
			"nombretemp" => $tempNameImage,
			"nombreImagen" => $newname,
			"extension" => $imageExt,
			"ruta" => "photo"
		);

		$files = $imgResul['ruta'] . "/" . $newname;

		echo "<script> 
                 window.parent.document.getElementById('image_file').src ='$files';
				 parent.succesfulUplPC();
			</script>";
	} 
	else 
		$result  = json_encode($errors);
		echo '<script> window.parent.document.alert('.$result.');</script>';
	
}
?>
