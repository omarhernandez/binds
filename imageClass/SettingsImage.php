<?php

class SetImage{  
 
     /*¨    FORMATO PARA USAR ESTA FUNCION
 
    $settingImage = new SetImage();  // creamos instancia para setear imagenes
    class/image/class/
    $settingImage->CheckAndConvertJPG("temp/".$_FILES["foto"]["name"]); // checar si la imagen es JPG si no convertirla y guardarla en TEMP
                  
    $NombreArchivo = $settingImage->setThumbPic(110,110,"userpic_thumb/",$_FILES["foto"]["name"]); // guardamos el thumnail primero a medida 110 x 110                                                                                             Y REGRESAMOS EL NOMBRE DE LA IMAGEN 345345345.JPG
                
    $settingImage->setPicCurrentSize($NombreArchivo,"userpic/");// CHECAMOS EL TAMAÑO DE LA IMAGEN ACTUAL Y LA CONFIGURAMOS A LAS MEDIDAS ESTANDARES
                 
      
      */
     
  //**********************************************************************************************         
  //**********************************************************************************************    
  //**********************************************************************************************    
  //*******************FUNCION PARA THUMBS *****************************************************************    
  //**********************************************************************************************    
       
     public function setThumbPic($width,$heigh,$dir,$files){
                //primero le damos tratamiento a la imagen
		//subimos la foto al servidor
                //
//***************************** GENERAMOS Y FORMATEAMOS NOMBRE ***************************************************************************
		
                 $imagen = substr(strrchr($_FILES["foto"]["name"], "."), 1); 
               // Generamos un nombre de archivo Aleatorio para evitar conflictos entre los nombres.
                 $NombreArchivo = md5(rand() * time()) . ".$imagen";
                 
                 $NombreArchivo=str_replace(".".substr(strrchr($NombreArchivo, "."), 1), ".jpg", $NombreArchivo);
//******************************************************************************************************************
                 
                $image = new cropImage;
                $image->setImage($files);  // obtenemos el archivo recien guardado
                $image->createThumb(110);
                $image->renderImage("userpic_thumb/",$NombreArchivo);

                 unlink($_FILES["foto"]["tmp_name"]);  //eliminamos el archivo temporal7
            
                 /*  intentar guardar la imagen con el mismo nombre*/
                return $NombreArchivo; // regresa el nombre de la iamgen
     }
     
 //**********************************************************************************************          //**********************************************************************************************    
  //**********************FUNCION PARA ESTANDARIZAR EL TAMAÃ‘O DE LA IMAGEN PROPORCIONADO**********    
  //**********************************************************************************************    
  //**********************************************************************************************    
   
       public function setPicCurrentSize($NombreArchivo,$dir){
            
             //$NombreArchivo contiene el nombre de la imagen seteada ejem. 243234234234.jpg
               //detectamos si su altura es mayor a 530 entonces la reducimos a 530 :D
		 $foto=getimagesize($_FILES["foto"]["name"]); //accedemos a temp para modificarlo
                 $ancho=$foto[0];
		 $alto = $foto[1];
  
                 if($ancho >= 999 || $alto >= 999  ){ // si algun ancho o alto es mayor a 1000 lo seteamos a 960

                if( $ancho >= $alto ){  // reducimos ancho a 960
                       
                 $thumb=new thumbnail($_FILES["foto"]["name"]);	
		 
                 $thumb->size_width(960);//setea el ancho  
		 $thumb->jpeg_quality(90);//setea la calidad jpg

		 $thumb->save($dir.$NombreArchivo);     
                       
   //***********************************************************************************                    
                   }
                   else // entonces alto es mayor que ancho y ponemos alto a 960   
                  {
      
                 $thumb=new thumbnail($_FILES["foto"]["name"]);	
		 
		 $thumb->size_height(960);//setea el alto  
		 $thumb->jpeg_quality(90);//setea la calidad jpg

		 $thumb->save($dir.$NombreArchivo);       
                        
                  }   
                 }//END IF MAIN
                  else{ 

//// si la imagen no necesita ajustes se guarda tal cual 
                   
                  $thumb=new thumbnail($_FILES["foto"]["name"]);
                  $thumb->size_height($alto);
                  $thumb->jpeg_quality(90);//setea la calidad jpg
                  $thumb->save($dir.$NombreArchivo);    
                      
                  }          
   //***********************************************************************************
     
                $dir = "userpic_thumb/";
                $classe = "imageDisplay";
               
      
                         
                  unlink($_FILES["foto"]["name"]); // por ultimo eliminamos la imagen en TEMP
       }
       
  //**********************************************************************************************          //**********************************************************************************************    
  //**********************************************************************************************    
  //**************************FUNCION PARA CONVERTIR c/FORMATO A JPG *****************************    
  //**********************************************************************************************    
   
     public function CheckAndConvertJPG($archivo)
       
