<?php
session_start();
include_once 'class/class.php';
if (!isset($_SESSION['current_user'])) {


	die("No has iniciado sesion . Por Favor <a href='index.php'>Click aqui</a>.");
} else { // hacer la llamada a todos los datos necesarios para este usuario
	$follow = subscribe::getFollowCount($_SESSION["global_id_current"]);

	$_SESSION["current_followers"] = $follow[0]["Followers"];
	$_SESSION["current_following"] = $follow[0]["Following"];
}

$_SESSION["limit_pagination"] = 0; // nueva paginacion 

$_SESSION["article"] = $global_id_view = binds::getTheGlobalIdUserOrTopic($_SESSION["current_id"], 1); // obetenemos el id global de relationship para saver si es persona o topico   
?>

<!DOCTYPE HTML> 
<html>
    <head>  

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>   
		<title>  <?php echo " Binds -   " . $_SESSION["current_user"] ?></title>


		<link rel="shortcut icon" href="images/icon/binds.png" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/profile.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/homeUI.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/buttons.css" media="screen" />
		<link rel="stylesheet" type="text/css" href= "framework/css/binds.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="css/style_preview.css" />   
		<link media="screen" href="style_file/css/style_file.css" type="text/css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="post_imagen/css/estiloPostImagen.css"/>
		<link rel="stylesheet" type="text/css" href="style_file/css/style_file.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="subscriptions/css/subscriptions.css" />
		<link rel="stylesheet" type="text/css" href="style_file/css/style_file.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="tipsy/js/tipsy.css" />
		<link rel="stylesheet" type="text/css" href="post_pregunta/css/ui_question.css" />
		<link rel="stylesheet" type="text/css" href="post_video/css/videostyle.css"/>
		
		<script type="text/javascript" src="js/jquery-1.6.js" ></script>
		<script type="text/javascript" src="js/initHome.js" ></script> 
		<script type="text/javascript" src="js/initArticule.js" ></script> 
		<script type="text/javascript" src="js/jstextarea.js"></script>
		<script type="text/javascript" src="js/cronology.js"></script>  
		<script type="text/javascript" src="js/BindsQuery.js"></script> 
		<script type="text/javascript" src="js/initfunction.js"></script>    
		<script type="text/javascript" src="js/initHead.js"></script>
		<script type="text/javascript" src="js/slide.js"></script>
		<script type="text/javascript" src="js/fx.js" ></script>    
		<script type="text/javascript" src="post_imagen/js/prompt.js" ></script>
		<script src="tipsy/js/tipsy.js" type="text/javascript"></script>           
		<script type="text/javascript" src="framework/js/binds.js" ></script>
		<script type="text/javascript" src="add_topic/js/add_topic_event.js" ></script>  
		<script type="text/javascript" src="subscriptions/js/getFollowing.js" ></script>  
		<script type="text/javascript" src="js/highlight.js" ></script>     
		<script type="text/javascript" src="post_articulo/js/article_events.js"></script>
		<script type="text/javascript" src="post_pregunta/js/questions_e_handler.js"></script>
		<script type="text/javascript" src="post_video/js/initVideo.js"></script>
		<script type="text/javascript" src="destacado/js/init_destacado.js"></script>
	
		<style>

			.structChatComnt, .cmntClss {
				margin-left: 24px;
				width: 643px !important;
			}


			.UiMSG {
				line-height: 18px;
				margin-left: 125px;
				overflow-x: hidden;
				text-align: center;
				text-shadow: 0 1px #FFFFFF;
				width: 414px;
			}
		</style>

	</head>

	<body>


		<div id="head">

			<div id="contentSP">
				<div id="binds" title="binds"  >  </div>
				<div id="PositionSearch">
					<input id="search" placeholder="Seek People , Questions & Topics"/>
				</div>

				<ul id="contentMenuHead">


					<li class="elementList UIBoxList" id="UserMenuOption">
						<img src="<?php echo "userpic_thumb/" . $_SESSION["current_photo"]; ?>"   width="20" class="imageuserbar" /> 
						<a  class="elementUI" href="#"><?php echo $_SESSION["current_user"] ?>
						</a> <span class="tAng"> </span>

						<!--   aqui empieza las opciones que estaran oculta para hacer el menu desplegable  -->
						<div class="MenuVertital" id="MenuUserMenuOption">
							<ul >
								<a  class="elementUI" href="home">  <li class="OpMenuVertical"> Inicio </li></a>
								<a  class="elementUI"  href='<?php echo $_SESSION['current_id'] ?>'  >

									<li class="OpMenuVertical"> Mis listas</li>
									<li class="OpMenuVertical">Buscar Topicos  </li>  
									<li class="OpMenuVertical"> Configuracion</li>   
									<li class="OpMenuVertical"> Ayuda</li>

									<a  ><li class="OpMenuVertical out"> Salir  </li> </a> 
							</ul>

						</div>
						<!--   aqui termina las opciones que estaran oculta para hacer el menu desplegable  -->      
					</li>
					<li class="elementList UIBoxList" id="UserMenuOption">
						<a  class="elementUI UIBoxList"  href='<?php echo $_SESSION['current_id'] ?>'>Storyboard</a>
					</li>  
				</ul>
			</div>

		</div>

