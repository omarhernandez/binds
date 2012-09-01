<?php

include "../class.php";


switch ($_GET["type"]) {



                  case "get_list": { // obtener las listas en modo IS (instant search)
                                                      $get_list_user_data = new lists_user();

                                                      $get_list_user_data->get_lists_user($_POST["q"], $_POST["id_data"]);
                                    } break;



                  case "get_instant_search": {
                                                      
                                    } break;
}
?>
