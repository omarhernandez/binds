 
$(document).ready(function(){	

loader = "<img id='loadTip' src='images/loader/p0.gif ' style='margin-top:1px;position:absolute ;opacity:.6;display:none '>";
    
 $("body").append('  <div class="tip" >         <div id="tooltip" > </div></div>');
 $(".tip").hide();
  
  //***********************************************************************

 
function showTooltip(e,parent){
  
 
     $(".tip").fadeIn('slow');
     
   
  
   
     $(".tip").css({top : e.pageY -37, left : e.pageX - 1});
     $("#tooltip").load("class/tooltip.php?id="+$(parent).attr('href').replace('profile.php?id=',''));
  
  }
  
  //*********************************************************************** es la foto del usuario que esta el hover
  
function hideTooltip(){

	$(".tip").hide();  $("#tooltip").html("");
    
 }
 
 
 $(".imageUserTip").live('mouseover',function(){
      
         var config = {    // para el hover intent
      
     over  :  function(e ){            showTooltip(e,this);                }, // function = onMouseOver callback (REQUIRED)    
   
    timeOver: 900, // number = milliseconds delay before onMouseOut    
    timeout: 100, // number = milliseconds delay before onMouseOut    
    sensitivity: 4,
    out  :   function(){          hideTooltip();         } // solo le mandamos la posicion     } // function = onMouseOut callback (REQUIRED)    
};

$(".imageUserTip").hoverIntent( config )
 
      
 });
  

 //***********************************************************************
 

 
 

});
























  