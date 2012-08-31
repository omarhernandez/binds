
<?php
session_start();
require_once("class.php");
  /* obtenemos la foto nombre y id de los seguidores*/   
 $images = "";    
 
 
   $getInformationFollowers = new subscribe();
  
   $view_follower_user = $getInformationFollowers->getsubscribeInformation($_SESSION["id_user_view"]);   
            

    if(count($view_follower_user)==1){ 
                 
                 echo " <strong>Seguido por  <span class='colorBlue' id='usersCount'>".count($view_follower_user)." Persona </span></strong>";
         
                 echo "<br/>";
       
                 }else{
                      
                    echo " <strong>Seguido por  <span class='colorBlue' id='usersCount'>".count($view_follower_user)." Personas </span></strong>";
         
                 echo "<br/>";

                      }        
 
   
                echo " <div id='ContainerImageFollowers'> ";      
                      
                for($i=0;$i<count($view_follower_user);$i++){      
                     
          
                      
               echo  " <a href='profile.php?id=";
               
               echo   $view_follower_user[$i]['id_user'] ;
               
               echo "'>";
                
                echo " <img width='30' src='userpic_thumb/";
                
                echo $view_follower_user[$i]['current_image_user'];
   
                echo "' /> " ;                       
                
                echo " </a>";

 
                     
                     
                }
                
           echo "</div>"
 
                

    


?>


