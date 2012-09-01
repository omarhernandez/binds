<?php
require_once ('class/class.php');

 

$_GET["path"]  = ( !isset($_GET["path"] ) ) ? "" : $_GET["path"] ; // si no esta definido path etnonces quiere ver un usuario y le damos ""

if($_GET["path"] == "interest" && !empty($_GET["path"]) && isset($_GET["path"]) ){ // si es un interes entonces que carge interes


$type_view_interest = true;

require_once ('interest/init_interest.php'); // contiene todo para iniciar profile

}else{

 $type_view_interest =false;
  require_once ('class/init_profile.php'); // contiene todo para iniciar profile
}

?>





<!DOCTYPE HTML> 
<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>   
     <title>  <?php  echo  " Binds -   ".$_SESSION["name_view"]; ?></title>
     
     <head>
       <base href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/binds/"> 
      <link rel="shortcut icon" href="images/icon/binds.png" type="image/x-icon" />
      <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
      <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />


<?php   if ( $type_view_interest){

echo '<link rel="stylesheet" type="text/css" href="interest/css/style_interest.css" media="screen" />';

 
   }else{

 echo '<link rel="stylesheet" type="text/css" href="profile/css/style_profile.css" media="screen" />';

 
}


?>   

 
     <link rel="stylesheet" type="text/css" href="css/profile.css" media="screen" />
     <link rel="stylesheet" type="text/css" href="css/buttons.css" media="screen" />
     <link rel="stylesheet" type="text/css" href="tipsy/js/tipsy.css" media="screen" />
     <link rel="stylesheet" type="text/css" href= "framework/css/binds.css" media="screen" />
     <script type="text/javascript" src="js/jquery-1.6.js" ></script>
     <script type="text/javascript" src="js/hoverIntent.js" ></script>
     <script type="text/javascript" src="js/jstextarea.js"></script>
     <script type="text/javascript" src="js/BindsQuery.js"></script>
     <script type="text/javascript" src="js/initHead.js"></script>
     <script type="text/javascript" src="js/slide.js"></script>
     <script type="text/javascript" src="js/suscribe.js"></script>
     <script type="text/javascript" src="js/fx.js" ></script>    
     <script type="text/javascript" src="js/initProfile.js" ></script> 
     <script type="text/javascript" src="js/feedProfile.js" ></script>
     <script type="text/javascript" src="js/tooltip.js" ></script>
     <script type="text/javascript" src="tipsy/js/tipsy.js" ></script>
     <script type="text/javascript" src="framework/js/binds.js" ></script>     
     <script type="text/javascript" src="js/highlight.js" ></script>     
     <script type="text/javascript" src="post_articulo/js/article_events.js" ></script>     
     </head>
     
     <body>
     
        
       
              <div id="head"    >
               
               <div id="contentSP">
                    <div id="binds" title="binds"  >  </div>
                    
                      
                    
                    
                    <div id="PositionSearch">
                    <input id="search" placeholder="Seek People , Questions & Topics"/>
                   </div>
                      
                    
                    
                    <ul id="contentMenuHead">
                       
                  <?php
                         
                         if(        $_SESSION["visitor"]  == true){
                         
                              ?>
                                     <a  href=" index.php" class="buttonGray fixGray trip"> Login</a>
                
                                     
                                    <!-- <a  href=" index.php" class="button buttonRed trip">Request an Invitation</a>-->
                         
                       
                              <?php
                         }else{
                     ?>    
                         <li class="elementList UIBoxList" id="UserMenuOption">
                        <img src="<?php echo "userpic_thumb/".$_SESSION["current_photo"];?>"   width="20" class="imageuserbar" /> 
                        <a  class="elementUI" href="#"><?php echo $_SESSION["current_user"] ?>
                        </a> <span class="tAng"> </span>
                              
                         <!--   aqui empieza las opciones que estaran oculta para hacer el menu desplegable  -->
                         <div class="MenuVertital" id="MenuUserMenuOption">
                              <ul >
                           <a  class="elementUI" href="home">  <li class="OpMenuVertical"> Inicio </li></a>
                                   <a  class="elementUI"  href='<?php echo $_SESSION['current_id']?>'  > <li class="OpMenuVertical"> Storyboard </li></a>
                                     <li class="OpMenuVertical"> HighLights</li>
                                   <li class="OpMenuVertical">Buscar Topicos  </li>  
                                     <li class="OpMenuVertical"> Configuracion</li>   
                                     <li class="OpMenuVertical"> Ayuda</li>
                                      
                                     <a  ><li class="OpMenuVertical out"> Salir  </li> </a> 
                                     
                                     
                              </ul>
                              
                         </div>
                         <!--   aqui termina las opciones que estaran oculta para hacer el menu desplegable  -->      
                         </li>
                         <?php
                         }
                         ?>
                         <li class="elementList UIBoxList">
                          <img id="showcomentreply" src="images/loader/p6.gif" />
                         </li>
                      
                    </ul>
               </div>
               
          </div>    
          
          
          
        <?php require_once ('class/json_user_data.php'); // contiene las var de data para pasar a JS por JSON
        ?>  
     
   
       <div class="mainContainer">  <!--  contenedor general -->
          
       
