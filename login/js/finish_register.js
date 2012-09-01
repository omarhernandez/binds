 
function finish_register(){
                 
                  jsonV = globalVars()
           
                          
                  $.ajax({
                                                                      
                                                                      
                                                                      
                                    url : "login/class/finishregister.php",
                                                                      
                                    type : "POST" ,
                                                                      
                                    data : {
                                                      name :  $(".name_user").val() , 
                                                      last :  $(".last_user").val()  , 
                                                      url : $(".url_user").val() , 
                                                      id__ :   jsonV.user_id_current
                                    } ,
                                                                      
                                    success : function(){
                                                                                        
                                                      $(".bindsbox").fadeOut("slow" , function(){ 
                                                                        $(this).remove();
                                                                        $('.block').remove() ;
                                                                        $('body').css({
                                                                                          'overflow' : "visible"
                                                                        }) 
                                                                        $(".tipsy").remove();
                                                                          
                                                                        $("#head").fadeIn("slow");
                                                                        $(".tickerheader").fadeIn("slow");       
                                                                          
                                                      });
                                    }
                  })

}
                                      
                                      
$(".get_home_register_").live("click", function(){
                                                        
                                                        
                  finish_register();            
});
                                      
 
 
 function set_last_register(){
                   
                   
                   
 
// primer input nombre
sendToMyHighlight ="";
                                      
sendToMyHighlight +=  "<div id='inside'><table class='forms' id='fromurl' style='margin-bottom: 5px;'>";
                                      
sendToMyHighlight+= "<tr style=' margin-bottom: 30px;'>";
                                      
sendToMyHighlight+= "<td>";
                                      
sendToMyHighlight+= '<span class="pbox"> Nombre: </span>  ';
                                      
sendToMyHighlight+= "</td>";
                                      
sendToMyHighlight+= "<td>";
                                      
sendToMyHighlight +=  '<div class="response_query">'+
'<input   type="text"  class="name_user" />'+
                                                        
'</div>';
                                      
sendToMyHighlight+="</td>";
                                      
sendToMyHighlight+="</tr>";            
                                      
                                      
                                      
//** segundo input  apellido
                                      
                                      
sendToMyHighlight+= "<tr style=' margin-bottom: 30px;'>";
                                      
sendToMyHighlight+= "<td>";
                                      
sendToMyHighlight+= '<span class="pbox"> Apellido: </span>  ';
                                      
sendToMyHighlight+= "</td>";
                                      
sendToMyHighlight+= "<td>";
                                      
sendToMyHighlight +=  '<div class="response_query">'+
'<input   type="text" class="last_user" />'+
                                                        
'</div>';
                                      
sendToMyHighlight+="</td>";
                                      
sendToMyHighlight+="</tr>";      
                                      
// URL 
                                      
sendToMyHighlight+= "<tr style=' margin-bottom: 30px;'>";
                                      
sendToMyHighlight+= "<td>";
                                      
sendToMyHighlight+= '<span class="pbox"> URL: </span>  ';
                                      
sendToMyHighlight+= "</td>";
                                      
sendToMyHighlight+= "<td>";
                                      
sendToMyHighlight +=  '<div class="response_query fixurldiv">'+
                                                        
'<span class="nmeurl"> www.binds.me/</span> '+
                                                        
                                                        
'<input   type="text"  class="fixurlinput url_user"/>' +
                                                        
'</div>';
                                      
sendToMyHighlight+="</td>";
                                      
sendToMyHighlight+="</tr>";      
                                      
//*************************** boton finalizar
           
sendToMyHighlight+= "<tr style=' margin-bottom: 30px;'>";
                                      
sendToMyHighlight+= "<td>";
                                      
                                      
                                      
sendToMyHighlight+= "</td>";
                                      
sendToMyHighlight+= "<td>";
                                      
sendToMyHighlight +=  '<div class="response_query">'; 
                                      
sendToMyHighlight +=  '<a class="buttonOrange right get_home_register_" type="button" style="top: 60px;" >Empezar a usar Binds</a>';
+
                                                        
'</div>';
                                      
sendToMyHighlight+="</td>";
                                      
sendToMyHighlight+="</tr>";      
                                      
        
sendToMyHighlight +=  "</table >";
                                      
                                      
binds.box({
                      
                  content : sendToMyHighlight  ,
                       
                  title : "Puedes omitir este paso y llenarlo despues "
                                                        
                  ,
                  before : function(){
                                                                          
                                    $("#head").fadeOut("slow");
                                    $(".tickerheader").fadeOut("slow");                
                                                                          
                
                  }
                                                        
}); 


}