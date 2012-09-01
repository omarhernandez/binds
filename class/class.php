<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Content-Type: text/html;charset=utf-8");

//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************

class Conectar {

	public static function con() {


	   $conexion = mysql_connect("localhost", "business_cu", "galaxie50011") or

		// 	$conexion = mysql_connect("localhost", "root", "") or
				die("Error de conexion: " . mysql_error());  // hacemos conexion al serv
		   mysql_select_db("business_binds") or
		// mysql_select_db("binds") or
				die("Error de conexion: " . mysql_error()); //seleccionamso la tabla agency car

		mysql_query("SET NAMES 'utf-8'");

		return $conexion;
	}

}

//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                          ****************************
//********************                            CLASE LOGEAR , REGISTRAR Y SACAR DATOS DE USUARIOS            ***************************
//********************                                                                                          **************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                          ****************************
//********************                            CLASE LOGEAR , REGISTRAR Y SACAR DATOS DE USUARIOS            ***************************
//********************                                                                                          **************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************


class login {

	private $fields;
	private $PermitionSession = false;

	public function __construct() {
		$this->fields = array();
		$this->data = array();
	}

	public function add_user() {


		$user_name = sanitizeString($_POST["user"]); // sanitize
		$email = sanitizeString($_POST["email"]);
		$password = md5(sanitizeString($_POST["password"]));
		$url = false;
		$lastname = false;
		$name = false;
		$quote = false;
		$urlImage = "binds_default.png";
		$_SESSION["name"] = "";
		$_SESSION["loginTime"] = true;
		$_SESSION["url"] = "";

		$conexionDB = Conectar::con();

		// insertamos en data_user


		$sql = "insert into data_user  values( null , '" . $name . "' , '" . $lastname . "' , '" . $email . "' , '" . $password . "' )";


		mysql_query($sql, $conexionDB);  // hacemos coneccion con mysql


		$lastId = mysql_insert_id();

		// insertamos en user

		$sql = "insert into user values (null ,'" . $user_name . "'  , '" . $urlImage . "'  , '" . $url . "' , '" . $quote . "' , $lastId , 'main.gif')";


		mysql_query($sql, Conectar::con());  // hacemos coneccion con mysql


		$lastId = mysql_insert_id();



		$_SESSION["current_id"] = $lastId;

		// insertamos en relationship ( aqui se guardan los id de los topicos y usuarios para que los usuarios y tipicos funcionen igual)



		$sql = "insert into relationship values (null ,'" . $lastId . "' , '1'  )"; // 1.- tipo persona


		mysql_query($sql, Conectar::con());  // hacemos coneccion con mysql



		$lastId = mysql_insert_id();

		//parseamos los datos



		$_SESSION["current_name"] = " " . $name . " " . $lastname; // nombre completo 

		$_SESSION["current_user"] = $user_name;  // usuario

		$_SESSION["current_photo"] = $urlImage;   // imagen URL



		$_SESSION["global_id_current"] = $lastId;


		header("Location:   ../../home");
	}

	public function session($_POST) {



		$user = sanitizeString($_POST["user"]);
		$password = md5(sanitizeString($_POST["password"]));




		$sql = "SELECT DISTINCT  user_name,current_image_user,id_user,url , data.name , data.lastname   FROM  user , data_user as data  where user_name='$user' AND data.password = '$password' and  id_data_user = idData_user   ";
		$res = mysql_query($sql, Conectar::con());


		while ($reg = mysql_fetch_assoc($res)) {//fetch_assoc retorna los datos en un arreglo (este array es de 2 dimenciones
			$this->fields[] = $reg;
		}

		if (count($this->fields) == 1) {

			$this->PermitionSession = true;

			$_SESSION['current_user'] = $user;  // usuario

			$_SESSION["current_name"] = " " . $this->fields[0]["name"] . " " . $this->fields[0]["lastname"]; // nombre completo 

			$_SESSION["name"] = $this->fields[0]["name"];

			$_SESSION["current_photo"] = $this->fields[0]["current_image_user"];   // imagen URL
//****************************************************************************************************************************************************
			// obtenemos el id global osea el que esta en relation ship donde se guardan todos los id de topicos y usuairos
			$sql = "SELECT idRelationship from relationship where   id_user_topic = " . $this->fields[0]['id_user'] . " AND type_user = 1"; // 1.- tipo persona



			$res = mysql_query($sql, Conectar::con());


			while ($reg = mysql_fetch_assoc($res)) {

				$this->data[] = $reg;
			}


//****************************************************************************************************************************************************


			$_SESSION["current_id"] = $this->fields[0]['id_user'];

			$_SESSION["global_id_current"] = $this->data[0]["idRelationship"];


			$_SESSION["url"] = $this->fields[0]["url"];

			$_SESSION["loginTime"] = false;
			$_SESSION["visitor"] = false;


			header("Location:   ../../home");
		} else {

			if (!$this->PermitionSession) {


				 

				echo "clave o usuario incorrecto!";


			 
				header("Location:   ../../");

			}
		}
	}

	public function add_last_data($_POST) {

		extract($_POST);

		$_SESSION["current_name"] = " " . $name . " " . $last; // nombre completo 

		$_SESSION["current_user"] = $name;  // usuario

		$_SESSION["current_photo"] = "binds_default.png";   // imagen URL

		$_SESSION["loginTime"] = false;




		$sql = " UPDATE data_user SET  name = '$name',  lastname = '$last'   WHERE id_data_user =$id__";


		mysql_query($sql, Conectar::con());


		$sql = " UPDATE  user SET url = '$url',   WHERE id_user =$id__";


		mysql_query($sql, Conectar::con());
	}

//***********************************************************************************************************
//***********************************************************************************************************
//***********************************************************************************************************



