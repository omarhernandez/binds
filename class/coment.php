<?php 
session_start();
require_once("class.php");
require('json.php');  
 


switch ( $_REQUEST['type'] ){



     case "posted":{ // si hay que cargar un nuevo post
          


  
     
    if(!empty($_REQUEST["coment"]) && !empty($_REQUEST["user_set"]) ){

$coment =$_REQUEST["coment"];
$posted_by = $_REQUEST["user_set"];
 

 

 switch($_REQUEST['post_type'] ){

     


 case "Ncmnt" : {  // Ncmnt = new coment PARENT
         
//************* CUANDO SE CREA UN NUEVO POST ( COMENTARIO ) *******************
 
$Comentary = new Coment();  
$Comentary->setcoment($coment,$posted_by,$posted_to); // !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! arreglar para comentar a otros usurios
 
// enviamos 1 porque este es exclusivo para postear comentarios y comentarios pertenece a 1 asi como articlos a 2 etc 
      
      $coments =  $Comentary->getLastoment($posted_to,"post_coment",1);  
  //lstNwPst last new post
     echo  json_encode(array('lstNwPst'=>$coments));
      
//**************************************************************************** 
      
      
 } break;      
   




 case "response":{ // respuesta a un parent POST
      

  $parent_coment =  $_REQUEST['parent_id'] ;    // comentario que sera el padre
   $datatype =    $_REQUEST['datatype'] ;
      
//*************  VAMOS A GUARDAR LA RESPUES A ALGUN POST *******************
 
 
$Comentary = new Coment(); 
$Comentary->SetComentReply($coment,$posted_by,$parent_coment,$datatype);
 


 $coments =  $Comentary->getLastoment($parent_coment,"reply_post",$datatype);
  echo  json_encode(array('reply_post'=>$coments));
 
      
 }break;







 }





 } // fin de if para validar
//****************************************************************************
//********************** OBTENER LOS COMENTARIOS ACTUALIZADOS ****************
//****************************************************************************
      
         
 ?>

<?php
}break; // si es un post recien hecho sin coments threads
?>



<?php
//**********************************************************************************************************************
 case "reply_coment":{ // iniciar la pagina :: hacer una instancia para hacer consulta y sacar todos los comentarios de la pagina correspondiente
      
     if(!is_numeric ($_REQUEST['parent_request'])){ 
          
        die( "algo pasa.<a href='home.php'>click here </a>");
          
          }

      $id_parent =  $_REQUEST['parent_request'] ;
       $limit =  $_REQUEST['deniedDisplay'] ; // el limite de comentarios osea los ocmentarios que ya se estan mostrando que ya no los saque de la DB
      $type_post = $_REQUEST['datatype'];
       
       
       $Comentary = new Coment(); 

    $coments_reply =  $Comentary->getReplycomentBylimit($id_parent,$limit, $type_post); // significa que solo trairemos los coments que faltan
   
 
   echo  json_encode(array('reply_post'=>$coments_reply) ); // regresamos los coments sin importar si hay o no
                 // en el coments.js verificamos si existen e inyectamos
      
  
  
  
  
     ?>
 <?php
}break; // fin si es para cargar la pagina al iniciarla
?>


<?php
} // fin de switch
?>

