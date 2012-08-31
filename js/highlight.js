
// este archivo contiene los metodos para enviar a mis listas alguna publicacion asi como las llamadas ajax
// 1.- mostrar modal binds al dar click en enviar a mis listas
// 2.-       // enventos para salvar mis listas
//3.- busqueda instantanea para obtener las listas al agregar un post a mis listas
//4.- al dar cliock en destacados enviar la publicacion a destacados


$(document).ready(function(){
      
      
      highlight = new Object();
      
        highlight.id_post = "";
        highlight.type_post = "";
        
      $(".add_to_list").live("click", function(){
   
            //************************************* 1**************************************************
            //************************************* 1**************************************************
            //************************************* 1**************************************************

            sendToMyHighlight ="";
            
            sendToMyHighlight +=  "<table class='forms' id='testingform'>";
     
            sendToMyHighlight+= "<tr>";
     
            sendToMyHighlight+= "<td>";
     
            sendToMyHighlight+= '<span class="pbox"> Selecciona la lista :</span>  ';
       
            sendToMyHighlight+= "</td>";
       
            sendToMyHighlight+= "<td>";
       
            sendToMyHighlight+= '<div class="response_query"><input type="text"   class="live-tipsy"   id="get_list_data" original-title="Busca la lista donde deseas guardar la publicacion ó Escribe el nombre y se creara automaticamente."></div> ';
       
            sendToMyHighlight+= "</td>";
       
            sendToMyHighlight+= "</tr>";
      
    /*        sendToMyHighlight+= "<tr>";
     
            sendToMyHighlight+= "<td>";
      
            sendToMyHighlight +='<span class="pbox"> Titulo ( opcional ) :</span>  ';
     
            sendToMyHighlight+= "</td>";
       
            sendToMyHighlight+= "<td>";
     
            sendToMyHighlight+= '<input type="text"  class="live-tipsy"  id="get_title_highlight" original-title="Las personas que estan suscritas a ti  veran la publicacion en destacados con este titulo"> ';
     
            sendToMyHighlight+= "</td>";
     
           sendToMyHighlight+= "</tr>";
     */
            sendToMyHighlight +=  "</table >";
     
            sendToMyHighlight +=  '<a   class="buttonOrange listButton right save_add_to_list" type="button">Guardar</a>';
     
            binds.box({ // damos formato al box
                  title:"Guardar en mi Lista" ,
                  height:"110" ,
                  top :"33%",
                  content : sendToMyHighlight
            }) ;
 
            $('input.live-tipsy').tipsy({ // llamamos el tipsy ( tooltip)
                  live:true , 
                  trigger: 'focus', 
                  gravity: 'w'
            });
   
                highlight.id_post =    $(this).parent().parent().parent().attr("id");
                
                highlight.type_post =    $(this).parent().parent().parent().attr("datatypepost");
 
     
      });
      //***************************** 2************************************
      ////***************************** 2************************************
      ////***************************** 2************************************
 
      // enventos para salvar mi destacado

      $(".save_add_to_list").live("click",function(){
      
      // id="get_list_highlight" // input del nombre de lista
      // id="get_title_highlight" // input de titulo
      
            lista =    $("#get_list_data").val();
           id_lista =  $("#get_list_data").attr("data_list");
     
     $("#show-loader-box").show();
    
    
        //    titulo = $("#get_title_highlight").val();
 

 //  1.- si al guardar la publicacion en destacados no se guarda ni tutulo ni lista , entonces procedemos a enviar la publicacion a DESTACADOS TAL CUAL FUE CREADA
//  2.- si al guardar la publicacion en destacados se ingresa nombre de lista  entonces se guarda el post en la lista seleccionada , se envia a destacados con el nuevo titulo



  //  destacados       - -----------           id_destacado | id_usuario_envio_post | id_post | fecha_envio_destacado  | post_type

  //  listas                 - -----------            id_lista | id_user | nombre_lista | 
  
  //conenido_listas    ---------             id_contendo_lista | id_post | id_lista | post_type
      
 
                                    if(  ( lista.length   == 0  /* &&    titulo.length  == 0*/) ){
       
                                                       
                  
                                    }else{
                                                      
                                                      if(  !binds.already_exist_list ) { // si se esta mostrando el error de la publicacion existe entocnes que no haga nada y espere nuevos datos
       
                                                      if(  ( lista.length   )  > 0 ){  // envia a mi lista y tambn mandalo a destacados
        
   
                                                                
                                                                        switch( binds.content_available  ){
                                                                           
                                                                                  
                                                                                          case true : {  // si en la busqueda la busqueda  si esta disponible entonces solo que guarde en la lista el post y mande a destacados
                                                                                                       
                                              
                                              
                                                                                                                   switch(  binds.force_create_list ){
                                                                                                                                       
                                                                                                                                       
                                                                                                                                       
                                                                                                                                       
                                                                                                                              case  true :  {
                                                                                                                                           
                                                                                                                         
                                                                                                                         
                                                                                                                                                binds.createInterestList({  // creamos la lista
   
                                                                                                                                                                  data : lista   
                                                                      
                                                                                                                                                });
                                                                                                                         
                                                                                                       
                                                                                                                                   binds.notify({content : " Se ha creado la lista <strong>"+lista +"</strong>"});      
                                                                                                       
                                                                                    
                                                                                                                              }             
                               
                                                                                                                              case false:{
                                              
                                                                                                                                                binds.insert_publication_into_interest_list({   // guardamos la publicacion en la lista d einteres
                                                                                                                          
                                                                                                                                                                  id_post                                                              :  highlight.id_post ,
                                                                                                                                                                  id_lista                                                              :  id_lista ,
                                                                                                                                                                  type_post                                                          :  highlight.type_post          
 
                                                                                                                                                });
                                                                                                                                                
                                                                                                                        
                                                                                                                                                
                                                                                                                                    //                               close_binds_box()
                                                                                                            
                                                                                                                                           
                                                                                                                                          
                                                                                                                                           
                                                                                                                              }break;
                                                                                                            }
                                                                                          }break; 
                                                                                          
                                                                                          
                                                                                          
                                                                                          case false : { // si no esta disponible osea no ha sido creada la lista , que se cree la lista que se guarde el contenido en la lista y se envie a destacados
                                                                                                            
                                                                                                            binds.createInterestList({  // creamos la lista
                          
                                                                                                       
                                                                                                                              data : lista , // nombre de la lista 
                                                                                                       
                                                                                                       
                                                                                                                              success_created_list  : function(){
                                                                                                                    
                                                                                                                                     
                                                                                                                                                highlight.lastID = this.new_id_list;
                                                                                                              
                                                                                                                                                binds.insert_publication_into_interest_list({   // guardamos la publicacion en la lista d einteres
                                                                                                                          
                                                                                                                                                                  id_post                                                              : highlight.id_post ,
                                                                                                                                                                  id_lista                                                              :  highlight.lastID ,
                                                                                                                                                                  type_post                                                          :  highlight.type_post          
 
                                                                                                                                                });
                                                                                                                   
                                                                                                                              }});
                                                                                                            
                                                                                                            
                                                                                           close_binds_box();         
                                                                                          binds.notify({content : " Se ha creado la lista <strong>"+lista +"</strong>"});        
                                                                        
                                                                    
                                                                                          }
                                                                                          break;
                                                                                  
                                                                                  
                                                                        }
        
        
 
 
                                                      } 
                                    }
                  }
                  });


//************************************** 3******************************************************************************
//************************************** 3******************************************************************************
//************************************** 3******************************************************************************
//**********************************************************************************************************************
// busqueda instantanea para los inputs

$("#get_list_data").live("keyup",function(event){
      
 
 
            binds.searchInstant({

                  data: $(this).val(), // el valor

                  id_element: $(this) , // el elemento input

                  type :"get_list" ,// obtener las listas 
                  
                  event : event , // le pasamos el evento de las teclas
                  
                  append : ".response_query" // id del elemento para append response ajax
          
            });
 
 
  
});

 



});