	public function get_user_data($id_user, $type_user) {




		switch ($type_user) { // es persona
			case 1:

				$sql = "SELECT user_name,current_image_user,

        id_user,url , data.name , data.lastname   FROM  user , data_user as data   WHERE id_user=$id_user and id_data_user = $id_user  ";


				break;
//************************************************************************************************************     
			case 2: // es topico



				$sql = "SELECT  ' ' as lastname , ' ' as name , topico.current_image as current_image_user,

        topico.idTopico as id_user, data.nombre_topico as user_name, data.user_id_user as created  ,

      

         (select user_name from user where id_user =  created) as name_user_created  ,


  (  select  id_user_topic from relationship where idRelationship = 

( 
select  Relationship_idRelationship  from shared_info   where 

relationship_storyboard=(select  idRelationship from relationship where id_user_topic =topico.idTopico and type_user = 2) 

 group by Relationship_idRelationship asc limit 1
)

  ) as id_mayor ,

( select user_name from user where id_user = id_mayor) as name_mayor 



           FROM  topico , data_topic as data   WHERE topico.idTopico=$id_user and data.id_data_topic = $id_user  ";



				break;
		}





		$res = mysql_query($sql, Conectar::con());


		while ($reg = mysql_fetch_assoc($res)) {
			$data[] = $reg;
		}



		return $data;
	}

}

//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                          ****************************
//********************                            CLASE SUSCRIBIRSE A USUARIOS O INTERESES                       ***************************
//********************                                                                                          **************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                          ****************************
//********************                            CLASE SUSCRIBIRSE A USUARIOS O INTERESES                       ***************************
//********************                                                                                          **************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************


class subscribe {

	public function __construct() {


		$this->fields = array();
	}

	public static function getFollowCount($id_user) {

		$sql = "SELECT (
          SELECT COUNT( subscribe.subscriber) AS count
          FROM subscribe
          WHERE subscribe.subscribers =$id_user
          ) AS Followers, 

          (SELECT COUNT( subscribe.subscribers ) AS count
          FROM subscribe
          WHERE subscribe.subscriber =$id_user) AS Following";



		$res = mysql_query($sql, Conectar::con());

		while ($reg = mysql_fetch_assoc($res)) {//fetch_assoc retorna los datos en un arreglo (este array es de 2 dimenciones
			$fields[] = $reg;
		}


		return $fields;
	}

	public function getsubscribeInformation($id_user) {

		$id_user = sanitizeString($id_user);

		$sql = "select   user.id_user ,user.user_name, user.current_image_user FROM subscribe as seguidor , 

                                    user , relationship   WHERE  seguidor.subscribers = $id_user  AND  

                                     seguidor.subscriber = idRelationship AND id_user_topic = id_user";


		$res = mysql_query($sql, Conectar::con());

		while ($reg = mysql_fetch_assoc($res)) {//fetch_assoc retorna los datos en un arreglo (este array es de 2 dimenciones
			$this->fields[] = $reg;
		}

		return $this->fields;
	}

	public function isAlreadySubscribed($id_user, $view_user) { /* funcion para checar si estoy siguiendo al usuario */
		$ar = array();


		$sql = "select count(subscribe.subscriber) as verdad from subscribe where subscribe.subscriber=$id_user and subscribe.subscribers=$view_user";

		$res = mysql_query($sql, Conectar::con());

		while ($reg = mysql_fetch_assoc($res)) {//fetch_assoc retorna los datos en un arreglo (este array es de 2 dimenciones
			$ar[] = $reg;
		}

		return $ar[0]["verdad"];
	}

	public function setFollowing($id_user, $view_user_id) { /* funcion para checar si estoy siguiendo al usuario */

		$id_user = sanitizeString($id_user);

		$view_user_id = sanitizeString($view_user_id);

		$sql = " INSERT INTO subscribe  VALUES ( NULL , $view_user_id, $id_user , '" . strtotime(date("Y-m-d H:i:s")) . " ' )";

		mysql_query($sql, Conectar::con());
	}

//**************************************************************************************************************


	public function dropUser($suscriber, $suscribers) {


		$sql = " DELETE FROM subscribe where subscriber =$suscriber AND subscribers =$suscribers";

		mysql_query($sql, Conectar::con());
	}

	public function getFollowersbyId($idUser, $from, $to) { /* que regresa los followers */

		// $sql = "select `following`, id_user, user.current_image_user, user_name,name,lastname from follow inner join user on user.id_user = follow.following where follow.follower = $idUser LIMIT $from,$to;";



		$sql = " select   data_user.name , data_user.lastname , user.id_user ,user.user_name, user.current_image_user FROM subscribe as seguidor , 

                                    user , relationship , data_user   WHERE  seguidor.subscribers = $idUser  AND data_user.id_data_user = id_user AND

                                     seguidor.subscriber = idRelationship AND id_user_topic = id_user LIMIT $from,$to; ";

		$res = mysql_query($sql, Conectar::con());
		$followers = array();
		while ($reg = mysql_fetch_assoc($res)) {

			$followers[] = $reg;
		}

		return $followers;
	}

}

//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                          ****************************
//********************         CLASE PARA SACAR CONTENIDOS DE FORMA CRONOLOGICA PARA CRONOLOGIA ( EN HOME )      ***************************
//********************                                                                                          **************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                          ****************************
//********************         CLASE PARA SACAR CONTENIDOS DE FORMA CRONOLOGICA PARA CRONOLOGIA ( EN HOME )      ***************************
//********************                                                                                          **************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************



class cronology {

	public function getCronology($user_current, $limit_post) { /*  funcion que regresara los comentarios escritos por los usurios que estamos siguiendo */


		$coments = array();




		$sql = " 
 SELECT  type_post , idpost as id_contenido , 

(CASE 
WHEN type_post = 5 THEN ( select image_photo  from photo where post_idpost = idpost) 
END ) as img_pho  ,

(CASE 
WHEN type_post = 5 THEN ( select descripcion  from photo where post_idpost = idpost) 
WHEN type_post = 2 THEN ( select texto_articulo from articulo where post_idpost = idpost) 
 
END ) as contenido_texto 

,

( SELECT  if(UNIX_TIMESTAMP( ) - post.fecha >= 86400 , post.fecha , UNIX_TIMESTAMP( ) - post.fecha)   limit 1    ) as date ,


( select  Relationship_idRelationship from shared_info where post_idpost = idpost  limit 1    ) as contenido_userset ,

( select  user_name from user ,relationship where id_user = id_user_topic and   Relationship_idRelationship  = idRelationship  limit 1    ) as user_name_set ,

( select current_image_user from user ,relationship where id_user = id_user_topic and   Relationship_idRelationship  = idRelationship  limit 1    ) as post_current_image_user  


, " . binds::getComentsReplySQL() . "  , " . binds::getWherePostComeFrom() . "


from post ,shared_info , subscribe  WHERE post_idpost = idpost AND subscriber = $user_current AND subscribers = relationship_storyboard 


ORDER BY post.fecha desc   LIMIT $limit_post,25                    

";


		$res = mysql_query($sql, Conectar::con());


		while ($reg = mysql_fetch_assoc($res)) {

			$coments[] = $reg;
		}

		for ($i = 0; $i < count($coments); $i++) {

			$coments[$i]["date"] = binds::getTime($coments[$i]["date"]); // actualizamos y regresamos el timespend

			$coments[$i]["timespend_reply"] = binds::getTime($coments[$i]["timespend_reply"]); // actualizamos y regresamos el timespend



			if ($coments[$i]["text_coment_reply"] == null) { // si no hay comentarios reply entonces ponemos todo a falso 
				$coments[$i]["text_coment_reply"] = false;
				$coments[$i]["user_name_reply"] = false;
				$coments[$i]["current_image_user_reply"] = false;
				$coments[$i]["timespend_reply"] = false;
				$coments[$i]["id_coment_reply"] = false;
				$coments[$i]["id_user_reply"] = false;
				$coments[$i]["coment_count_reply"] = false;
			}
		}


		return $coments;
	}

}

