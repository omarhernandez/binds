<?php
include("resize.php"); 
include('SettingsImage.php');
 


class insert_Image 
{
     
	public function image()
	{
                
  
	       $settingImage = new SetImage();  // creamos instancia para setear imagenes
        
               $isImage = $settingImage->checkIfImage(); // checar si es imagen
               
               if($isImage){  // si es imagen que haga todo el proceso
               
               
               $settingImage->CheckAndConvertJPG($_SERVER['DOCUMENT_ROOT']."BindsII/temp/".$_FILES["foto"]["name"]); // checar si la imagen es JPG si no convertirla y guardarla en TEMP
  
              $NombreArchivo = $settingImage->setThumbPic(200,200,"userpic_thumb/",$_FILES["foto"]["name"]); // guardamos el thumnail primero a medida 110 x 110
                
               $settingImage->setPicCurrentSize($NombreArchivo,"userpic/");// guardamos la imagen con el tamaño original pero configurandola 
 
              
               
             //  return $NombreArchivo; 
          
                
		
		  
             }
            
  
	}
        
    
} 

?>