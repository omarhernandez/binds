
$(document).ready(function(){
                  


 
 
                  // para suscribirse a un storyboard
 
                  $("#suscribe").live("click",suscribe_to);
                  
                  // para quitar la suscripcion
                 
                 $("#dropUs").click(drop_suscribe_to);
                  
 
 
                  function suscribe_to(){
                                    $("loadr").show();   

                                    json = getGlobalVars();
 
 
 
                                    $.ajax({
        
                                                      type: "POST",
               
       
                                                      url: "class/suscribe.php?status=suscribe",
                                                      dataType: "json",
                                                      data : { 
                                                                        "suscriber":json.user_id_global,
                                                                        "suscribeTo": json.global_id_view
 
                                                      },

     
                                                      success: function(){
                         $("#suscribe").html($("<img src='images/icon/ok.png' style='margin-top: 1px; margin-left: 4px; margin-right: 7px;' / ><strong style='    float: right; margin-top: 1px;'> Suscrito</strong>").fadeIn("slow"));
                       
                            $("#suscribe").die("click",suscribe_to);
                            
                            
                                 $("#countFollowers").children().children("strong").html( 
     
                                                                                    parseInt($("#countFollowers").children().children().html())+1

                                                                                           );
                            
                       
                                                      },
                                                      error: function(){
                       
                                                                 binds.error()
                       
                                                      },
                                                      timeout: 5000
                                    });
 
 
     
                  }

 
///*******************************************************************************************************************
//*******************************************************************************************************************

            
 
                              function drop_suscribe_to(){
                                    $("loadr").show();   

                                    json = getGlobalVars();
 
 
 
                                    $.ajax({
        
                                                      type: "POST",
               
       
                                                      url: "class/suscribe.php?status=drop",
                                                      dataType: "json",
                                                     data : { 
                                                                        "suscriber":json.user_id_global,
                                                                        "suscribeTo": json.global_id_view
 
                                                      },

     
                                                      success: function(){
                       
                       
                                                                                        $("#countFollowers").children().children("strong").html( 
     
                                                                                          parseInt($("#countFollowers").children().children().html())-1

                                                                                           );
                       
                       
                       
                                                                           $("#dropUs").html("<strong>Suscribirse</strong>")
                                                                            $("#dropUs").unbind();
                                                                             $("#dropUs").attr("id","suscribe");
                                                                             
                       
                                                      },
                                                      error: function(){
                       
                                                                binds.error()
                       
                                                      },
                                                      timeout: 5000
                                    });
 
 
     
                  }

            
                  
});