<div class="UIInfoContainer" >  <!--  padding transparente -->
              
 
         
        
              
      <div id="idstoryBoardContainer" class="mnWidth"  > 
           
                <div id="containerHeadinfo"> 
          
              
                                  <ul>
                                                    
                                                    <li>
                                                                      
  <div class="structContainerIimage">      <img src=" <?php echo "userpic/".$user_or_topic_data[0]["current_image_user"];?> "  class="userview " width="135"     />  </div>
                                                                                              
                                                    </li>
                                                    
                                                    
                                                    <li>
                                                                      
                                                                        <span  class="nameUserStoryboard">  <?php  echo   $user_or_topic_data[0]["user_name"];?></span>
                                                                      
                                                                        
                                                                        
                 <div id="ContainerImageFollowers">  
       
                      <?php for($i=0;$i<count($view_follower_user);$i++){    if($i > 4){  }else{?>
        
                      <a href="<?php echo $view_follower_user[$i]["id_user"]; ?>" class="datatip" data="<?php echo $view_follower_user[$i]["user_name"]; ?> " > 
                     <img width="27"  src="userpic_thumb/<?php echo $view_follower_user[$i]["current_image_user"]; ?>"/>
                      </a>
                        <?php } }?>
              
                 </div>   
                                                                        
                                                                        
                                                                        
                                                    </li>
                                 
                                                    <li class="starts">
                                                                     <!--  <img src="images/icon/stars.png" height="14"> -->
                                                    </li>
                                  </ul>
                                  
                                  </div>
                   
                  
                                  
                                  
                   <ul class="structNameInfoProfile">
                        
               

                <li>
                  
                     
                     
                                 <!-- status user -->
                <div  class="Structinfopagestatus">
                     
                       
    <div id="buttonFollow">
      
       <!--  BOTONES!!! FOLLOW DROP AND EDIT-->
       
          <?php  if($_SESSION["id_user_view"]!= $_SESSION["current_id"]){  // si el usuario soy el que se logeo entonces se miestra editar 
          //si es un visitante se muestra boton de seguir   ?> 
        
         
        <?php if(  $imAlreadyFollowd==0 ){?>
       <a class="buttonGray fixGray"  id="suscribe"  >  Suscribirse a  <strong> <?php echo  $user_or_topic_data[0]["user_name"]; ?></strong></a>
           <?php   }else{  // si ya estoy siguiendo al usuario entonces que aparesca que DROP  ?> 
         
         <a class="buttonGray fixGray" id='dropUs'    > <strong>Drop   <?php  echo  $user_or_topic_data[0]["user_name"]; ?></strong></a>
           <?php   } ?> 
         
    <?php   }else{  if ( !$type_view_interest) { ?> 
         
         
         <a class=" buttonGray fixGray"  >  Editar Storyboard </a>
         
           <?php }  }   ?> 
       
         
        <!--  END BOTONES!!! FOLLOW DROP AND EDIT-->  
         
     </div> 
               
                
           </div>   
                     
                     

                </li>
                
             
                   </ul>
                   
                   
                   
                   
   
              
          
     </div>  <!-- END DE CONTENEDOR DE FOLLOW NOMBRE -->
           
           

           
 
         
         
                 <div id="sucribe" class="fixposSuscrib"> 
                 
                                   <ul class="statStoryboard">
                                                     
                                                     <li>
                                                                       
                                              <strong>  <?php           echo $statsFollowCurrentUser[0]["Followers"]   // numero de personas que siguen?>      </strong> 
                                                                       
                                                           <?php    if(count($view_follower_user)==1){ echo 'Suscriptor';}else{echo 'Suscriptores';} ?>               
                                                                       
                                                    </li>
                                                    <li>  Suscrito a <strong> <?php         echo $statsFollowCurrentUser[0]["Following"] ?> </strong> </li>
            
                                                         
                                                       
                                   </ul>
                                             <ul class="whosStoryboard">

                                                 <?php   if ( $type_view_interest){ include("interest/status_interest.php"); }else{   include("profile/status_profile.php");   }  ?>

                                                                              
                                                                                            
                                                                              
                                                                                             
                                  </ul>
                        
           
  
            </div>    <!-- Followers -->
         
         
         
         
         <!--   NOMBRE DE USUARIO VIEW -->
         
       <ul class="UserData optionsUserView"  >
         
       
       
                
               <li>   
                    
                    
               &nbsp;
                    
                    
                    
                    
              </li>
              
          
        
              
                <li class="containerDescription"  >   
                 <div  >
 
                 </div>
              </li>
              
               <li>  &nbsp;
              </li>
              <li id="imagesSetByUs">
                   <!--
                   <ul  class="floatLeft">
                        
                        <li class="floatRight"><img src="images/1.jpg" width="119"/> </li>  
                        <li class="floatRight" ><img src="images/2.jpg" width="119"/> </li>  
                         <li class="floatRight" ><img src="images/3.jpg" width="119"/> </li>  
                          <li class="floatRight" ><img src="images/4.jpg" width="119"/> </li>  
                        <li class="floatRight" ><img src="images/1.jpg" width="119"/> </li>     
                        
                   </ul>
                   
                   -->
                   
              </li>
                
               
               
               
               
               
        </ul>
      
      
      
      </div>  
                 
              
             
              
          
          <div id="wrapper"   class="mnWidth"  > 
 
            <div id="ContentInformation"> 
                 
                 
               

                 
                 
               
                 
                 
                 
                 
                 
                 
                 <!--  divs que conteinen para compartir informacion-->
                 
                   
                        
                
                    <div class="structContainerShare" id="QuestionContainer">
                         
                         <textarea class="shareintxtArea" id="comentArea"></textarea>   
                         
                         <a class="buttonOrange    listButton"  id="coment"  >Comentar</a>  
    
    
                         <a class="buttonGray   listButton " >Cancelar</a>   <img src="images/loader/p6.gif"    id="Sendingcoments"/>
    
                         
                    </div>
               
               
   
                 
                 <div class="hightlight" id="hlcontainer">    <!-- EMPEIZA DESTACADO!!!!!!!!!!!!!!!!!!! --> 
                 <img src="images/loader/p6.gif"  style="margin-left: 308px; " class="loader" id="loadingcoments"/>
                 
                 
                 <div id="colleftFeed" >
                 </div>
                 
                 
                       <div id="colrightFeed" >
              
                       </div>
                 
                 
                 <!--  COMENTS!!!!!!!!!!!!!!      -->
            
               
        </div>        
           </div>  
         
               
                  
             
    
            
            
 
        </div>
              
              </div><!-- contenedor para centar todo -->
     </div> 
           

<?php 

if($_GET["path"] == "interest" ){



}else{

  echo  '<script type="text/javascript" src="profile/js/load_bg.js" ></script>';       

}


?>
                  
     </body>
     
     
</html>
