    <?php  // enviar por json 
      
       
      
        $user_id= $_SESSION["current_id"];
  
         $dataInfoId = $_SESSION["article"];  // para saber en donde estamos al publicar algun dontenido , puede ser en profile o home


 $global_id =   $_SESSION["global_id_current"] ;
 
echo '<script>function globalVars(){
           
                                  var json = {  user_id_global:   ' . $global_id . ',
                                                
                                                                 url :  "'. $_SESSION["url"] .   '",
                                                                   
                                                                 fdc:   "cronology" , 

                                                     user_id_current : '. $user_id.'   ,

                                                       set_location :   "cronology"  ,
                                                       
                                                      data :   ' . $dataInfoId . ' 

                                             };
                                                    
                           return json;

                                    }
           


</script>';
      
      
      ?> 