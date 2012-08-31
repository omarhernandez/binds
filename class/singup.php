<?php

require_once("class/class.php");
include('class/imageClass/insert_image.php');
session_start();

class singup_user{

       
     
       public function  add_user(){
           
        
          $insertNewImage = new insert_Image();
          $urlImage =  $insertNewImage->image();   // insertamos la imagen
        
         
         
          
          $user_name = sanitizeString($_POST["user"]);          // sanitize
          $email = sanitizeString($_POST["email"]);
          $password = md5(sanitizeString($_POST["password"]));
          $url = sanitizeString($_POST["url"]);
          $lastname = sanitizeString($_POST["lastname"]);
          $name = sanitizeString($_POST["name"]);
          
 
   
          $sql="insert into user     
	 values
	(null,'".$user_name."','".$email."','".$password."','".$url."','".$name."','"
         .$lastname."','".$urlImage."');";  // insertamos datos de usuario
         
         
          $res=mysql_query($sql,Conectar::con());  // hacemos coneccion con mysql
          
       
	 $_SESSION["current_name"] = " ".$name." ".$lastname; // nombre completo 
         
         $_SESSION["current_user"]=   $user_name  ;  // usuario
         
         $_SESSION["current_photo"]=  $urlImage  ;   // imagen URL
         
         $_SESSION["current_id"]=mysql_insert_id();
         
          
        $follow = subscribe::getFollowCount($_SESSION["current_id"]);      
                  
        $_SESSION["current_followers"] = $follow[0]["Followers"];  
        $_SESSION["current_following"] = $follow[0]["Following"]; 
         
         
       echo  "<script> window.location = 'home.php';</script>";  
       
 
          
       }
           
 
     
  
    }
?>
