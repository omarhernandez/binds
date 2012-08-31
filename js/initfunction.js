$(document).ready(function() {

 
 
                  $(document).ready(function() {

 
                                    binds.Tabs({ // iniciamos la tabulacion de los menus

                                                      active   : "active_tabs" ,
                                                      
                                                        target     :"elementgeneric"       ,
                                                               
                                                   before    : function(){
                                                         
                                                      //   $(this).parent().attr("target","elementgeneric");
                                           //              $('body').append('<iframe name="elementgeneric" id="element_location"></iframe>');
                                 
                                                       },
                                 
                                                       success : function(){
                                                         
                                                         
                                   
                                             //            $("#element_location").contents().find('html').html("");          
                                                                         
                                                       },

                                                      tabs      : [ {
                                                                        tab : ".get_cronology_data" ,
 
                                                                        content : "#cronologyContainer"
                                                      } ,

{
                                                                        tab : ".get_list_data" ,
 
                                                                        content : "#ListContainer"
                                                      } ,

{
                                                                        tab : ".get_highlight_data" ,
 
                                                                        content : "#highlightContainer"
                                                      } ,

{
                                                                        tab : ".get_subscription_data" ,
 
                                                                        content : ".suscriptionsContainer"
                                                      } ,

{
                                                                        tab : ".get_config_profile" ,
 
                                                                        content : ".config_profile"
                                                      } ,

{
                                                                        tab : ".get_edit_profile" ,
 
                                                                        content : ".edit_profile"
                                                      }  ,

{
                                                                        tab : ".get_topic_popular" ,
 
                                                                        content : ".topic_popular"
                                                      } 



                                                      ]
                                    });
 
                  });
 
           
});






 