//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                          ****************************
//********************         CLASE PARA SACAR CONTENIDOS DE FORMA CRONOLOGICA PARA STOTYBOARD                  ****************************
//********************                                                                                          **************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                          ****************************
//********************         CLASE PARA SACAR CONTENIDOS DE FORMA CRONOLOGICA PARA STOTYBOARD                  ****************************
//********************                                                                                          **************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************


class FeedProfile {

	public function getFeedCurrentProfile($user_current, $limit_post) { /*  funcion que regresara los comentarios y articulos escritos por los usurios que estamos siguiendo */


		$coments = array();

		$sql = " 
SELECT  type_post , idpost as id_contenido ,

(CASE 
WHEN type_post = 5 THEN ( select image_photo  from photo where post_idpost = idpost) 
END ) as img_pho  ,

(CASE 
WHEN type_post = 4 THEN (select url_video from video where post_idpost = idpost)
END) as vid_obj,

(CASE 
WHEN type_post = 5 THEN ( select descripcion  from photo where post_idpost = idpost) 
WHEN type_post = 2 THEN ( select texto_articulo from articulo where post_idpost = idpost) 
WHEN type_post = 4 THEN ( select descripcion from video where post_idpost = idpost)
END ) as contenido_texto 
,
( SELECT  if(UNIX_TIMESTAMP( ) - fecha >= 86400 , fecha , UNIX_TIMESTAMP( ) - fecha)   limit 1    ) as date ,

( select id_user from user ,relationship where id_user = id_user_topic and   Relationship_idRelationship  = idRelationship  limit 1    ) as contenido_userset ,

( select  user_name from user ,relationship where id_user = id_user_topic and   Relationship_idRelationship  = idRelationship  limit 1    ) as user_name_set ,

( select current_image_user from user ,relationship where id_user = id_user_topic and   Relationship_idRelationship  = idRelationship  limit 1    ) as post_current_image_user 


, " . binds::getComentsReplySQL() . "

from post ,shared_info where relationship_storyboard = $user_current AND post_idpost = idpost ORDER BY fecha desc LIMIT $limit_post,25";

		$res = mysql_query($sql, Conectar::con());



		while ($reg = mysql_fetch_assoc($res)) {

			$coments[] = $reg;
		}

		for ($i = 0; $i < count($coments); $i++) {

			$coments[$i]["date"] = binds::getTime($coments[$i]["date"]); // actualizamos y regresamos el timespend
			//  $coments[$i]["contenido_texto"] = utf8_encode(htmlentities($coments[$i]["contenido_texto"]));
			$coments[$i]["timespend_reply"] = binds::getTime($coments[$i]["timespend_reply"]); // actualizamos y regresamos el timespend

			if ($coments[$i]["text_coment_reply"] == null) {

				$coments[$i]["text_coment_reply"] = false;
				$coments[$i]["reply_user_name"] = false;
				$coments[$i]["reply_current_image_user"] = false;
				$coments[$i]["timespend_reply"] = false;
				$coments[$i]["id_coment_reply"] = false;
				$coments[$i]["id_user_posted_reply"] = false;
				$coments[$i]["coment_count_reply"] = false;
			}
		}



		return $coments;
	}

}

//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                          ****************************
//********************    CLASES QUE INTEGRA TODAS LAS FUNCIONALIDADES ENVIAR A DESTACADOS ALGUN CONTENIDO      ****************************
//********************                                                                                          **************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                          ****************************
//********************    CLASES QUE INTEGRA TODAS LAS FUNCIONALIDADES ENVIAR A DESTACADOS ALGUN CONTENIDO      ****************************
//********************                                                                                          **************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************


class highlight {

	public function __construct() {

		$data = array();
	}

	public function set_post_into_highlight($_POST) {


		extract($_POST);

		$sql = "INSERT INTO destacado VALUES ( NULL , $user_set ,'" . strtotime(date("Y-m-d H:i:s")) . "' , $id_post   );";


		mysql_query($sql, Conectar::con());
	}

	public function check_clone_highlight($_POST) {



		extract($_POST);



		$sql = " select count(idDestacados ) as response from destacado where idUser =$user_set and post_idpost=$id_post and 
                              ( select type_post from post where idpost =$id_post )  = $post_type  ";


		$res = mysql_query($sql, Conectar::con());

		while ($reg = mysql_fetch_assoc($res)) {

			$data[] = $reg;
		}

		echo json_encode(array('response' => ( $data[0]["response"] == 1 ) ? true : false));
	}


