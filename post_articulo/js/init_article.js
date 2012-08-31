
$(document).ready(function(){

/*
 
 para su instalacion incluir 

     <link rel="stylesheet" type="text/css" href="post_articulo/css/articulo_style.css" media="screen" />
     <script language="javascript" type="text/javascript" src="post_articulo/tinymce/jscripts/tiny_mce/tiny_mce.js"></script> 
     <script language="javascript" type="text/javascript" src="post_articulo/js/init_article.js"></script> 
     y el css de los botones
 
 */


tinyMCE.init({
  
        language : "es", // change language here
        mode : "textareas",
	theme : "advanced",
	plugins : "style,paste,table",
	theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,|,outdent,indent,blockquote,link,unlink,image,code,forecolor,backcolor,spellchecker,fontsizeselect",
        theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "center",
	theme_advanced_statusbar_location: "none",
	theme_advanced_styles : "Titol blau=titol-blau;" , 
        width : "880",
        height : '410' 


 
});


 
$('#prvw_art').click(function(){// ponemos controladores para el boton de vista preeliminar
     
   
    $('#articleProc').attr('action',' preview.php')  ;  
    $('#articleProc').attr('target','_blank');
    
  
    $('#articleProc').submit();
   
     
});
 
 
 $('#file_image').change(function() { // restauramos los controladores para el boton de subir nueva imagen porque como usamos 2 form en uno hay que cambiar dinamicamente a donde se ira
       $('#loader_up').show(); // ponemos cargador
        $('#articleProc').attr('action','../post_articulo/class_article/article_class.php');
          
          $('#articleProc').attr('target','iframeUpload');
         $('#articleProc').submit();
     
 
      
 });
 
 
 
 
 
 
 });
 
 
 