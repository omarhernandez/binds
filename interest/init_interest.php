<?php

session_start();

 $_SESSION["type_user"] = 2;
 
if (empty($_REQUEST["id"])) {

                  echo "<script>window.location = ' index.php  '</script>";
} else {

                  /* obtenemos la info del id que se pasa por get */
                  

                  $response =  binds::getUrlbyId($_REQUEST["id"]);


                  if($response == 0 ){ }else{$_REQUEST["id"] =$response; }

                     // atraves del id original del interes vamos por los datos
                  
                  $user_or_topic_data =  binds::validate_data($_REQUEST["id"],2); //RECUERDA VALIDAR LA URL !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 
                 
                  $global_id_view = binds::getTheGlobalIdUserOrTopic($_REQUEST["id"], 2); // obetenemos el id global de relationship para saver si es persona o topico



                  $_SESSION["global_id_view"] = $global_id_view;
    
                  /* obtenemos la foto nombre y id de los seguidores */
                  $getInformationFollowers = new subscribe();

                  $view_follower_user = $getInformationFollowers->getsubscribeInformation($global_id_view);

                  $imAlreadyFollowd = new subscribe(); /* funcion para ver si el usuario que estamos viendo ya lo stamos siguiendo */

                  $_SESSION["limit_pagination"] = 0; // nueva paginacion             

                  $statsFollowCurrentUser = $getInformationFollowers->getFollowCount($global_id_view);

 

                  if (!empty($_SESSION['current_id'])) {


                                    $global_id = $_SESSION["global_id_current"];


                                    $imAlreadyFollowd = $getInformationFollowers->isAlreadySubscribed($global_id, $global_id_view);




                                    $_SESSION["visitor"] = false;

                                    $_SESSION["article"] =  $global_id_view;  // para saber a que usuario le insetaremos el articulo
                  } else {


//*********************************************************************************************************************************
// si el usuario no esta logeado , osea es un visitante :)

                                    $_SESSION["current_user"] = "";

                                    $_SESSION["current_id"] = "";

                                    $imAlreadyFollowd = 0; // no seguimos a nadie


                                    $_SESSION["current_photo"] = "";


                                    $_SESSION["visitor"] = true;
                  }
}
?>
