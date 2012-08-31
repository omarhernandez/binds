<?php

session_start();


?>
<html>
     
     <title> </title>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>   
     <head>
   
             <link rel="stylesheet" type="text/css" href="../css/reset.css"  />
        <link rel="stylesheet" type="text/css" href="../css/profile.css"  />
         <link rel="stylesheet" type="text/css" href="../css/buttons.css"  />
          <link rel="stylesheet" type="text/css" href="css/style_preview.css"   />     
   
       
           <script type="text/javascript" src="../js/jquery-1.6.js" ></script>    
          
     <link rel="stylesheet" type="text/css" href="css/articulo_style.css" media="screen" /> <!-- scripts articulos -->
     <script language="javascript" type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script> 
     <script language="javascript" type="text/javascript" src="js/init_article.js"></script> 
     
        <link rel="stylesheet" type="text/css" href="../style_file/css/style_file.css" media="screen" />
         <script language="javascript" type="text/javascript" src="../style_file/js/si.files.js"></script> 
          <script language="javascript" type="text/javascript" src="../style_file/js/init_style_file.js"></script> 
       
          <script language="javascript" type="text/javascript" src="js/init_preview.js"></script> 
          
     
     
     </head>
     
     
     
     
     <body>
          <div  class="wrappr_art">
          
    
            
               <div  class="cntainr_shr_art">
                    

                     
                    
                               
                    <div class="maincontainerArt"> <!-- EMPIEZA ARTICULO -->
                       <p class="titleApp" >Crear un articulo</p>
                    
                    <div class="containerArticle" >
                      
                         
                         <form id="articleProc" name="form" method="post" action="../post_articulo/class_article/article_class.php" enctype="multipart/form-data" target="iframeUpload">
                    
                           
                           <br />
                        <span class="UIsubtitle ">Titulo ( incluye un titulo para que otros usuarios encuentren tu articulo facilmente)</span>
                        <br/>
                        <br/> 
                        <input type="text" class="inputtitle"  name="title"/> 
                        
                        
                        
                        
                      
                         <div class="hiddenType">
                        <label class="cabinet"> 
                        <input type="file" name="foto"  class="file" id="file_image"  /> <div class="fixBlue " > Subir imagen + </div>
                        </label>
                         </div>
                          <img class="loader" src="images/loader/p6.gif" id="loader_up"  />   
                         <iframe name="iframeUpload"  class="frm_upload"></iframe>    
                  
                        
                       
  
                      
                      <div  class="UIsubtitle">Contenido</div>
                      <br/> 
		      <textarea name="texto" cols="50" rows="15" class="textAreaArticle" id="tinyTextArea"></textarea>
        
                  </form>     
                         
                    </div>
                       
                      
                </div>  <!-- TERMINA ARTICULO -->
                 
                  <div class="lst_btns">
               <a class="buttonGray fixGray"  id="prvw_art">Vista Previa</a> 
               <a class="buttonOrange listButton"  id="shre_art">Publicar</a>
               
                <a class="buttonGray fixGray" id="cncl_opt">Cancelar</a>   
               </div>
                
                
                
               </div>
           
          
          </div>
          
                    
        <?php require_once ('../class/json_user_data_home.php'); // contiene las var de data para pasar a JS por JSON
        ?>  
     
          
          
     </body>
     
     
     
     
     
     </html>