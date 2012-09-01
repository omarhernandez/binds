//************************** primero damos evento click al boton de pregunta

$(document).ready(function(){
    
    
    
                  $(".Quess").click(function(){
                      
                                    var datadata = "";
               
               
               
                                    datadata += " ";
                
                    
     //*****************************************************************************************************************         Pregunta                  
                                    datadata +=  " <table class='forms' id='tablafromurl'>";
     
                                    datadata+= "<tr>";
     
 
                                    datadata+= "<td>";
       
                                    datadata +=  '<div class="response_query">'+
                                    '<textarea  class="ques_add_  title_quess"  ></textarea>'; 
		
                                    datadata+= '<div id="errorPicLoad" ></div>';
           
                   
            
                                    datadata+="</td>";
            
                                    datadata+="</tr>";   
                                    

//*****************************************************************************************************************             descripcion                                      
            
                                    datadata+= "<tr>";                                
                    
       
                                    datadata+= "<td>";
       
                                    datadata +=  '<div class="response_query">  '+
                                    '<textarea class="ques_add_ desc_quess" ></textarea>';                                
                                    
                                    datadata+="</td>";
            
                                    datadata+="</tr>";     


 
//*****************************************************************************************************************          Interest    
 
                                    datadata+= "<tr>";                                
                                    datadata+= "<td>";
     
                                    datadata+= '<span class="pbox ">Enviar a :</span>  ';
	
                                    datadata+= "</td>";
       
                                    datadata+= "<td>";
       
                                    datadata +=  '<div class="response_query">'+

                                    '<input style="height: 26px; width: 183px; margin-right: 19px; margin-top: 5px;" />';  

          //*****************************************************************************************************************          boton   

                   datadata +=  '<a class="buttonOrange right makeQuess" type="button"  >Enviar</a>';             
                                    
                                    datadata+="</td>";
            
                                    datadata+="</tr>";     
             

 
 
                                     datadata +=  "</table >";
 
 
 
 
 
                      
                                    binds.box({
                                     
                                                      title : "Agregar Pregunta"
                                     
                                                      , 
                                                      content: datadata
                                                      ,
                                                      
                                                      success : function(){
                                                                    
                                                                        //*********************************************************************************************************************** para que los area se expandan cuando se acabe el espacio ( autocrece )

                                                                        $(".desc_quess").autoResize({
                                                                                          textHold: "Describe detalles de tu pregunta" , activeClass : "selectedarea"
                                                                        });              
                                                                    
                                                                    
                                                                        $(".title_quess").autoResize({
                                                                                          textHold: "Escribe el titulo de la pregunta" , activeClass : "selectedarea"
                                                                        });              
                                                                                                          
                                                                               
                                                                               
                                                                        $(".binds_box").css({
                                                                                          height : "auto"
                                                                        });
                                                                    
                                                                    
                                                      }
                                     
                                    });   
                      

 
 
                  });
     
 
//***************************************************************************************************************************************************************************************
//***************************************************************************************************************************************************************************************
//***************************************************************************************************************************************************************************************
//***************************************************************************************************************************************************************************************
// evento al boton de enviar la pregunta




$(".makeQuess").live("click" , function(){

alert("go");

});



});