<?php require_once ('class/json_user_data_home.php'); // contiene las var de data para pasar a JS por JSON
?>  

		<div  class="tickerheader">




			<div id="content"> 



				<div class="AnnContent">  




					<div id="containerImageUserView" class="fiximageuser">


						<!--  <div class="displayNameIMG"></div>  -->
						<img src="<?php echo "userpic_thumb/" . $_SESSION["current_photo"]; ?>"   width="77"    /> 

					</div> 

					<ul style="float: left; margin-left: 6px; margin-top: 3px; color: #555;
						font-size: 12px; ">
						<li><strong><?php //echo $_SESSION["name"];  ?> </strong>  </li>

						<li> <?php //echo  $_REQUEST["path"]  ?></li>

					</ul>


					<ul  class="menutabs">

						<li   path="./cronology"  class="leftList  Menu  none uiIcon icon  cronologyicon get_cronology_data active_tabs" id="Cronology">   Cronologia</li>   
						<li  path="./list" class="leftList  Menu none  uiIcon icon  highlighicon border-menu get_list_user get_list_data">Mis listas</li>  
						<li   path="./highlight"  class="leftList  Menu none  uiIcon icon  highlighicon border-menu  get_highlight_data"   >Destacado</li>  


					</ul>


					<ul class="menutabs">

						<li   path="./popular"   class="leftList  Menu none  uiIcon icon    get_topic_popular"  > Popular  </li>       

					</ul>



					<ul class="menutabs">
						<li   id="suscriptionsT" path="./suscribers"         class="leftList  Menu none  uiIcon icon  Music border-menu get_subscription_data "  >Mis Suscripciones <span class="CircleNotify Red"> 2</span></li>        

						<li class="leftList  Menu none uiIcon icon  highlighicon"  id="tggleInterest"><strong>Publicar</strong><span class="tAng"> </span> </li>   
					</ul>                                    




					<div id="InterestContainer"  >
						<ul class="menutabs">
							<li class="leftList  Menu none  uiIcon icon Quess"  >Pregunta</li>
							<li class="leftList  Menu none  uiIcon icon  Video border-menu" id="setNw__art" > Articulo  </li>  
							<li class="leftList  Menu none  uiIcon icon  Music border-menu"  >Sonido</li>
							<li id="setNw__vid" class="leftList  Menu none  uiIcon icon  Video border-menu"  >Video</li>

							<li class="leftList  Menu none  uiIcon icon  Photo" id="setNw__pic" >Fotografia <span class="CircleNotify Red"> 1</span></li> 
						</ul>
					</div> 




					<ul class="menutabs">

						<li  path="./questions"          class="leftList  Menu none  uiIcon icon "  > Alertas <span class="CircleNotify Red"> 7</span></li>      
						<!--   <li      path="./config"       class="leftList  Menu none border-menu uiIcon icon  highlighicon  get_config_profile"  >Configurar</li> -->  
						<a href="settings.php"><li    path="./edit"  class="leftList  Menu none border-menu  uiIcon icon  highlighicon get_edit_profile"  >Editar storyboard</li></a>  

					</ul>




					<a class="button buttonRed add_topic fixchannel "  >
						<strong>Agregar Interes</strong>

					</a>







				</div>  




				<div id="columContentRight">






					<!-- Begin share Music , Event Questions ETC   -->
					<div id="containerMenuTopic">

						<!-- ------------------------------------- Music -------------------------------- -->       
						<div class="leftBarWidth uiBoxTopicShare" id="ContainerMusicTopic">
							<div class="ContentBarBlack leftBarWidth fixleftBarWidth" > <li class="leftList  Menu" >Share Music</li></div>    
						</div>
						<!-- ------------------------------- Video ------------------------------------- -->  
						<div class="leftBarWidth uiBoxTopicShare" id="ContainerVideoTopic">
							<div class="ContentBarBlack leftBarWidth fixleftBarWidth" > <li class="leftList  Menu" >Share Video</li></div>    
						</div>
						<!-- ------------------------------- Photo ----------------------------------------- -->
						<div class="leftBarWidth uiBoxTopicShare" id="ContainerPhotoTopic">
							<div class="ContentBarBlack leftBarWidth fixleftBarWidth" > <li class="leftList  Menu" >Share Photo</li></div>    
						</div>
						<!-- ------------------------------Quess------------------------------------------ -->
						<div class="leftBarWidth uiBoxTopicShare" id="ContainerQuessTopic">
							<div class="ContentBarBlack leftBarWidth fixleftBarWidth" > <li class="leftList  Menu" >Share Question</li></div>    
						</div>
						<!-- -------------------------- Event -------------------------------------------- -->
						<div class="leftBarWidth uiBoxTopicShare" id="ContainerEventTopic">
							<div class="ContentBarBlack leftBarWidth fixleftBarWidth" > <li class="leftList  Menu" >Share Event</li></div>    
						</div>

					</div> <!-- End share Music , Event Questions ETC   -->
					<div class="ContentBarBlack leftBarWidth"> 


					</div>

					<div id="MainContainer">  <!-- Begin main container-->                

						<img src="images/loader/p6.gif"  style="margin-left: 308px; " class="loader" id="loadingcoments"/>
						<!--   BEGIN  BOX CRONOLOGY -->  
						<div id="cronologyContainer">

						</div>


						<div id="ListContainer">




							<!--     estado de usuario  Firs Box right      -->   

							<div id="ContainerTAM">  <!-- BEGIN contenedor de TOpic alert, y mensaje -->    
								<!-- ----------------------------------------------------------------------------------------------------  -->  
								<div class="columRight "  id="ContainerTopicNotify"><!-- BEGIN TOPIC CONTAINER --> 