	public function get_highlight_by_id($_POST) {



		extract($_POST);



		$sql = "SELECT  type_post , idpost as id_contenido , 

(CASE 
WHEN type_post = 5 THEN ( select image_photo  from photo where post_idpost = idpost) 
END ) as img_pho  ,

(CASE 
WHEN type_post = 5 THEN ( select descripcion  from photo where post_idpost = idpost) 
WHEN type_post = 2 THEN ( select texto_articulo from articulo where post_idpost = idpost) 
 
END ) as contenido_texto 

,

( SELECT  if(UNIX_TIMESTAMP( ) - post.fecha >= 86400 , post.fecha , UNIX_TIMESTAMP( ) - post.fecha)   limit 1    ) as date ,


( select  Relationship_idRelationship from shared_info where post_idpost = idpost  limit 1    ) as contenido_userset ,

( select  user_name from user ,relationship where id_user = id_user_topic and   Relationship_idRelationship  = idRelationship  limit 1    ) as user_name_set ,

( select current_image_user from user ,relationship where id_user = id_user_topic and   Relationship_idRelationship  = idRelationship  limit 1    ) as post_current_image_user  


, " . binds::getComentsReplySQL() . "  , " . binds::getWherePostComeFrom() . "


from post ,shared_info , subscribe  WHERE post_idpost = idpost AND subscriber = $user_current AND subscribers = relationship_storyboard 


ORDER BY post.fecha desc   LIMIT $limit_post,25    ";


		$res = mysql_query($sql, Conectar::con());

		while ($reg = mysql_fetch_assoc($res)) {

			$data[] = $reg;
		}

	 	return $data; // pendiente!!!
	}



}

//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                          ****************************
//********************    CLASES QUE INTEGRA TODAS LAS FUNCIONALIDADES PARA CREAR TOPICOS Y SUBTOPICOS          ****************************
//********************                                                                                          **************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                          ****************************
//********************    CLASES QUE INTEGRA TODAS LAS FUNCIONALIDADES PARA CREAR TOPICOS Y SUBTOPICOS          ****************************
//********************                                                                                          **************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************


class category {

	public function getCategoriesRandom() {


		$data = array();

		$sql = "select idTopico  as idCategory,  nombre_topico name_category from  data_topic , node_topic   WHERE Topico_idTopico = idTopico and  id_topico_parent = 0 ORDER BY RAND( )  LIMIT 9";



		$res = mysql_query($sql, Conectar::con());

		while ($reg = mysql_fetch_assoc($res)) {

			$data[] = $reg;
		}

		for ($i = 0; $i < count($data); $i++) {

			//           $data[$i]["name_category"] = utf8_encode(htmlentities($data[$i]["name_category"]));
		}



		echo json_encode(array('response' => ( $data)));
	}

	public function setTopicInterest($_POST) {
		extract($_POST);

// primero se guarda en topico  para que este nos ponga el idTopico
// EJEMPLO : categories=1&nm_int=Fisioterapia&descrip=El+quote&iusr=1
//--------------------------------- INSERTARMOS EN TOPICO --------------------------------------------------------------


		$sql = " INSERT INTO topico VALUES (NULL , 0 , '$descrip' , 'binds_default.png' , '' )";

		mysql_query($sql, Conectar::con());

		$id_new_topic_created = mysql_insert_id(); // obtenemos el ID del topico creado
//--------------------------------- INSERTAMOS EN  NODE TOPIC ---------------------------------------------------------
// categories == padre del tocpi actual creado

		$sql = "INSERT INTO   node_topic VALUES (NULL ,   $id_new_topic_created,   '$categories');";

		mysql_query($sql, Conectar::con());

//--------------------------------- INSERTAMOS EN  DATA TOPIC ---------------------------------------------------------



		$sql = "INSERT INTO   data_topic VALUES (NULL ,   $id_new_topic_created,   '$nm_int' , $iusr);";

		mysql_query($sql, Conectar::con());


//------------------------------- INSERTAMOS EN RELATIONSHIP EL NUEVO ID -----------------------------------------

		$sql = "insert into relationship values (null ,'" . $id_new_topic_created . "' , '2'  )"; // 1.- tipo persona


		mysql_query($sql, Conectar::con());  // hacemos coneccion con mysql
	}

}

//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                          ****************************
//********************    CLASES QUE INTEGRA TODAS LAS FUNCIONALIDADES DE LAS CONFIGURACIONES DE USUARIO        ****************************
//********************                                                                                          **************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                          ****************************
//********************    CLASES QUE INTEGRA TODAS LAS FUNCIONALIDADES DE LAS CONFIGURACIONES DE USUARIO        ****************************
//********************                                                                                          **************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************




class Status {

	public function get_status() {

		$data = array();

		extract($_POST);



		$global_id_view = binds::getTheGlobalIdUserOrTopic($usr, 1);


		$sql = " select *from user where id_user = $usr ";

		$res = mysql_query($sql, Conectar::con());


		while ($reg = mysql_fetch_assoc($res)) {

			$data[] = $reg;
		}


		echo json_encode(array('response' => ( $data )));
	}

}

//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************************                                                                   ***************************************
//********************************       CLASES QUE INTEGRA TODAS LAS FUNCIONALIDADES DE LISTAS      ***************************************
//********************************                                                                   *************************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************************                                                                   ***************************************
//********************************       CLASES QUE INTEGRA TODAS LAS FUNCIONALIDADES DE LISTAS      ***************************************
//********************************                                                                   *************************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************


class lists_user {

	public function get_lists_user($query, $id_user) {

		$data = array();


		$sql = " SELECT id_lista , nombre_lista from  lista  where nombre_lista like  '%$query%'  AND id_user=$id_user";




		$res = mysql_query($sql, Conectar::con());

		while ($reg = mysql_fetch_assoc($res)) {

			$data[] = $reg;
		}



		echo json_encode(array('response' => $data));
	}

	public function get_list_information_by_id_list_and_user_id($_GET) {

		extract($_GET);

		$sql = " SELECT nombre_lista from  lista  where id_lista=$id_list and  id_user=$id_user";

		$res = mysql_query($sql, Conectar::con());


		while ($reg = mysql_fetch_assoc($res)) {

			$data[] = $reg;
		}



		return $data;
	}