// function improvisada
function close_binds_box(){

        
                                                                                                                                                   $(".bindsbox").fadeOut("slow" , function(){ 
                                                                                                                                                                  $(this).remove();
                                                                                                                                                                  $('.block').remove() ;
                                                                                                                                                                  $('body').css({
                                                                                                                                                                                    'overflow' : "visible"
                                                                                                                                                                  }) 
                                                                                                                                                                  $(".tipsy").remove();
                                                                                                                                                });


}
//**********************************************************************************************************************************************************
////**********************************************************************************************************************************************************
////********************************************************* ENVIAR A DESTACADOS ******************************************************************
////**********************************************************************************************************************************************************
//**********************************************************************************************************************************************************
 
$(".add_to_highlight").live("click",function(){
                  
                  var post =    $(this).parent().parent().parent();
                 
                  var   post_id      =  $(post).attr("id");
                 
                  var   post_type   =   $(post).attr("datatypepost");
 
                  jsonVar  =  getGlobalVars();
                
   //*********************************************************************************** checar si existe el post en destacado que un usuario haya enviado             

CHECK_IF_USER_ALREADY_SEND_TO_HIGHLIGHT();


//**************************************************************************************
                
                
 function INSET_INTO_HIGHLIGHT(){                
                   
                  $.ajax({
        
                                    type: "POST",
 
                                    url: "class/highlight/highlight.php?type=send_to_highlight",
                               //     dataType: "json",
                                    data : {
                                                      "user_set":jsonVar.current_id,
                                                      "id_post": post_id,
                                                      "post_type" : post_type
                                    },
                                    //      beforeSend: setLoaders ,
                                    success: function(){
                                  
                                                      binds.notify({
                                   
                                                                        content: " Se ha enviado a destacados"
                                   
                                                      });
                                      
                                    },
                                    error: function(){ binds.error() },
                                    timeout: 5000
                  });
          
 } 
      //********************************************************************************************
      
      function CHECK_IF_USER_ALREADY_SEND_TO_HIGHLIGHT(){
                        
                         jsonVar  =  getGlobalVars();
                         
                                     $.ajax({
        
                                    type: "POST",
 
                                    url: "class/highlight/highlight.php?type=c_p_h",  // c = check , p = post , h highlight checar si el usuario ya lo envio al highlight
                                    dataType: "json",
                                    data : {
                                                      "user_set":jsonVar.current_id,
                                                      "id_post": post_id,
                                                      "post_type" : post_type
                                    },
                                    //      beforeSend: setLoaders ,
                            success: function(data){
                                  
                                       
                                       if(data.response == true){
                                                         
                                                                        binds.notify({
                                   
                                                                        content: " Ya has enviado esta publicacion a destacados"
                                   
                                                      });
                                       }else{
                                                         
                                         INSET_INTO_HIGHLIGHT();
                                                         
                                       }
                                       
                                      
                                    },
                                error: function(){ binds.error() },
                                    timeout: 5000
                  });  
                        
                        
      }
      
                  
})
