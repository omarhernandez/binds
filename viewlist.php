<?php  include("ver_listas/class/init_view_list.php")   ?>
<!DOCTYPE HTML>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title> <?php  echo  " Binds -   ".$_SESSION["current_user"] ?></title>
<head>
<link rel="shortcut icon" href="images/icon/binds.png" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
      <link rel="stylesheet" type="text/css" href="css/buttons.css" media="screen" />
      <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/profile.css" media="screen" />

<link rel="stylesheet" type="text/css" href="css/homeUI.css" media="screen" />
<link rel="stylesheet" type="text/css" href="framework/css/binds.css" media="screen" />
<link rel="stylesheet" type="text/css" href="ver_listas/css/ui_list.css" />
<script type="text/javascript" src="js/jquery-1.6.js"></script>
     <script type="text/javascript" src="js/jstextarea.js"></script>
<script type="text/javascript" src="js/initHome.js"></script>
<script type="text/javascript" src="js/BindsQuery.js"></script>
<script type="text/javascript" src="js/initfunction.js"></script>
<script type="text/javascript" src="js/initHead.js"></script>
<script type="text/javascript" src="post_articulo/js/article_events.js"></script>
<script type="text/javascript" src="framework/js/binds.js"></script>
<script type="text/javascript" src="ver_listas/js/init_list.js"></script>
</head>
<body>
<div id="head">
<div id="contentSP">
<div id="PositionSearch">
<input id="search" placeholder="Seek People , Questions & Topics"/>
</div>
<ul id="contentMenuHead">
<li class="elementList UIBoxList" id="UserMenuOption">
<img src="<?php echo "userpic_thumb/" . $_SESSION["current_photo"]; ?>" width="20" class="imageuserbar" />
<a class="elementUI" href="#"><?php echo $_SESSION["current_user"] ?>
</a> <span class="tAng"> </span>
<div class="MenuVertital" id="MenuUserMenuOption">
<ul>
<a class="elementUI" href="home"> <li class="OpMenuVertical"> Inicio </li></a>
<a class="elementUI" href='<?php echo $_SESSION['current_id'] ?>'>
<li class="OpMenuVertical">Storyboard </li></a>
<li class="OpMenuVertical"> Mis listas</li>
<li class="OpMenuVertical">Buscar Topicos </li>
<li class="OpMenuVertical"> Configuracion</li>
<li class="OpMenuVertical"> Ayuda</li>
<a href='login/class/rnlogout.php'><li class="OpMenuVertical"> Salir </li> </a>
</ul>
</div>
</li>
<li class="elementList UIBoxList" id="UserMenuOption">
<a class="elementUI UIBoxList" href='<?php echo $_SESSION['current_id'] ?>'>Storyboard </a>
</li>
</ul>
</div>
</div>
 
<div class="tickerheader">
<div id="content">
 
 <div class="list_data trip"><strong> <?php echo  $data_list [0]["nombre_lista"] ?> </strong></div>
 
 
<div id="wrapper" class="mnWidth">
<div id="ContentInformation">
<div class="hightlight" id="hlcontainer">
<img src="images/loader/p6.gif" style="margin-left:308px" class="loader" id="loadingcoments"/>
<div id="colleftFeed">
</div>
<div id="colrightFeed">
</div>
</div>
</div>
</div>
<div id="footer">
<div id="ContentAbout"> </div>
</div>
</div>
</body>
</html>