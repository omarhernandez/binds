<?php
session_start();
require_once("class.php");
require('json.php');  

switch ( $_REQUEST['type'] ){


 
 case "init":{  // obtiene todas las notificaciones en cronologia
      
     if(!is_numeric ($_REQUEST['user_profile'])){ 
          
        die( "algo pasa.<a href='home.php'>click here </a>");
          
          }
          
       if($_REQUEST['show']=="__next_post"){ // si hay que mostar mas comentarios ( si viene de click de mostrar mas publicaciones etnonces incrementarmos y que muestre los siguientes 25
           // la paginacion la inicio en cero en el init_profile.php despues una vez que venga a mostrar los comentarios por primera vez le pondra cero , si le damos
           // click en mostar mas publicaciones nos lo incrementa a los siguientes 25 etc
            $_SESSION["limit_pagination"]+=25; 
           
      }else{
           
           $_SESSION["limit_pagination"]+=0;
           
      }     
          
 
 
   $ComentaryNotify = new cronology();  
  
   
   //--------------------------------------------------------------------------------------------- Obtenemos Comentarios
   $comentsNotify =  $ComentaryNotify->getCronology($_SESSION["global_id_current"],$_SESSION["limit_pagination"]);
  
     echo  json_encode(array('lstNwPst'=>$comentsNotify) ); // regresamos los coments sin importar si hay o no
                 // en el coments.js verificamos si existen e inyectamos
      
     
 }break;
}

?>
