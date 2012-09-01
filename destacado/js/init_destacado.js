
/*
$(document).ready(function(){




$(".get_highlight_data").bind("click",function(){

 var jsonData =  globalVars();

 
   $.ajax({

    
    url : "destacado/class/init_destacados.php" ,


    type : "POST" ,


    dataType : "JSON", 

    data : {


				user_current : jsonData.user_id_current ,
				limit_post : 0

    } ,

    success : function(data){


  		GetallFeedContentProfile(data);

    } ,

    error  : function(){

     binds.error();


    }


   });

});



});








*/