 $(document).ready(function(){	
     
 //1.- al dar click en publicar muesta la lista de posibilidades "para publicar"
//2.- al dar click en get_list_user muestra todas nuestras listas
//3.- al dar click en cambiar imagen sale modal box para insetar neuva imagen
//4.- al dar click en una lista salen todos los contenidos de esa lista
//************************1*********************************************
//************************1*********************************************
//************************1*********************************************


$(".out").click(function(){
    
    $(this).parent().attr("href" , "login/class/rnlogout.php");
                  
                  
});
//*****************************************************************************
//*****************************************************************************

             $("#tggleInterest").bind("click",function(){
 
 
 
 $("html:not(:animated),body:not(:animated)").animate({    scrollTop: $(this).offset().top-10   }, 1200 ); 
 
            $('#InterestContainer').fadeIn("slow");
 
 } );
//*****************************************************************************


$(".get_list_user").bind("click", function(){
                  
    
binds.getInterestList({
                  
                  append : "#ListContainer"
                  
                  
});
    
                  
                  
});



//************************************************ 2 ****************************************
//************************************************ 2 ****************************************
//************************************************ 2 ****************************************
//************************************************ 2 ****************************************
//************************************************************************************ eventos para poder cambiar imagen de portada de lista  *****************************************
 

                  $('.UIlist-topic').live('mouseenter', function(event) {
                             
                             
                             
                                    $(".update_image_list").remove();
                                    $(this).children(".change_image").append("<span  class='update_image_list' >Cambiar Portada<span>");
                  
                                    $(this).fadeTo("slow")
                  
                  }).live('mouseleave', function(event) {
  
                                    $(this).fadeTo("fast")
 
                                    $(".update_image_list").fadeOut(function(){
                                      
                                                      $(this).remove();
                                      
                                    });
         
         
                  });

 
 
//************************************************ 3 ****************************************
//************************************************ 3 ****************************************
//************************************************ 3 ****************************************
//************************************************ 3 ****************************************
//**************************************************************************************************************************************************
 
  

                  $(".update_image_list").live("click", function() {
                  
                   
                             
           update_list ="";
            
            update_list +=  "<table class='forms'  >";
     
            update_list+= "<tr>";
     
            update_list+= "<td>";
     
           update_list+= '<span class="pbox"> Seleccionar imagen:</span>  ';
       
            update_list+= "</td>";
       
            update_list+= "<td>";
       
            update_list+= '<div class=" "><input type="file"   class="live-tipsy"   ></div> ';
       
            update_list+= "</td>";
       
           update_list+= "</tr>";
 
            update_list +=  "</table >";      
                             
                             
           binds.box({
                             
                                                      title: "Cambiar  imagen de portada"             , 
               
                                                      content : update_list  ,
               
                                                      height               :                 "82" ,
                                                      
                                                      top                     :                   "35%"
                             
                                    });
           
           
                           
       });
       
//*************************************************** 4  ******************************************** 
//*************************************************** 4  ******************************************** 
//*************************************************** 4  ******************************************** 
//****************************************************************************************** obtener los contenidos de las listas
//*************************************************** 4  ******************************************** 



$(".image-list").live("click",function(){

 //window.location ="PATH/home/interest_list/viewlist.php?user=3434&list=23434&list_name=yoga";   
 

                  
});



});
 
