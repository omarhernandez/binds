<?php

include('../../class/class.php');


switch ($_GET["type"]) {

                  case "rnd" : { // iniciamos categroias en random();
                                                      $get_categories = new category ();

                                                      $get_categories->getCategoriesRandom();
                                    }break;

                  case "init" : { // insertamos nuevo interes
                                                      $set_categories = new category ();

                                                      $set_categories->setTopicInterest($_POST);
                                    }break;
}
?>
