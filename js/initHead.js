 
 
 $(document).ready(function(){
                   
       initfunctionHead();  
 
 function initfunctionHead(){

    /* efecto para cuando se pase el mosue  en alguna opcion se aparesca el menu oculto ( menu vertical )*/   
 
 
 $("#UserMenuOption").hover(function(){
                   
                   
      $("#MenuUserMenuOption").show();             
                   
 }, function(){
                   
     
     $("#MenuUserMenuOption").hide();
                   
 });
 

//****************************************************************************** 
//
var MAXSearch = 443; // tamañano maximo del input
var MINsearch = 213; // tamañano minimo del input
//
   //esta funcion es para cuando se hace click en el input de search se amplie su width 
  $("#search").focus (function(){
                      
 
    new fx(document.getElementById("search"),MINsearch,MAXSearch,'width','px',senoidal,900,false);


}) 


$("#search").blur(function(){

    new fx(document.getElementById("search"),MAXSearch,MINsearch,'width','px',senoidal,900,false); 


});
//******************************************************************************
 }
 });
 
