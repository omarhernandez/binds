<?php

/*
En este archivo vamos a obtener todas las listas de intereses de x usuario por id
 */
include("../class.php");
 

switch ($_GET["type"]){

                  
                  case "get_intereset_list" : {
                                    
                     
$get_Data_interest_list_by_id = new lists_user();


$get_Data_interest_list_by_id ->get_interest_list($_POST["id_data"]);
        
                       
                                    
                  } break;
                  
case  "set_list_int" :  { // creamos la lista 
               
     
                  $set_Data_interest_list_by_id = new lists_user();
                  
                  $set_Data_interest_list_by_id->create_interest_list($_POST); // mandamos todos los datos en post y despues ahcemos extract
                  
                  }  break ;
                  
                  
case  "insert_into_list" :  { // creamos la lista 
               
     
                  $publication_into_interest_list  = new lists_user();
                  
                  $publication_into_interest_list ->insert_publication_into_interest_list($_POST);
                  
                  }  break ;                  

                  
                  case "c_c_pb":{ //check_clone_publication checar si ya se ha metido antes la publicacion
                                    
                          $check_clone   = new lists_user();   
                                    
                                  
                            $check_clone ->check_clone_publication($_POST);
                          
                          
                  }break;
                  
                  
}


        
?>
