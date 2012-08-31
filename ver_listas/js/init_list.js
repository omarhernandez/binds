

$(document).ready(function(){


 var jsonData =  globalVars();

 
   $.ajax({

    
    url : "ver_listas/class/get_list.php" ,


    type : "POST" ,


    dataType : "JSON", 

    data : {


				id_list : jsonData.id_list

    } ,

    success : function(data){


  		GetallFeedContentProfile(data);

    } ,

    error  : function(){

     binds.error();


    }


   });


});