	public function get_post_into_list($id_lista) {
		$data = array();

		$sql = "select idpost as id_post  , id_lista , type_post , idpost as id_contenido  ,

(CASE 
WHEN type_post = 5 THEN (select descripcion from photo  where post_idpost = id_post) 
WHEN type_post = 2 THEN ( select texto_articulo from articulo where post_idpost = idpost) 
 
END ) as contenido_texto  
  
,

(select if(UNIX_TIMESTAMP( ) - fecha >= 86400 , fecha , UNIX_TIMESTAMP( ) - fecha) from post where id_post = idpost)   as date
,
 
(select  id_user from user ,relationship , shared_info where id_user = id_user_topic and   Relationship_idRelationship  = idRelationship AND post_idpost = idpost limit 1)   
 as contenido_userset
,


(select  user_name from user ,relationship , shared_info where id_user = id_user_topic and   Relationship_idRelationship  = idRelationship AND post_idpost = idpost limit 1)   
 as user_name_set
,

(select  current_image_user from user ,relationship , shared_info  where id_user = id_user_topic and   Relationship_idRelationship  = idRelationship AND post_idpost = idpost limit 1)   
  as post_current_image_user
,
                  
(CASE 
WHEN type_post = 5 THEN   ( select image_photo  from photo where post_idpost = idpost) 
 
END) as img_pho ,

" . binds::getComentsReplySQL() . " , " . binds:: getWherePostComeFrom() . "

from contenido_lista , post  where contenido_lista.id_lista=$id_lista AND idpost = contenido_lista.id_post ORDER BY post.fecha desc";



		$res = mysql_query($sql, Conectar::con());

		while ($reg = mysql_fetch_assoc($res)) {

			$data[] = $reg;
		}


		for ($i = 0; $i < count($data); $i++) {

			$data[$i]["date"] = binds::getTime($data[$i]["date"]); // actualizamos y regresamos el timespend
			$data[$i]["timespend_reply"] = binds::getTime($data[$i]["timespend_reply"]); // actualizamos y regresamos el timespend
		}


		echo json_encode(array("lstNwPst" => $data));
	}

	public function get_interest_list($id_user) {


		$data = array();



		$sql = "SELECT list.id_lista , list.nombre_lista , ";

		$sql .= "(select count(id_post) from contenido_lista where id_lista = list.id_lista ) as counts ";

		$sql .= " from  lista as list where   id_user=$id_user";

		$sql .= " ORDER BY list.id_lista DESC";

		$res = mysql_query($sql, Conectar::con());

		while ($reg = mysql_fetch_assoc($res)) {

			$data[] = $reg;
		}




		echo json_encode(array('response' => $data));
	}

	public function create_interest_list($_POST) {

		extract($_POST);




		$sql = "INSERT INTO lista (id_lista ,id_user ,nombre_lista)
                  
                  VALUES ( NULL , $id_user , '$data'   );";

		mysql_query($sql, Conectar::con());

		$lastId = mysql_insert_id();

		echo json_encode(array('response' => $lastId));
	}

	public function insert_publication_into_interest_list($_POST) {

		extract($_POST);


		$sql = "INSERT INTO contenido_lista  VALUES ( NULL ,  $id_lista , $id_post );";

		mysql_query($sql, Conectar::con());
	}

	public function check_clone_publication($_POST) {

		$data = array();

		extract($_POST);



		$sql = "select count(id_contenido_lista )  as response from contenido_lista , lista where contenido_lista.id_post =$id_post and contenido_lista.id_lista=$id_lista

               and contenido_lista.id_lista = lista.id_lista";


		$res = mysql_query($sql, Conectar::con());

		while ($reg = mysql_fetch_assoc($res)) {

			$data[] = $reg;
		}




		echo json_encode(array('response' => ( $data[0]["response"] == 1 ) ? true : false));
	}

}

//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************************                                                                   ***************************************
//******************************** INSERTAR LOS CONTENIDOS EN DB --> POST --> SHARED_INFO->"CONTENT" ***************************************
//********************************                                                                   *************************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************************                                                                   ***************************************
//******************************** INSERTAR LOS CONTENIDOS EN DB --> POST --> SHARED_INFO->"CONTENT" ***************************************
//********************************                                                                   *************************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************************                                                                   ***************************************
//******************************** INSERTAR LOS CONTENIDOS EN DB --> POST --> SHARED_INFO->"CONTENT" ***************************************
//********************************                                                                   *************************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                           ***************************
//********************                                         COMMENTS                                          ***************************
//********************                                                                                           *************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************                                                                                           ***************************
//********************                                         COMMENTS                                          ***************************
//********************                                                                                           *************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************




class Coment {

	public function setcoment($coment, $user_set, $user_profile) { /* funcion para checar si estoy siguiendo al usuario */



		$coment = utf8_decode(rawurldecode($coment)); // codificar


		$sql = "INSERT INTO coment (id_coment ,coment ,date ,user_set ,user_profile)
                  
                  VALUES ( NULL , '$coment','" . strtotime(date("Y-m-d H:i:s")) . "', '$user_set' ,'$user_profile');";



		mysql_query($sql, Conectar::con());
	}

//---------------------------------------------------------------------------------------------------------------------------------



	public function SetComentReply($coment, $user_set, $parent, $datatype) {


		//  $coment = utf8_decode(rawurldecode($coment)); // codificar





		$sql = "INSERT INTO respuesta  VALUES ( NULL , '$coment','" . strtotime(date("Y-m-d H:i:s")) . "' , '$user_set'  , '$parent' );";




		mysql_query($sql, Conectar::con());
	}

//-------------------------------------------------------------------------------------------------------------------------------


	public function getReplycomentBylimit($ID_CONTEND, $limit, $type_post) {  // funcion que retorna los comentarios  con un limite inicial
		$coments = array();


		$sql = "select id_comment_reply as id_coment_reply , comment as coment , if(UNIX_TIMESTAMP( ) - fecha >= 86400 , fecha , UNIX_TIMESTAMP( ) - fecha) as timespend , user_set  as id_user , 

( select  user_name from user ,relationship , shared_info where id_user =user_set and   Relationship_idRelationship  = idRelationship  limit 1    ) as user_name ,


( select  current_image_user from user ,relationship , shared_info where id_user =user_set and   Relationship_idRelationship  = idRelationship  limit 1    ) as current_image_user 


from respuesta   where parent_comment = $ID_CONTEND  ORDER BY id_comment_reply
 

desc  limit  $limit,25 ";



		$res = mysql_query($sql, Conectar::con());


		while ($reg = mysql_fetch_assoc($res)) {

			$coments[] = $reg;
		}


		$coments = array_reverse($coments); // revertimos el array porque nos lo da ordenado de forma ASC esto con facilidad de poner limites al principio ver SQL

		for ($i = 0; $i < count($coments); $i++) {

			$coments[$i]["timespend"] = binds::getTime($coments[$i]["timespend"]); // actualizamos y regresamos el timespend
		}

		return $coments;
	}

//-------------------------------------------------------------------------------------------------------------------------------------------


