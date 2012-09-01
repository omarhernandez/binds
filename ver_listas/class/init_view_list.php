<?php
session_start();
include_once 'class/class.php';
if (!isset($_SESSION['current_user'])) {

			die("No has iniciado sesion . Por Favor <a href='index.php'>Click aqui</a>.");
} else { // hacer la llamada a todos los datos necesarios para este usuario
		
 

   echo '<script>function globalVars(){
           
                  
      return    {   id_list :   '. $_GET["id_list"].'  ,  set_location : "view_list" };
           
 
 }
</script>';
			
			
		 $_GET["id_user"] ; 
			
			
											 
		 $get_list_user = new lists_user ();
		 
		 $data_list = $get_list_user->get_list_information_by_id_list_and_user_id($_GET);  // obtenemos la informacion del header osea nombre del usuario y nombre de lista
 
 //************************************************************************************* obtenemos datos de la lista
 
  
}

 
?>