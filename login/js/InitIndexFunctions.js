/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
                  
 
 
 
 $(".buttonAcces").click(function(){
       
       show_form();       
                
 });
 
 
                  //************************************************************************************
                  $("#BSubM").click(function(){  // click en boton registrar
                   
        
                            register_user();
                   
                  });
        
        
                  //************************************************************************************
        
        
        
                  // click en boton entrar
                                                                                   
                  $(".log-in").click(function(){  // click en boton registrar
                   
                                    login_user();
 
                   
                  });                                                                 
 
 //*************************************************************************** logearse con un enter
                  $("#passwordUser").bind("keyup", function(event){
                   
                   
                                    if( event.which == 13){
                                 
                                                      login_user();           
                                 
                                 
                                    }    
     
                   
                  });
 
 
                  function login_user(){
                    
                    
                                    $("#login").attr("action" , "login/class/rnlogin.php" );
                                    $("#login").submit();
     
                    
                  }
                  
                  
                  
                  function register_user(){
                                    
                                    
                                    $("#sender").attr("action" , "login/class/rnsingup.php" );
                                    $("#sender").submit();
                                    
                  }
                                                                                                        
        //************************************************************************************                                                                           
 
 
 
                  $(document).data('next',0);
 
                  //Inputs.init();
                  //Inputs.checkInputEvent();

 
                  $("#NextForm").click(function(){  // click en boton de unirse a binds ahora
                   
                   show_form();

                  });
     
     
     
     
     function show_form(){
                       
                                         $(document).data('next' ,  $(document).data('next')+1 );
                    
                                     (   $(document).data('next'))
                    
                                    switch(  $(document).data('next')){
                                      
                                      
                                      
                                                      case 1 : {
                                                                 
                                                                 
                                                                  $("#JoinUsMessage").animate({   top : "460px"  , opacity : "0"},600 );
                                                                 
                                                                              $("#JoinUsMessage").fadeOut(150,function(){
                                                                                                
                                                                                                
                                                                                          $("#JoinUsMessage").removeClass("buttonAcces");
                                                                                           $("#JoinUsMessage").removeClass("blueB");
                                                                          
                                                                 
                                                                          
                                                                          
                                                                          
                                                                                          $("#JoinUsMessage").html("Esto tomara pocos segundos!").fadeIn("slow");
                                                                           $("#JoinUsMessage").css("opacity" , "0")
                                                                                          $("#JoinUsMessage").animate({     top: "200" , opacity : "1" } ) ;            
                                                                                                
                                                                                                
                                                                              
                                                                                                            $("#slideForm").fadeIn("slow");       
                                                                                         
                                                                                              
                                                                                                            $("#BSubM").show();
          
                                                                                                            $("#BSubM").css("height","38");
                                                                                                          $("#JoinUsMessage").fadeIn("slow");                  
                                                                        })
                                                                                             
                           
                                                                          
                                                      }
                                                      break;
                                                        
                                                      case 2 : {
                                                                          
                                                      
                                                                        $("#slideForm").fadeOut("slow", function(){
                                                      
                                                      
                                                      
                                                                                          // cambiar el mensaje a mostrar de JoinUsMessage por genial , !
   
                                                                                          $("#JoinUsMessage").html("Esto tomara pocos segundos!");

                                                                                          $("#BSubM").show();
          
                                                                                          $("#BSubM").css("height","38");
          
                                                                                          $("#newButton").hide();
                                                                                          // obtener el id del segundo fomr a mostrar

                                                                                          //**************************++
                                                                                          $("#slideForm2").fadeIn("slow");
                                                      
                                                                        })                              
                                                                          
                                                                          
                                                      }
                                                      break;
                                    }
                       
                       
     }
     
          
                  //**********************************************************************************************************************
                  //*********************** CHECAR USUARIO DISPONIBLE AJAX **************************************************************** 
                  //**********************************************************************************************************************
 

 
                  $("#registerUser").blur(function(){
                   
                   
 
         
                                    $.ajax({
                           
                           
                                                      type : "POST" ,
             
                                                      url : "class/rncheckuser.php",
             
                                                      data : {
                                                                        user : $(this).val()
                                                      } ,
             
                                                      before : function(){
                               
                               
                                                                        $("#respuesta").html("verificando usuario..");
                                                      }
                                                      ,
                                                      success : function(data){
                               
                                                                        if(data!=1){   
               
                                 
                                                                                          $('#registerUser').addClass("ok"); 
                                                                                          $("#respuesta").html("Hey <strong></strong> Suena Genial !");    
            
            
                                                                        }else // si el usuario no existe ..
                                                                        {
                                                                                          $('#registerUser').addClass("fail"); 
                                                                                          $("#respuesta").html("Lo sentimos , este usuario ya esta en Binds");    
                                                                        }      
                               
                               
                                                      }
             
                                    });
         
         
         

 
 
                                    function error(){
      
                                                      alert("error");
      
                                    }          
                   
                   
                  })
 
                  
                  
                  
});
 
  
//**********************************************************************************************************************
//*********************** FIN  CHECAR USUARIO DISPONIBLE AJAX ********************************************************* 
//**********************************************************************************************************************
 
 