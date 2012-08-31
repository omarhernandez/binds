
<?php
session_start();
include_once 'class/class.php';
if (!isset($_SESSION['current_user'])) {
	die("No has iniciado sesion . Por Favor <a href='index.php'>Click aqui</a>.");
}
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>    
		<title>Editar Storyboard</title>

		<link rel="shortcut icon" href="images/icon/binds.png" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/homeUI.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/profile.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/buttons.css" media="screen" />
<link rel="stylesheet" type="text/css" href= "framework/css/binds.css" media="screen" />
<link rel="stylesheet" type="text/css" href="tipsy/js/tipsy.css" media="screen" />
<link rel="stylesheet" type="text/css" href="class/instantsearch/css/estilo.css"/>

		<link rel="stylesheet" href="settings/css/estileSettings.css" type="text/css"/>

		<script type="text/javascript" src="js/jquery-1.6.js" ></script>
<script type="text/javascript" src="js/jstextarea.js"></script>
<script type="text/javascript" src="js/BindsQuery.js"></script>
<script type="text/javascript" src="js/initHead.js"></script>
<script type="text/javascript" src="js/slide.js"></script>
<script type="text/javascript" src="js/fx.js" ></script>
<script type="text/javascript" src="class/instantsearch/js/searchInstant.js"></script>

		<script type="text/javascript" src="settings/js/settings.js"></script>
		<script type="text/javascript" src="framework/js/binds.js"></script>

		<?php
		if (isset($_POST)) {

			if (!empty($_POST)) {

				$strImage1 = "";
				$strImage2 = "";

				if (isset($_FILES["imageUser"]["name"])) {

					if (!empty($_FILES["imageUser"]["name"])) {
						$resultado = validateImage("imageUser","userpic");

						if ($resultado["exito"])
							$strImage1 = "" . $resultado['nombreImagen'] . "";

						else
							echo "<script type='text/javascript'> alert('" . $resultado["error"] . "');
					  //window.showErrorOnupload('Error','" . $resultado["error"] . "');
					  </script>";
					}
				}

				if (isset($_FILES["imageBack"]["name"])) {
					if (!empty($_FILES["imageBack"]["name"])) {
						$resultado = validateImage("imageBack","photo");

						if ($resultado["exito"])
							$strImage2 = "" . $resultado['nombreImagen'] . "";

						else
							echo "<script type='text/javascript'> alert('" . $resultado["error"] . "');
					  //window.showErrorOnupload('Error','" . $resultado["error"] . "');
					  </script>";
					}
				}
				//echo "imagen1: " . $strImage1;
				//echo "\nimagen2: " . $strImage2;
				$updateData = new UserInfo();
				$sql = $updateData->setUserInfo($_POST, $_SESSION["current_id"], $strImage1, $strImage2);
				//echo "\nconsulta: ".$sql;
			}
		}

		function validateImage($nImage,$folder) {
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
				move_uploaded_file($tempNameImage, $folder."/".$newname);
				$resultado = array(
					"exito" => true,
					"nombreImagen" => $newname,
					"extension" => $imageExt,
					"ruta" => "photo"
				);
			}
			return $resultado;
		}
		?>
	</head>


	<body>
		<?php
		include 'includes/header/head.php';
		?>
		<?php require_once ('class/json_user_data_home.php'); ?> 
		<div class="tickerheader">


			<div id="content">

				<div class="AnnContent">

					<div id="containerImageUserView" class="fiximageuser">


						<img src="<?php echo "userpic_thumb/" . $_SESSION["current_photo"]; ?>"   width="77"    /> 

					</div> 

					<ul class="menutabs">

						<li id="StoryboardSettings" class="leftList  Menu  none uiIcon icon">
							Storyboard
						</li>
						<li id="AccountSettings"	class="leftList Menu none uiIcon icon border-menu">
							Cuenta
						</li>
						<li id="PrivaciSettings"	class="leftList Menu none uiIcon icon">
							Privacidad
						</li>
					</ul>

				</div>



				<div id="columContentRight">
					<form id ='edit' action='' enctype="multipart/form-data" name='edit' method='post'><br>
						<h1>Editar stoyboard</h1>
						<p>Esta es la informacion que los demas veran sobre ti. Al llenarla correctamente le permites a mas gente encontrarte</p>
						<div class = 'separator Lseparador'></div>
						<label for = 'username'>Nombre de usuario</label><br>
						<input type = 'text' name = 'username' id = 'username' class = 'inputs' />

						<div class = 'groupContainer'>Un nombre con el cual las personas te identificaran</div>

						<div class='separator Lseparador'></div>
						<p>URL</p>
						<label for="url">binds.me/</label>

						<input class="inputs" type="text" name="url" id="url"/>		

						<div class='separator Lseparador'></div>

						<label for = 'quote'>Biografía</label><br>

						<textarea class = 'inputs' type = 'text' name = 'quote' rows = '4' cols = '80' id = 'quote'></textarea>

						<div class = 'groupContainer'>Cuentanos sobre ti</div>

						<div id = 'separator' class = 'Lseparador'></div>


						<div id = "leftD" class = "uplContainer">

							<label for = 'imageUser'>Imagen de Perfil </label><br>


							<input class = 'inputs' id = 'imageUser' name = 'imageUser' type = 'file' /><br>

						</div>



						<a class ="buttonOrange" id="saveChanges">Guardar cambios</a>

						<div id ="rightD" class ="uplContainer">

							<label for='imageBack'>Fondo de Storyboard</label><br>

							<input class='inputs' id ='imageBack' name='imageBack' type='file' />

						</div>

					</form>

				</div>

			</div>

		</div>

	</body>
</html>