<?php
for ($i = 0; $i < 5; $i++) {
	?> 


										<div id="ContainerOptionTopic" class="ContainerOptionTopicMenu" ><!-- Contiene Informacion de tiopico -->

											<span class="TopicFormatImage"><img src="images/topic.jpg" width="38" />  </span>    <!--  Image de topico-->

											<span class="TopicFormatView" ><img src="images/right.png" width="16" class="ButtonTopicView" /> </span>    <!--  View de topico--> 

											<span  class="TopicFormatInfo TitTopic"> Geonacity Count</span>  <!--  Titulo de topico-->


											<span class="TopicFormatInfo FollTopic">1,333,600 Followers </span>  <!--  Folowers de topico -->



										</div><!-- END Contiene Informacion de tiopico -->

	<?php
}
?>


									<div class="TopicFormatInfo  FollTopic"> Configurar  </div>
								</div><!-- END Message CONTAINER --> 


								<!-- ----------------------------------------------------------------------------------------------------  -->  
								<div class="columRight" id="ContainerMessageNotify"><!-- BEGIN TOPIC CONTAINER --> 
									Mensajes
								</div><!-- END Message CONTAINER --> 


								<!-- ----------------------------------------------------------------------------------------------------  -->  
								<div class="columRight" id="ContainerAlertNotify"><!-- Alert TOPIC CONTAINER --> 
									Alertas
								</div><!-- END Alert CONTAINER --> 
								<!-- ----------------------------------------------------------------------------------------------------  -->  



							</div>   <!-- END contenedor de TOpic alert, y mensaje -->  




						</div>

						<!-- contenedores -->
						<div class="edit_profile" > Hombres Trabajando</div>

						<div class="config_profile" > Hombres Trabajando</div> 
						<div  id="suscriptionsPanel" class="suscriptionsContainer" >  </div>  
						<div id="highlightContainer" >Hombres Trabajando</div>  
						<div id="highlightContainer" >Hombres Trabajando</div>  

						<div   class="topic_popular" >Hombres Trabajando</div>  


					</div>      




					<!-- ----------------------------------------------------------------------------------------------------  -->        
				</div>  <!-- End main container--> 
				<!--     Begin  Firs Box right                                          -->   
				<div class="ContentShare fixColRight" > </div> 



				<div class="columRight MainColRight" >   




					<div class="ContainerUserStatus">      



						<!-- ----------------------------------------------------------------------------------------------------  -->                         




						<!-- BEGIN Second box right --> 
						<div class="columLeft fixposition">   





							<!--   Estados de storyboard     -->   






						</div>


						<div class="columLeft fixposition">   




						</div>
						<!-- END Second box right --> 
						<!-- ----------------------------------------------------------------------------------------------------  -->  

					</div> 

					<!--     End  Estado de usuario                                        -->         

					<!--     End  Firs Box right                                          -->           
				</div><!-- MAIN COLRIGHT  -->



				<!-- ----------------------------------------------------------------------------------------------------  -->  



			</div>

			<div id="footer">
				<div id="ContentAbout"> </div>


			</div>
		</div>   

