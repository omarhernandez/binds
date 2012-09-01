$(document).ready(function(){
                  
 
 
 
                  $(".view_article").live("click" , function(){
                   
      
                                    $("#head").fadeOut("slow");
                                    $(".mainContainer").fadeOut("slow");
                                    $(".tickerheader").fadeOut("slow");
 
 
 
 
                                    //*************************************************************************************************************************** obtenemos el nombre y foto del usuario
                                    var a =   $(this).parent().parent().parent().children(".headArtic").clone();
                           
  
                                    $(a).children(".rankstartsfixedart").remove();

                                    //************************************************* sacamos parte del articulo de comentar , comentarios y fecha
                                  
                                  var time = $(this).parent().clone();

                                  $(time).children(".view_article").remove();
                                  
                        
                                  //***************************************************************************************************************************
  
                                    var destination = $(this).offset().top; // obtenemos el top del articulo al que se le dio click para volverlo a posicionar
                                    //***************************************************************************************************************************
 
 
                                    var header=  '<div class="headArtic">'+$(a).html() +'</div>';
                          
                                    var  content_article =   $(this).parent().parent().parent().find(".UiMSG").html();


       
                                    var article_content = content_article;

                          
                                    var coment= '<div class="ui_show_article_cmnt"> coemnts </div>';

                   
                                  var timeAndComent = '<div class="ui_show_state_art">' + $(time).html()  + '</div>';
                
                
                
   
          
               
                
                                    binds.box({
                                                      
                                                      
                                                      top : "4px",
                                                      width:"1000",
                                                      left : "4%",
                                                      height : "auto" ,
                                                      title : header,
                                                      style : false ,
                                                      content : article_content + timeAndComent+ coment  ,
                         
                                                      onClose : function(){
                                            
                                                                        $("html:not(:animated),body:not(:animated)").animate({
                                                                                          scrollTop: destination-600
                                                                                          }, 1200 );

                                                
                                                                        $("#head").fadeIn("slow");
                                                
                                                                        $(".mainContainer").fadeIn("slow");
                                                                   $(".tickerheader").fadeIn("slow");
                                        
                                                      }
                         
                         
                                    });
 
 
 
 
                          
                       
                                 
           

                 $(".bindsbox").addClass("wrappr_art") ;       // contenedor del articulo el transparente
     
                  $(".bindsbox").removeClass(".bindsbox");

                  $(".binds_box").addClass("cntainr_shr_art"); // contenedor del articulo // texto
                  
                  $(".binds_box").children(".contentbox").removeClass().css({

                        marginTop : "59px"
                  });

                  

                                 



 
                                    if($(this).parent().parent().parent().attr("datatypepost") == 5){
                                  
              
                                                      $("div.ui_show_article").css({
                                                                        textAlign : "center" ,

                                                                        width : "1017px"
                                                      });

                                  
 
                          
                                                 $("div.ui_show_article").children("p").addClass("des_photo");

                                                  $("div.ui_show_article").children("p").addClass("trip");

    
                                  
                                    }
               
     
                $("html:not(:animated),body:not(:animated)").animate({
                                                                                        scrollTop:   0
             } , 70  );
    
                   
                  });
 
                  
});