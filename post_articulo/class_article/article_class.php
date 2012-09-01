<?php

//subir imagen al servidor cuando da click en seleccionar imagen 

 include('../../imageClass/image_post.php');
 
$uploaded = $_FILES['foto']['name'];


 // lo que se hace en este archivo es : subir la imagena  un archivo temporal para cuando termine de hacer el articulo si lo envia , se sube la imagen la servidor
// si no , se elimina de temporal

$dataSetimageTemp = new insert_Image_into_post();

$NombreArchivo = $dataSetimageTemp->image(); // guardamos la imagen en TEMP 

$image ="'<img   width=174 src=../userpic/".$NombreArchivo.">     '";

 
if(!empty ($NombreArchivo)){
  $response = "<script> 
     
  parent.document.getElementById('loader_up').style.display = 'none'; 
  
 

 top.window.tinyMCE.execCommand('mceInsertContent', false , ".$image." );   </script> ";

 echo $response;   
     
}else{
     
    
     
} 


        
?>