<?php
if ($_SESSION["loginTime"] == true) {



	echo '          <script type="text/javascript" src="login/js/finish_register.js"></script>  ';
	echo "         <script> // $('.close').live('click',function(){   setTimeout( function(){  $('.close').unbind('click');  set_last_register();},1000);        })   </script>";
}
?>


		<script>


			var legend=" <br>¡Bienvenido a binds! Nuestra filosofía son los intereses: los temas que amas, los temas de los cuales quieres aprender y la información que gira en ellos. <br><br><br> Puedes suscribirte a intereses y postear contenido en ellos. Esta información será visible para toda la gente que también este siguiendo el canal. <br><br><br> Obtén información relevante directo de la gente, la pasión de la gente al crear contenido  es lo hace que girar a binds. ";
 
			binds.box({

				title: " Bienvenidos !" ,

				content : legend

			})
 

			$(".get_list_user").click(function(){


				var legend=" ¿Viste un contenido que te gusto y quieres guardarlo para leerlo mas tarde? Crea una lista y almacena la información que te parezca relevante. ";

				binds.box({

					title: "Agregar a listas" ,

					content : legend

					, top : "35%"
					, height: "117"

				})

			});




			$(".get_highlight_data").click(function(){


				var legend=" En binds nos preocupamos en la información y su calidad. Es por eso que los usuarios tienen disponible una opción para destacar contenido que puede ser visto fácilmente por cualquier persona que siga ese interés. ¡Aquí veras lo mejor de un canal!";

				binds.box({

					title: "Destacados" ,

					content : legend

					, top : "35%"
					, height: "117"

				})

			});



			$(".get_topic_popular").click(function(){


				var legend=" Aquí esta lo mejor de lo mejor, incluso de los intereses que no estés siguiendo. Los tres más populares de cada mes se guardan para que los veas cuando quieras.";

				binds.box({

					title: "Popular" ,

					content : legend

					, top : "35%"
					, height: "117"

				})

			});





			$(".get_cronology_data").click(function(){


				var legend=" Este es lugar donde podrás ver las publicaciones recientes de todas las personas/tópicos que sigues ordenados de forma cronológica";

				binds.box({

					title: "Cronologia" ,

					content : legend

					, top : "35%"
					, height: "117"

				})

			});


		</script>

	</body>



</html>