<?php

include("../class.php");
// insertaremos un post en destacados
if (isset($_POST)) {
 

                  switch ($_GET["type"]) {


                                    case "send_to_highlight" : { // si se envia a destacados 
                                                      
                                     
                                                      
                                                                        $insert = new highlight();

                                                                        $insert->set_post_into_highlight($_POST);
                                                      }break;


                                    case "c_p_h" : {

                                                                       $insert = new highlight();
                                                                        $insert->check_clone_highlight($_POST);
                                                      }break;
                  }
}
?>
