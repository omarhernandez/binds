
// obtenemos el fondo de pantalla del usuariio

var dataUser  = globalVars();

$.ajax({
                  
    url : "profile/class/load_data_profile.php" ,
    
    data : {usr: dataUser.id_user_view} ,
    
    success : function(data){
                      
                    
 
             
               if(data.response.length >0 ){
                                 
                                  $("body").css({"background-image" : "url('photo/"+data.response[0].bg+"')"} );   
               }
               
            
                      
    },
    
    
    error : function (){
                      
                      binds.box();
                      
                      
    }
    ,
    type: "POST",
    
    
    dataType : "json",
    
    timeOut : 12000
                    
                  
                  
});


