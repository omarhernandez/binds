<?php
include("resize.php"); 
include('SettingsImage.php');
 


class insert_Image_into_post 
{
     
	public function image()
	{
                
  
	       $settingImage = new SetImage();  // creamos instancia para setear imagenes
        
               $isImage = $settingImage->checkIfImage(); // checar si es imagen
               
               if($isImage){  // si es imagen que haga todo el proceso
               
               
               $settingImage->CheckAndConvertJPG( "../../".$_FILES["foto"]["name"]); // checar si la imagen es JPG si no convertirla y guardarla en TEMP
 
               
            //***************************** GENERAMOS Y FORMATEAMOS NOMBRE ***************************************************************************
		
                 $imagen = substr(strrchr($_FILES["foto"]["name"], "."), 1); 
               // Generamos un nombre de archivo Aleatorio para evitar conflictos entre los nombres.
                 $NombreArchivo = md5(rand() * time()) . ".$imagen";
                 
                 $NombreArchivo=str_replace(".".substr(strrchr($NombreArchivo, "."), 1), ".jpg", $NombreArchivo);
//******************************************************************************************************************   
               
               
              $settingImage->setPicCurrentSize( $NombreArchivo,"../../userpic/");// guardamos la imagen con el tamaño original pero configurandola 
 
               
             return $NombreArchivo; 
          
                
		
		  
             } 
            
  
	}
        
} 

?>