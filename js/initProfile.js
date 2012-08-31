
$(document).ready(function(){	
 
     
     $("#Quess").bind("click",function(){
          
           $('#QuestionContainer').slideToggle(300);
             
          
     })
     
 $(".out").click(function(){
    
    $(this).parent().attr("href" , "login/class/rnlogout.php");
                  
                  
});

 
 
   
});