	public function getLastoment($id_parent_coment_posted, $type, $datatype) { /* funcion que retorna todos los comentarios == id current */

		sleep(1);



		//  $id_parent_coment_posted = rawurlencode(utf8_encode($id_parent_coment_posted));


		switch ($type) {


			case "post_coment": { // obtiene el ultimo post
					$sql = "select id_comment_reply as id_coment_reply , comment as coment , if(UNIX_TIMESTAMP( ) - fecha >= 86400 , fecha , UNIX_TIMESTAMP( ) - fecha) as timespend , user_set  as id_user , 

( select  user_name from user ,relationship , shared_info where id_user =user_set and   Relationship_idRelationship  = idRelationship  limit 1    ) as user_name ,


( select  current_image_user from user ,relationship , shared_info where id_user =user_set and   Relationship_idRelationship  = idRelationship  limit 1    ) as current_image_user 


from respuesta   where parent_comment =  $id_parent_coment_posted  ORDER BY id_comment_reply DESC LIMIT 0 , 1 ";
				} break;


//---------------------------------------------------------------------------------------------------------------------------------------------           


			case "reply_post": { // obtiene el ultimo reply
					// $id_parent_coment_posted, $type, $datatype
					$sql = "select id_comment_reply as id_coment_reply , comment as coment , if(UNIX_TIMESTAMP( ) - fecha >= 86400 , fecha , UNIX_TIMESTAMP( ) - fecha) as timespend , user_set  as id_user , 

( select  user_name from user ,relationship , shared_info where id_user =user_set and   Relationship_idRelationship  = idRelationship  limit 1    ) as user_name ,


( select  current_image_user from user ,relationship , shared_info where id_user =user_set and   Relationship_idRelationship  = idRelationship  limit 1    ) as current_image_user 


from respuesta   where parent_comment =  $id_parent_coment_posted  ORDER BY id_comment_reply DESC LIMIT 0 , 1";
				} break;
		}


		$coment = array();

		$res = mysql_query($sql, Conectar::con());


		while ($reg = mysql_fetch_assoc($res)) {

			$coment[] = $reg;
		}

		$coment[0]["timespend"] = binds::getTime($coment[0]["timespend"]); // actualizamos y regresamos el timespend
		//  $coment[0]["coment"] = utf8_encode(htmlentities($coment[0]["coment"]));

		return $coment;
	}

}

//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************************                                                                   ***************************************
//********************************                            ARTICULOS                              ***************************************
//********************************                                                                   *************************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************************                                                                   ***************************************
//********************************                            ARTICULOS                              ***************************************
//********************************                                                                   *************************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************


class Articulo {

	public function set_articulo($content, $user_set, $userprofile) { /* funcion para checar si estoy siguiendo al usuario */


		$sql = " insert into post values (null ,2, '" . strtotime(date("Y-m-d H:i:s")) . "') "; // insertamos el contenido en POST


		mysql_query($sql, Conectar::con());



		$post_idpost = mysql_insert_id();  // obtenemos el id del POST donde se guardara la informacion ( PK)



		$sql = " insert into shared_info values (null ,$userprofile ,   $post_idpost  , $user_set ) "; // insertamos el contenido en POST



		mysql_query($sql, Conectar::con());



		$sql = "INSERT INTO articulo  VALUES ( NULL , '" . $content . "'  ,   $post_idpost )";



		mysql_query($sql, Conectar::con());
	}

	public function get_articulos_cronology($user_current) { /* funcion para checar si estoy siguiendo al usuario */


		$articles = array();



		$sql = " SELECT *FROM articulos where user_profile = $user_current ORDER BY  UNIX_TIMESTAMP( ) -  date ASC";



		$res = mysql_query($sql, Conectar::con());


		while ($reg = mysql_fetch_assoc($res)) {

			$articles[] = $reg;
		}

		for ($i = 0; $i < count($articles); $i++) {


			// $articles[$i]["texto_articulo"] = utf8_encode(htmlentities($articles[$i]["texto_articulo"]));
		}



		return $articles;
	}

}

//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************************                                                                   ***************************************
//********************************                            PHOTO                                  ***************************************
//********************************                                                                   *************************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************************                                                                   ***************************************
//********************************                            PHOTO                                  ***************************************
//********************************                                                                   *************************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************




class Photo {

	public function set_photo($content, $descr, $user_set, $userprofile) {


//----------------------------------------------------------------------------------------------------------------------



		$sql = " insert into post values (null ,5 , '" . strtotime(date("Y-m-d H:i:s")) . "') "; // insertamos el contenido en POST


		mysql_query($sql, Conectar::con());



		$post_idpost = mysql_insert_id();  // obtenemos el id del POST donde se guardara la informacion ( PK)
//----------------------------------------------------------------------------------------------------------------------

		$sql = " insert into shared_info values (null ,$userprofile ,  $post_idpost , $user_set) "; // insertamos el contenido en POST



		mysql_query($sql, Conectar::con());

//----------------------------------------------------------------------------------------------------------------------


		$sql = "INSERT INTO photo  VALUES ( NULL , '$content','" . $descr . "', $post_idpost );";


		mysql_query($sql, Conectar::con());
	}

	public function get_photos_cronology($user_current) {


		$articles = array();



		$sql = " SELECT *FROM photos where user_profile = $user_current ORDER BY  UNIX_TIMESTAMP( ) -  date ASC";



		$res = mysql_query($sql, Conectar::con());


		while ($reg = mysql_fetch_assoc($res)) {

			$articles[] = $reg;
		}

		for ($i = 0; $i < count($articles); $i++) {
			//	$articles[$i]["descripcion"] = utf8_encode(htmlentities($articles[$i]["descripcion"]));
		}

		return $articles;
	}

}

//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************************                                       ***************************************
//********************************                FRAMEWORK BINDS        ***************************************
//********************************                                                                   *************************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************************                                                                   ***************************************
//********************************              FRAMEWORK BINDS         ***************************************
//********************************                                                                   *************************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
// esta funcion sirve para guardar los datos primero en POST despues en shared_info , y despues en su contenido correspondiente ( Video , Photo , Music , article )


