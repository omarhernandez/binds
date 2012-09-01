    <?php  // enviar por json 

      
      
        $id_user_view= $_SESSION["id_user_view"];
        $username_view =$user_or_topic_data[0]["user_name"];
        $num_limit_pagination= $_SESSION["limit_pagination"];
      
         // este JSON se usa para poner de forma global la informacion en storyboard
         
          if(!empty($_SESSION["current_id"])){ // si esta definido // si estamos logeados
              
               
          $user_id_current=     $_SESSION["current_id"] ;

          $global_id =   $_SESSION["global_id_current"] ;

 

           $global_id_view = binds::getTheGlobalIdUserOrTopic($id_user_view , $_SESSION["type_user"]  );   
      

      echo '<script>function globalVars(){
           
              var json = {  user_id_global:   '.$global_id.',  current_id :   '.$user_id_current.',  global_id_view : '. $global_id_view.' ,

                id_user_view :   '.$id_user_view.',   fllw_permision :   '.$imAlreadyFollowd.',  user_name_view:   '."'".$username_view."'".',

                set_location :   "profile" ,     fdc:   "coment" ,    __record :   '.$num_limit_pagination.', };     return json;

         }
           

</script>';
      
              
         }else{ // si somos visitantes
              
                  echo '<script>function globalVars(){
           
                  
                  var json = {   id_user_view :   '.$id_user_view.',   fllw_permision :   '.$imAlreadyFollowd.',  user_name_view:   '."'".$username_view."'".',   set_location :   "profile" ,   fdc:   "coment" ,   __record :   '.$num_limit_pagination.',  }; return json; }
           
 
</script>';
      
              
              
         }
         
         
  
      
      ?> 