<?php
session_start();
require_once("class.php");
require('json.php'); 

switch( $_REQUEST['type']){
     
     
   

 case "init":{ // iniciar la pagina :: hacer una instancia para hacer consulta y sacar todos los comentarios de la pagina correspondiente
          
     if(!is_numeric ($_REQUEST['user_profile'])){ 
          
        die( "algo pasa.<a href='home'>click here </a>");
          
          }
          
                 if($_REQUEST['show']=="__next_post"){ // si hay que mostar mas comentarios ( si viene de click de mostrar mas publicaciones etnonces incrementarmos y que muestre los siguientes 25
           // la paginacion la inicio en cero en el init_profile.php despues una vez que venga a mostrar los comentarios por primera vez le pondra cero , si le damos
           // click en mostar mas publicaciones nos lo incrementa a los siguientes 25 etc
            $_SESSION["limit_pagination"]+=25; 
           
      }else{
           
           $_SESSION["limit_pagination"]+=0;
           
      } 
        

    $id_user = sanitizeString($_REQUEST['user_profile']);
      
   $feed = new FeedProfile();  
  
   $feed = $feed->getFeedCurrentProfile($_SESSION["global_id_view"] ,$_SESSION["limit_pagination"]); // lmt_pt = limit post
   
    
   //---------------------------------------------------------------------------------------------- Obtenemos Articulos
 
     echo  json_encode(array('lstNwPst'=>$feed) ); // regresamos los coments sin importar si hay o no
               
      
     
 
}break; // fin si es para cargar la pagina al iniciarla
 
     
     
}


?>
