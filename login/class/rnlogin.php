<?php // rnlogin.php

require_once("../../class/class.php");
session_start();


if (isset($_POST) && !empty($_POST))  
{        
     if(!empty($_POST["user"]) || !empty( $_POST["password"]) ){  
                                   
        
     $initSession = new  login();
     $initSession->session($_POST);
 
     }else{
         
          
       echo "wrong";
          
          
    }
 
}
   
 

   
 

 
?>