class binds {

// consulta para que este te regrese en que storyboard se encuentra este post ejemplo en listas necesitamos saber usuarioactualnombre @ de donde viene ? , o en cronology
	public function getWherePostComeFrom() {


		return "


  ( select type_user from  relationship , shared_info  where   idRelationship = relationship_storyboard  and post_idpost = id_contenido limit 1) as type_user


,  ( select id_user_topic  from  relationship ,  shared_info where  idRelationship = relationship_storyboard  AND post_idpost = id_contenido limit 1) as id_came_from,


(CASE 

WHEN  ( select type_user )  = 1 THEN 

( select user_name from user , relationship where id_user = id_user_topic  and type_user = 1 and id_user_topic = id_came_from limit 1) 



WHEN ( select type_user )  = 2 THEN 

( select nombre_topico from data_topic , relationship where idTopico = id_user_topic  and type_user = 2 and id_user_topic = id_came_from limit 1) 
 
END ) as name_came_from";
	}

//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------
// consulta para obtener todos los comentarios respuesta de los POST

	public function getComentsReplySQL() {

// para que funcione este SQL correctamente recordar que debemos agregar en el select principal " idpost as id_contenido  " para que haga comparacion este SQL con el principal

		return "
( select   count( user_set) from respuesta where  parent_comment = idpost  limit 1     ) as    coment_count_reply 
,


( select    user_set from respuesta where  parent_comment = idpost     ORDER BY id_comment_reply  DESC LIMIT 0 , 1 ) as  id_user_posted_reply ,

( select    id_comment_reply from respuesta where  parent_comment = idpost    ORDER BY id_comment_reply  DESC LIMIT 0 , 1 ) as  id_coment_reply ,

( select    comment from respuesta where  parent_comment = idpost   ORDER BY id_comment_reply  DESC LIMIT 0 , 1 ) as  text_coment_reply ,

( select  user_name from user ,relationship , shared_info where id_user =id_user_posted_reply and   Relationship_idRelationship  = idRelationship  limit 1    ) as reply_user_name
 ,

(   select  current_image_user from user,relationship, respuesta where id_user = id_user_topic and id_user_topic = user_set and parent_comment = idpost
 limit 1    ) as    reply_current_image_user
  ,

( select    if(UNIX_TIMESTAMP( ) - fecha >= 86400 , fecha , UNIX_TIMESTAMP( ) - fecha)   from respuesta where  parent_comment = id_contenido ORDER BY id_comment_reply DESC LIMIT 0 , 1    ) as    timespend_reply
";
	}

//----------------------------------------------------------------------------------------------------- obtener urls

	public function getUrlbyId($url) {


		$sql = " SELECT idTopico , count(idTopico) as found FROM data_topic WHERE nombre_topico like '$url'";



		$res = mysql_query($sql, Conectar::con());


//-----------------------------------------------------------------------------------------------------

		while ($reg = mysql_fetch_assoc($res)) {

			$id[] = $reg;
		}


		if ($id[0]["found"] > 0) {

			return $id[0]["idTopico"];
		} else {

			return 0;
		}
	}

//----------------------------------------------------------------------------------------------------------------



	public function getTime($timestamp) {



		$timeAgo = "";
		$days = floor($timestamp / (60 * 60 * 24));
		$remainder = $timestamp % (60 * 60 * 24);
		$hours = floor($remainder / (60 * 60));
		$remainder = $remainder % (60 * 60);
		$minutes = floor($remainder / 60);
		$seconds = $remainder % 60;

		if ($days > 0) {



			$mexico = 21600; // mexico utc-6 hrs 
			$test = $timestamp - $mexico;
			$Numerodia = date("j", $test);
			$dia = date(" N ", $test);
			$mes = date(" n ", $test);
			$hora = date("g:i a ", $test);

			switch ($dia) {

				case 1: {
						$dia = "lunes";
					}break;
				case 2: {
						$dia = "Martes";
					}break;
				case 3: {
						$dia = "Miercoles";
					}break;
				case 4: {
						$dia = "Jueves";
					}break;
				case 5: {
						$dia = "Viernes";
					}break;
				case 6: {
						$dia = "Sabado";
					}break;
				case 7: {
						$dia = "Domingo";
					}break;
			}


			switch ($mes) {

				case 1: {
						$mes = "Enero";
					}break;
				case 2: {
						$mes = "Febrero";
					}break;
				case 3: {
						$mes = "Marzo";
					}break;
				case 4: {
						$mes = "Abril";
					}break;
				case 5: {
						$mes = "Mayo";
					}break;
				case 6: {
						$mes = "Junio";
					}break;
				case 7: {
						$mes = "Julio";
					}break;
				case 8: {
						$mes = "Agosto";
					}break;
				case 9: {
						$mes = "Septiembre";
					}break;
				case 10: {
						$mes = "Octubre";
					}break;
				case 11: {
						$mes = "Nomviembre";
					}break;
				case 12: {
						$mes = "Diciembre";
					}break;
			}




			//   $timeAgo = " El  ".$dia."  ".$Numerodia."  de ". $mes. " a las ".$hora;  con dia

			$timeAgo = $Numerodia . "  de " . $mes . " a las " . $hora; // sin dia
		} else
		if ($days == 0 && $hours == 0 && $minutes == 0) {

			if ($seconds == 1) {
				$timeAgo = "hace " . $seconds . " segundo";
			} else {

				$timeAgo = "hace " . $seconds . " segundos ";
			}
		} else
		if ($hours) {

			if ($hours < 2) {

				$timeAgo = "hace " . $hours . ' hora';
			} else {

				$timeAgo = "hace " . $hours . ' horas';
			}
		} else
		if ($days == 0 && $hours == 0) {

			if ($minutes == 1) {

				$timeAgo = "hace " . $minutes . ' minuto';
			} else {

				$timeAgo = "hace " . $minutes . ' minutos';
			}
		}

		return $timeAgo;
	}

//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------          

	function set_publication_into_post() {  // funcion para insertar los post de tal forma que se ingrese en este orden ---- post ---- shared_info ---- "content "
	}

//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------



