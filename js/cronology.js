/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


 $(document).ready(function(){	
 
   
   
     // al cargar la pagina!!  INIT cronology coments
  
   
 //*************************************************************************************************

    json = getGlobalVars();  
    
   
         $.ajax({
        
        type: "POST",
        url: "class/cronology.php?type=init",
        data : {"user_profile":json.user_id_current,show:"__f_post_activity"},
        dataType: "json",
        beforeSend: setLoadersInit ,
        success:showCronology,
        error: errorOnSendingMessage,
        timeout: 5000
        });
   
   
   
   
  
     function showCronology(data){
   
      if(data.lstNwPst.length == 0){ // no hay comentarios
       
         
      $("#cronologyContainer").prepend(  $(getMessageNoFeed()).fadeIn('slow'));  // mostramos  EL MENSAJE DE QUE NO HAY FEED   
      
       $('#loadingcoments').hide();
       
  }else{ // si hay muchos comentarios


 
        GetallFeed(data,"#cronologyContainer");  // mostramos el contenido ( comentarios )  y de hi nos enlazamos a los demas contenidos 
                                                                                          // Articulos preguntas videos , ( en cronology.php sacamos la info de todos los content types )
   
        $('#loadingcoments').hide(); 
        
        
          if( data.lstNwPst.length==25){ // si aun hay comentarios para mostrar entonces que muestre el boton de paginacion
          
     
    
     }else{
          
          $("#cronologyContainer").append( $(getStructurenoPost()).fadeIn('slow'));  // mostramos el boton de paginacion   
     }
        
        
    
 } 
      
 
     }
     
        
        function setLoadersInit(){
    
      $('#loadingcoments').show();
     
}  

 function errorOnSendingMessage(){
      
      alert('algun error inesperado');
      
 }
              
//*************************************************************************************************
     
});