      { 
       // hacemos copia en TEMP para tratar a la imagen   
          
       $img["format"]=substr(strrchr($archivo, "."), 1); //obtenemos el formato
      
       $img["format"]=strtoupper($img["format"]);       // lo convertimos a mayuscylas
 
       switch( $img["format"]){
//*******************************************************************************************************        
     case "JPG" :  
          
        copy($_FILES["foto"]["tmp_name"],$archivo); 
        $_FILES["foto"]["name"]=$archivo;  break;
     case "GIF":  
          
           $foto=getimagesize($_FILES["foto"]["tmp_name"]);
      $width=$foto[0];
      $height=$foto[1];   

      $file = imagecreatetruecolor($width, $height);
      $new = imagecreatefromgif($_FILES["foto"]["tmp_name"]);
      $kek=imagecolorallocate($file, 255, 255, 255);
      imagefill($file,0,0,$kek);
      imagecopyresampled($file, $new, 0, 0, 0, 0, $width, $height, $width,$height);
      $archivo=str_replace(".".substr(strrchr($archivo, "."), 1), ".jpg", $archivo); // remplazamos la extencion
   
    
    $_FILES["foto"]["name"]=$archivo;  // guardamos el nombre nuevo al archivo junto con la ruta 
    
    imagejpeg($file,$archivo,100);    // guardamos en temp la imagen
   break;
//*******************************************************************************************************
      case "PNG": {

      $foto=getimagesize($_FILES["foto"]["tmp_name"]);
      $width=$foto[0];
      $height=$foto[1];   

      $file = imagecreatetruecolor($width, $height);
      $new = imagecreatefrompng($_FILES["foto"]["tmp_name"]);
      $kek=imagecolorallocate($file, 255, 255, 255);
      imagefill($file,0,0,$kek);
      imagecopyresampled($file, $new, 0, 0, 0, 0, $width, $height, $width,$height);
      $archivo=str_replace(".".substr(strrchr($archivo, "."), 1), ".jpg", $archivo); // remplazamos la extencion
   
    
    $_FILES["foto"]["name"]=$archivo;  // guardamos el nombre nuevo al archivo junto con la ruta 
    
    imagejpeg($file,$archivo,100);    // guardamos en temp la imagen
   break; 
     }
//*******************************************************************************************************  
  default:  //JPG
       
       copy($_FILES["foto"]["tmp_name"],$archivo); 
     
       $_FILES["foto"]["name"]=$archivo; // guardamos su nombre con la ruta porqe lo requiere el rezise.php
       //al momento de crear la instancia break; 
       
          }

      }

 //**********************************************************************************************          //**********************************************************************************************    
  //**********************************************************************************************    
  //**********************************************************************************************    
  //**********************************************************************************************    
   
      
  function checkIfImage(){
       
       
      $types = substr(strrchr($_FILES["foto"]["type"], "/"), 1); 
               // Generamos un nombre de archivo Aleatorio para evitar conflictos entre los nombres.
    
      
      
  $messageAlertNoTypeFile = " Lo sentimos , No puedes subir archivos  ".$types. " como fotografias ";
       
   if($types == "jpg" || $types == "jpeg" || $types == "gif" || $types == "png"  ){
        
      return true;  
      
   }else{
        
   echo "<script>
      parent.document.getElementById('loader_up').style.display = 'none'; 
  
     alert('.$messageAlertNoTypeFile.');
     </script>" ;    
 
   return false;
   }  
   
     
}    
      
      
      
      
}

//*****************************************************************************************

class cropImage {
 var $imgSrc,$myImage,$cropHeight,$cropWidth,$x,$y,$thumb;
 var $DoubleHeight;
 function setImage($image) {

  //Your Image
  $this->imgSrc = $image;

  //getting the image dimensions
  list($width, $height) = getimagesize($this->imgSrc);

  //create image from the jpeg
  $this->myImage = imagecreatefromjpeg($this->imgSrc) or die("Error: Cannot find image!");
  
  if($width === $height){
       
   $biggestSide = $width+15;  //find biggest length
   $cropPercent = .7; // This will zoom in to 70% zoom (crop)    
  }
  else{
       
  if($width > $height){
       
      $DoubleHeight = $height*4;  
      
       if($DoubleHeight < $width)
       {
        $biggestSide = $width;  //find biggest length
        $cropPercent = .1; // This will zoom in to 60% zoom (crop)         
            
       }else
       {
  
 $DoubleHeight =$height*2;
   
   if($DoubleHeight<$width) // si la imagen su ancho es doble vez mas grande que su alto
   {
        
   $biggestSide = $width;  //find biggest length
   $cropPercent = .3; // This will zoom in to 60% zoom (crop)    
        
   }else{
        
        if($DoubleHeight>$width){ // si el doble es mayor pero aun asi width > height
             
   $biggestSide = $width;  //find biggest length
   $cropPercent = .3; // This will zoom in to 60% zoom (crop)       
             
        }else
             
   $biggestSide = $width;  //find biggest length
   $cropPercent = .5; // This will zoom in to 60% zoom (crop)
      }
       }
  }
  
  else{ 
       
       $Doublewidth =$width*2;
       
       if( $Doublewidth < $height){
            
         $biggestSide = $height;
    $cropPercent = .4; // This will zoom in to 40% zoom (crop)   
            
       }else{
       
    //find biggest length
    $biggestSide = $height;
    $cropPercent = .5; // This will zoom in to 40% zoom (crop)
  }
  }
 }
  //The crop size will be half that of the largest side
  
  $this->cropWidth   = $biggestSide*$cropPercent;
  $this->cropHeight  = $biggestSide*$cropPercent;

  //getting the top left coordinate
  $this->x = ($width-$this->cropWidth)/2;
  $this->y = ($height-$this->cropHeight)/2;
 
}

 function createThumb($size) {
  $thumbSize = $size; // will create a 250 x 250 thumb
  $this->thumb = imagecreatetruecolor($thumbSize, $thumbSize);
  
  imagecopyresampled($this->thumb, $this->myImage, 0, 0,$this->x, $this->y, $thumbSize, $thumbSize, $this->cropWidth, $this->cropHeight);
 }

 function renderImage($dir,$files) {
 
  imagejpeg($this->thumb,$dir.$files,80);
  imagedestroy($this->thumb);
 }

 
}

//************************************************************************************
//************************************************************************************
//************************************************************************************


?>