	public function validate_data($id_user, $type_user) {
		//$id_user = sanitizeString($id_user);
		// hacer validacioon de URL!!!!!!!!!!!!!!!!!!!!!



		$data = login::get_user_data($id_user, $type_user);




		if (!isset($data) || empty($data)) {



			die(" Error 404 uno bonito <a href='home.php'>click here </a>");
		} {



			$_SESSION["name_view"] = " " . $data[0]["name"] . " " . $data[0]["lastname"]; // nombre completo 

			$_SESSION["id_user_view"] = $id_user;


			return $data;
		}
	}

//-------------------------------------------------------------------------------------------------------------------------------------------



	public function getTheGlobalIdUserOrTopic($id_user, $type_user) {

		$data = array();

		$sql = "SELECT idRelationship from relationship where   id_user_topic = " . $id_user . " AND type_user = " . $type_user . ""; // 1.- tipo persona


		$res = mysql_query($sql, Conectar::con());



		while ($reg = mysql_fetch_assoc($res)) {

			$data[] = $reg;
		}


		return $data[0]["idRelationship"];
	}

}

//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************************                                                                   ***************************************
//********************************                 FUNCIONES PARA VALIDACION DE DATOS DE ENTRADA     ***************************************
//********************************                                                                   *************************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************************                                                                   ***************************************
//********************************                 FUNCIONES PARA VALIDACION DE DATOS DE ENTRADA     ***************************************
//********************************                                                                   *************************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************************                                                                   ***************************************
//********************************                            VIDEO                                  ***************************************
//********************************                                                                   *************************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//********************************                                                                   ***************************************
//********************************                            VIDEO                                  ***************************************
//********************************                                                                   *************************************** 
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************
//******************************************************************************************************************************************/

class video {

	public function set_video($content, $descr, $user_set, $userprofile) { /* funcion para checar si estoy siguiendo al usuario */



		$sql = " insert into post values (null ,4 , '" . strtotime(date("Y-m-d H:i:s")) . "') "; // insertamos el contenido en POST


		mysql_query($sql, Conectar::con());



		$post_idpost = mysql_insert_id();  // obtenemos el id del POST donde se guardara la informacion ( PK)



		$sql = " insert into shared_info values (null ,$userprofile ,  $post_idpost , $user_set) "; // insertamos el contenido en POST



		mysql_query($sql, Conectar::con());



		$sql = "INSERT INTO video  VALUES ( NULL , '$content','" . $descr . "', $post_idpost );";


		mysql_query($sql, Conectar::con());
	}

	public function get_videos_cronology($user_current) {


		$articles = array();

		$sql = " SELECT * FROM video where user_profile = $user_current ORDER BY  UNIX_TIMESTAMP( ) -  date ASC";

		$res = mysql_query($sql, Conectar::con());

		while ($reg = mysql_fetch_assoc($res)) {
			$articles[] = $reg;
		}

		for ($i = 0; $i < count($articles); $i++) {
			$articles[$i]["descripcion"] = utf8_encode(htmlentities($articles[$i]["descripcion"]));
		}

		return $articles;
	}

}

function sanitizeString($var) {
	$var = strip_tags($var);
	$var = nl2br(htmlspecialchars($var));
	//$var = htmlentities($var);
	$var = stripslashes($var);

	return $var; //mysql_real_escape_string($var);
}

function setFollow() {
	$setFollowerUser = new subscribe();
	$setFollowerUser->setFollowing($_SESSION['current_id'], $_SESSION['id_user_view']);
}

class UserInfo {

	public function getUserInfo($user_current) {
		$infoUser = array();

		$sql = " SELECT * FROM user where id_user = $user_current";

		$res = mysql_query($sql, Conectar::con());

		while ($reg = mysql_fetch_assoc($res)) {
			$infoUser[] = $reg;
		}

		for ($i = 0; $i < count($infoUser); $i++) {
			$infoUser[$i]["quote"] = utf8_encode(htmlentities($infoUser[$i]["quote"]));
		}

		echo json_encode(array('query' => $infoUser));
	}

	public function setUserInfo($_POST, $iduser, $img1, $img2) {

		if (isset($_POST["username"]) && isset($_POST["url"]) && isset($_POST["quote"])) {

			$usrname = $_POST["username"];
			$urluser = $_POST["url"];
			$quote = $_POST["quote"];
			$sql = "update user set user_name= '" . $usrname . "',url =  '" . $urluser . "' ,quote= '" . $quote . "'";
			if (!empty($img1))
				$sql .= ",current_image_user='" . $img1 . "'";
			if (!empty($img2))
				$sql .= ",bg='" . $img2 . "'";
			$sql .=" where id_user=" . $iduser . "";

			//echo $sql;
			mysql_query($sql, Conectar::con());
			return $sql;
		}
	}

}

class subscriptions {

	public function getSubscriptions($current_user, $from, $to) {
			$sql = "select 
	id_user_topic as idStory,
	type_user,

(CASE
when type_user = 1 then(select user_name from user where id_user = idStory)
when type_user = 2 then (select nombre_topico from data_topic where id_data_topic = idStory)
END) as username,

(CASE
when type_user = 2 then(select idTopico from data_topic where idTopico = idStory)
END) as topicID,

(CASE
when type_user = 1 then(select current_image_user from user where id_user = idStory)
when type_user = 2 then (select current_image from topico where idTopico = topicID)
END) as imagen,

(CASE
when type_user = 1 then(select quote from user where id_user = idStory)
when type_user = 2 then (select quote from topico where idTopico = topicID)
END) as quoteText,

(case
when type_user = 1 then (select bg from user where id_user= idStory)
END) as fondo,

(case
when type_user = 1 then (select name from data_user where id_data_user = idStory)
end ) as nombre,

(case
when type_user = 1 then (select lastname from data_user where id_data_user = idStory)
end ) as apellido

from subscribe,relationship 
where subscriber = $current_user and idRelationship = subscribers limit $from, $to";

		$infoUser = array();

		$res = mysql_query($sql, Conectar::con());

		while ($reg = mysql_fetch_assoc($res)) {
			$infoUser[] = $reg;
		}

		for ($i = 0; $i < count($infoUser); $i++) {
			$infoUser[$i]["username"] = utf8_encode(htmlentities($infoUser[$i]["username"]));
		}

		return $infoUser;
		//echo json_encode(array('query' => $infoUser));
	}

}

class InstantSearch {

	public function getElements($term) {
		$sql = "select ";
	}

}

?>
