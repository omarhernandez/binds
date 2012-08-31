
$(document).ready(function(){
  
  
                  $(".add_topic").click(function(){
                    
             
             
             
             
             
                                    binds.box({
                               
                                                      title : "Selecciona una Categoria donde guardar tu interes" ,
                               
                                                      content :  getrandomCategories() ,
                               
                                                      height : "577"
                               
                                                      ,
                                                      left : "13%" ,
                               
                                                      top : "7%",
                               
                                                      width : "950" ,
                               
                               
                                                      before : function(){
                                                 
                                                                        $("#head").fadeOut("slow");
                                                                        $(".tickerheader").fadeOut("slow");                
                                                                          
                                                 
                                                      } ,
                               
                                                      onClose : function(){
                                                 
                                                                        $("#head").fadeIn("slow");
                                                                        $(".tickerheader").fadeIn("slow");                
                                                                          
                                                 
                                                      }
                               
                                    })
             
             
             
             
                    
                    
                  })
                  
                  $(".categorie").live("click" , function(){
                                    
                                    $(this).attr("id","sele");
                             
                                    $(this).css({
                                                      position : "absolute" 
                                                    
                                    });
                             
                                    $(".contentbox").fadeOut("slow" , function(){
                                               
                                                      $(this).children().not("#sele").remove();
                             
                             
                                    });
                  
                              
                                    $("#sele").css({
                                                      position : "" 
                                                     
                                    });
 
 
                                    $(".bindsbox").animate({
                                                      top:"20%"
                                    } , 310 , function(){
                  

                  
                                                      $(".binds_box").delay(130).animate({
                                                                        height :"227px"
                                                      },430 , function(){ 
                                                                        $(".categorie").removeClass("right");
                                                                        $(".categorie").addClass("left");
                                             
                                                                      //  $("#sele").hide();
                                                                        $(".contentbox").show();
                                                                        $(".contentbox").append(  $(getFormatFormToCreateInterest()).fadeIn("slow")  );
                                                                        $("#sele").fadeIn("slow");
                                                                        $(".categorie").show();
                                                      })
                                    
                                    });
                  
                  });
               
                  
                  $(".categorie").live("mouseover", function(){
                                    
                                    $(this).animate( {
                                                      opacity : 1
                                    } , 300);
                                    
                  });
                  
                  $(".categorie").live("mouseleave", function(){
                                    
                                    $(this).animate( {
                                                      opacity : .7
                                    } , 300);
                                    
                  });
                  //***************************************************************obtenemos las categorias en orden random
                  function getrandomCategories(){
                                  
                               
                                    $.ajax({
                                        
                                                      url : "add_topic/class/categories.php?type=rnd" ,
                                        
                                                      type : "POST" , 
                                        
                                                      dataType : "JSON",
                                        
                                                      success : function(data){
                                                    
                                                                        formatCategories(data);
                                                          
                                                      } ,
                                        
                                                      error : function(){
                                                          
                                                                        binds.error();   
                                                      }
                                                      
                                    });
                                    
                                    
                                    
                  }
                  
                  
                  function     formatCategories(data){
                              
                              
                                   // $(".contentbox").append( "<div class='textShadow'>Categorias</div>");
                     
                                    var formatCategories = "";
                                    
                                    $.each(data.response, function(i,item) { 
                                
                                
                                                      formatCategories ="   <ul class='UIlist-topic categorie' data="+item.idCategory+" >  <li > <img  style='width:182px;' src='photo/420f4524fcfb137aa5cc442d27312dc6.jpg'    /> </li><li class='name_categorie'> "+      item.name_category + " </li></ul>";
 
 
                                                      $(".contentbox").append($( formatCategories).delay(i*120).fadeIn("slow")   );
                                                      $(".categorie").removeClass("left");
                                                      $(".categorie").addClass("right");
 
                                    });
                                   
                                   
                                    $(".block").css({
                                                      "top": "8px"
                                    });    
                                    
                                    
                                    $("html:not(:animated),body:not(:animated)").animate({
                                                      scrollTop: $(".title").offset().top-10
                                    }, 100 ); 
                                    
                                    
                                     
                  }
                  
                  
                  //* obtiene el form para registrar interes
                  function getFormatFormToCreateInterest(){
                         
                         
                                    // primer input nombre
                                    sendToMyHighlight ="";
                                      
                                    sendToMyHighlight +=  "<div id='inside'><table class='forms' id='fromurl' style='margin-bottom: 5px;'>";
                                      
                                    sendToMyHighlight+= "<tr style=' margin-bottom: 30px;'>";
                                      
                                    sendToMyHighlight+= "<td>";
                                      
                                    sendToMyHighlight+= '<span class="pbox"> Nombre de Interes: </span>  ';
                                      
                                    sendToMyHighlight+= "</td>";
                                      
                                    sendToMyHighlight+= "<td>";
                                      
                                    sendToMyHighlight +=  '<div class="response_query">'+
                                    '<input   type="text"  class="name_interest" />'+
                                                        
                                    '</div>';
                                      
                                    sendToMyHighlight+="</td>";
                                      
                                    sendToMyHighlight+="</tr>";            
                                      
                                      
                                      
                                    //** segundo input  apellido
                                      
                                      
                                    sendToMyHighlight+= "<tr style=' margin-bottom: 30px;'>";
                                      
                                    sendToMyHighlight+= "<td>";
                                      
                                    sendToMyHighlight+= '<span class="pbox"> Descripcion: </span>  ';
                                      
                                    sendToMyHighlight+= "</td>";
                                      
                                    sendToMyHighlight+= "<td>";
                                      
                                    sendToMyHighlight +=  '<div class="response_query">'+
                                    '<textarea  style="width: 312px;" type="text" class="description_interest" ></textarea>'+
                                                        
                                    '</div>';
                                      
                                    sendToMyHighlight+="</td>";
                                      
                                    sendToMyHighlight+="</tr>";      
                                      
 
 
                                      
                                    //*************************** boton finalizar
           
                                    sendToMyHighlight+= "<tr style=' margin-bottom: 30px; clear: both;'>";
                                      
                                    sendToMyHighlight+= "<td>";
                                      
                                      
                                      
                                    sendToMyHighlight+= "</td>";
                                      
                                    sendToMyHighlight+= "<td>";
                                      
                                    sendToMyHighlight +=  '<div class="response_query">'; 
                                      
                                    sendToMyHighlight +=  '<a class="buttonOrange right set_interest_data" type="button" style="top: 60px;" >Crear Interes</a>';
                                    +
                                                        
                                    '</div>';
                                      
                                    sendToMyHighlight+="</td>";
                                      
                                    sendToMyHighlight+="</tr>";      
                                      
        
                                    sendToMyHighlight +=  "</table >";
                                      
                                    return sendToMyHighlight;
                         
                  }
       
       
       
                  /*  boton crear interes*/
       
       
                  $(".set_interest_data").live("click" , function(){
                      
                                    jsnvar =   globalVars();
 
                                    var    id_category =     $(".contentbox").children(":first-child").attr("data");
                                    var name_interest     =    $(".name_interest").val();
                                    var desc =     $(".description_interest").val();
                                     ("llego")
                                    if (name_interest.length > 2  && desc .length> 2)
      
      
                                                      $.ajax({
                                        
                                                                        url : "add_topic/class/categories.php?type=init" ,  // upload data init osea ingresar un nuevo topico
                                        
                                                                        type : "POST" ,                                       
                                        
                                                                        data  : {
                                                                                          categories : id_category  ,  
                                                                                          nm_int : name_interest , 
                                                                                          descrip : desc ,  
                                                                                          iusr : jsnvar. user_id_current
                                                                                          } , 
                                                                        success : function(){
                                                    
                                                                         window.location.href="interest/"+name_interest;
                                                                        
                                                                        } ,
                                        
                                                                        error : function(){
                                                          
                                                                                          $("#head").fadeIn("slow");
                                                                                          $(".tickerheader").fadeIn("slow");            
                                                                                          binds.error();   
                                                                        }
                                                      
                                                      });
                                    
                         
                         
                  });
                         
       
       
       
});