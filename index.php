
<?php ?>


<!doctype html>
<html>
                  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>    
                  <title> </title>

                  <head>
                                    <link rel="shortcut icon" href="images/icon/binds.png" type="image/x-icon" />
                                    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />     
                                    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />    
                                    <link rel="stylesheet" type="text/css" href="login/css/login.css" media="screen" />  
                                    <link rel="stylesheet" type="text/css" href="css/buttons.css" media="screen" />
                                    <script type="text/javascript" src="js/jquery-1.6.js" ></script>
                                    <script type="text/javascript" src="login/js/InitIndexFunctions.js"></script>

                  </head>

                  <body>

                                    <div id="ContainerInformation">



                                                      <!--      INICIAR SESION     -->

                                                      <div id="formContainer"  >
                                                                        
                                                                        <form id="login" name="form1" method="post"    class="right fixPosLogn"   >            
                                                                                          <ul>
                                                                                                            <li class="listForm" ><input class="inputStyle inpt-form-login" placeholder="Usuario" id="loginUser"  name="user"/> </li>
                                                                                                            <li class="listForm" > <input class="inputStyle inpt-form-login" placeholder="Contrasena" id="passwordUser" type="password"  name="password"/></li> 
                                                                                                            <li class="listForm" > <a class="buttonGray log-in" >Entrar</a></li> 

                                                                                          </ul>

                                                                        </form>    

                                                      </div>


                                                      <div  id="WrapperInformation" > <!-- contenedor de informacion -->





                                                                        <div class="contentMessage1"> 


<div class="logo_"> </div>


                                                                              Conoce gente con intereses similares a ti  y  comparte tu pasion por lo que haces.

                                                                                          <br />   <br />
                                                                                          <span  class="contentMessage2 NotextTrans">
                                                                                 binds es un servicio que conecta a personas a traves de intereses y ayuda construyendo una red de informacion .
                                                                                          </span>   
                                                                        </div>


                                                                        <div  class="ContainerFormInputSingup">

                                                                                          <div class="contentMessage2 footerInfoFixed fontBold blueB buttonAcces" id="JoinUsMessage"> Unete a Binds ahora!
                                                                 
                                                                                          </div>   

                                                                                          <form id="sender" name="form" method="post"  enctype="multipart/form-data"  >          
                                                                                                            <div  id="slideForm" class="formSingUp">

                                                                                                                              <span id="respuesta"></span> <!-- RESPUESTA -->
                                                                                                                              <input class="inputStyle FixinputForm" placeholder="Usuario" id="registerUser"  name="user"     /> 

                                                                                                                              <input class="inputStyle FixinputForm" placeholder="Correo" name="email" />   
                                                                                                                              <input class="inputStyle FixinputForm" type="password" placeholder="Password" /> 
                                                                                                                              <input class="inputStyle FixinputForm"  type="password" placeholder="confirmar Password"  name="password"/>


                                                                                                            </div>

                                                                                                     

                                                                                                            <input type="button"  class="fixNewButton buttonGray FixSubt blue-ui"  value="Registrar"  id="BSubM" />  
                                                                                          </form>   

                                                                                      
                                                                        </div>   






                                                      </div>


                                                      <div id="footerInfo" >
                                                                        <ul>
                                                                                          <li class="footerInfoFixed"  > &copy;2012 Binds</li>
                                                                                          <li class="footerInfoFixed">Terminos</li>  
                                                                                          <li class="footerInfoFixed">Politica </li>
                                                                                          <li class="footerInfoFixed" > Privacidad  </li>

                                                                        </ul>
                                                      </div> 

                                    </div>   




                  </body>




</html>