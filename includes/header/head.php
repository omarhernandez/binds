<div id="head">

	<div id="contentSP">

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
							</a>
							<a><li class="OpMenuVertical out"> Salir  </li> </a> 
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