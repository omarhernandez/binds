
$(document).ready(function(){ // aqui estan los botones cancelar y publicar ; los pongo en un archivo porque dos sitios preview y articulo usan las mismas funciones

 
jsonVarGlobal = globalVars();

$('#cncl_opt').click(function(){ // cancelamos y nos vamos a home
     
     
    window.parent.location="../home";  
     
     
})

 
 
 $('#shre_art').click(function(){
     
 if(tinyMCE.activeEditor.getContent()){
      
 
  
  
  //**************************************************************************************** le quitamos ../ a user image porque si no en profile no la muestra
     
         var post_article  =   tinyMCE.activeEditor.getContent().replace(/\.\.\//g, ''); // reemplazamos ../ 
 
 
  //********************************************************************************************
  
        $.ajax({
        
        type: "POST",
        url: "../post_articulo/class_article/upload_article.php",
       
        data:{    content:     post_article,     create_    :   jsonVarGlobal.user_id_global ,     setdata   :     jsonVarGlobal.data},
        beforeSend: setLoadersInit ,
        success: showAllComents,
        error: errorOnSendingMessage,
        timeout: 5000
        });
        
      
 }
 
 
 
 
 /*
 
 var imagesInEditr = $(tinyMCE.activeEditor.getContent()).children('img');  
     
     alert("dice tumblr que las suba directamente y redimencionemos con html")
     
     for(i=0;i<imagesInEditr.length;i++){
          
        alert(" with "+$(imagesInEditr[i]).attr('width')+ " height "+$(imagesInEditr[i]).attr('height')+" name "+$(imagesInEditr[i]).attr('src'));   
          
     }
     
   */  
  
      
 });
 
 
 function setLoadersInit(){
      
 }
 
  function showAllComents(){
      
   window.parent.location ="../profile.php?id="+jsonVarGlobal.user_id_current;
      
 }
 
  function errorOnSendingMessage(){
      
 }
 
 });
 
 
 