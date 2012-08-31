<?php 
session_start();
require_once("class.php");

 
//*************** primero insertamos la info a la DB del usuario que vamos a seguir    folower & following   *************** 

if (isset($_POST['suscriber']) && isset($_POST['suscribeTo']))
{
     
 
         $suscriber = sanitizeString($_POST['suscriber']);
         $suscribers= sanitizeString($_POST['suscribeTo']);
          
     
      if($_GET["status"] == "suscribe"){  // si se quiere seguir al usuario se carga la consulta correspondiente
     
                      
         subscribe::setFollowing($suscriber,$suscribers);
                        
 
        }else{
             
             
             
        }  if($_GET["status"] == "drop") {  // si se quiere dejar de seguir al usuario etnocnes se carga otra consulta
             

            subscribe::dropUser($suscriber,$suscribers);


       
             

        }  
        
        
     

 
  
}

 
?>
