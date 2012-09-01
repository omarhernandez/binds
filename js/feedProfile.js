$(document).ready(function(){	
  
  


  
   $(document).data('synchronized',0);
  
  
 /*  ESTA CLASE OBTIENE TODO EL FEED EN FORMA  CRONOLOGICA DE storyboard*/ 
  
  
  function errorOnSendingMessage(){
                             
   alert("demaciado tiempo");
   $('#coment').css('opacity', '.5');
   $('#Sendingcoments').css('display','none');
                             
                             
    }
                        
//*************************************************************************************************
               
        function setLoadersInit(){
    
      $('#loadingcoments').show();
  
        }
  //*************************************************************************************************

  
    function showAllFeedUser(data){ // empezamos a formatear el JSON recivido
         

    
         
  if(data.lstNwPst.length == 0){ // no hay feed procedemos a mostrar el mensaje de que no hay FEED
       
         
     $("#hlcontainer").append( $(getMessageNoFeed()).fadeIn('slow'));  // mostramos  EL MENSAJE DE QUE NO HAY FEED   
     
 
    restartValues(); 
       
  }else{ // si hay muchos comentarios

      GetallFeedContentProfile(data); // formateamos todo el JSON  (articulos preguntas comentarios imagenes videos etx)
      
//***************************************************************************************************************
 
     if( data.lstNwPst.length!=25){ // si aun hay comentarios para mostrar entonces que muestre el boton de paginacion
          
     
         $("#hlcontainer").append($(getStructurenoPost()).fadeIn('slow'));  // mostramos el boton de paginacion   
     }
   
   
      restartValues();  
      }  
         }
//*************************************************************************************************
       function restartValues(){
              
                // restablecemos los valores			 
	$("#comentArea").val("");
         $('#coment').css('opacity', '.5');
         $('#loadingcoments').hide();
              





         }
   
   
   
 // al cargar la pagina!!
 //*************************************************************************************************
 
  var  json = getGlobalVars();  
    
   
       $.ajax({
        
        type: "POST",
        url: "class/feedProfile.php?type=init",
        dataType: "json",
        data:{user_profile:json.id_user_view,show:"__f_post_activity"},
        beforeSend: setLoadersInit ,
        success: showAllFeedUser,
        error: errorOnSendingMessage,
        timeout: 5000
        });
        
  
     
//**************************************************************************************  
 //************************************************************************************** 

   //**************************************************************************************  
 //**************************************************************************************  
 
     // paginacion ***********************************************************************************************
  
$(window).scroll(function(){
    
  if  (($(window).scrollTop() + $(window).height() +140) >  $(document).height() ){
       
      
        
      if ( $(document).data('synchronized') == 0){
                        
            initPagination();
                        
      }
       

  }
  
});

      function initPagination(){
 
        $(document).data('synchronized',1)
          // NOTA : json.fdc es el documento php a llamar por ajax puede ser coment o cronology esto es para no repetir codigo y hacerlo con la misma funcion
        
          $(".__records").html("<img src='images/loader/p6.gif' >");
  
          var  json = getGlobalVars();  
          var viewPostActivity;
        
        
          switch(json.fdc){ // este switch es para ver que publicaciones se mostraran al usuario , si del storyboard ode su cronologia
              
               case "coment" : {
                    
                    viewPostActivity= json.id_user_view;
               }
               break;
              
               case "cronology" : {
                    
                    viewPostActivity= json.user_id_current;
               }
               break;
              
              
          }
  
  
 
          $.ajax({
        
               type: "POST",
               url: "class/feedProfile.php?type=init",
               dataType: "json",
               data:{
                    user_profile:viewPostActivity,
                    show:"__next_post"
               },
       
               success: showAllComentsPagination,
     
               timeout: 5000
          });
                        
                        
		 
     }
                
     function showAllComentsPagination(data){
          $(".__records").hide(); // quitamos el boton de arriba osea el primero de paginacion
          $(".__records").remove();
          
          
         GetallFeedContentProfile(data); // formateamos todo el JSON  (articulos preguntas comentarios imagenes videos etx)
   
    
   if( data.lstNwPst.length!=25){  
 
         $("#hlcontainer").append($(getStructurenoPost()).fadeIn('slow'));  // mostramos que no hay mas publicaciones   
     }else{
                       
                       $(document).data('synchronized',0);
                       
     }
   
          
     }
     
});


 