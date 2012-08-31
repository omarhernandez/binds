<?php

session_start();
require_once("class/class.php");

class loginClass {

                  private $fields;
                  private $PermitionSession = false;

                  public function __construct() {
                                    $this->fields = array();
                  }

                  public function session() {



                                    $user = sanitizeString($_POST["user"]);
                                    $password = md5(sanitizeString($_POST["password"]));

                                    $sql = "SELECT user_name,password,name,current_image_user ,lastname,id_user,url FROM  user";
                                    $res = mysql_query($sql, Conectar::con());

                                    while ($reg = mysql_fetch_assoc($res)) {//fetch_assoc retorna los datos en un arreglo (este array es de 2 dimenciones
                                                      $this->fields[] = $reg;
                                    }

                                    for ($i = 0; $i < sizeof($this->fields); $i++) {

                                                      if ($user == $this->fields[$i]["user_name"] && $password == $this->fields[$i]["password"]) {

                                                                        $this->PermitionSession = true;

                                                                        $_SESSION['current_user'] = $user;  // usuario


                                                                        $_SESSION["current_name"] = " " . $this->fields[$i]["name"] . " " . $this->fields[$i]["lastname"]; // nombre completo 

                                                                        $_SESSION["name"] = $this->fields[$i]["name"];

                                                                        $_SESSION["current_photo"] = $this->fields[$i]["current_image_user"];   // imagen URL

                                                                        $_SESSION["current_id"] = $this->fields[$i]["id_user"];
                                                                        
                                                                        
                                                                          $_SESSION["url"] = $this->fields[$i]["url"];


                                                                        $_SESSION["visitor"] = false;

                                                                        echo " <script>window.location = 'home.php';</script>";
                                                      }
                                    }


                                    if (!$this->PermitionSession) {

                                                      echo "clave o usuario incorrecto!";
                                    }
                  }

}

?>
