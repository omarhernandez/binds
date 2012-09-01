<?php 

require_once("class.php");

 


if (isset($_POST['user']))
{
     
        $ar = array(); 
 	$user = sanitizeString($_POST['user']);
	$sql = "SELECT count(user_name) as dispobible FROM user WHERE user_name='$user'";

        
         $res = mysql_query($sql,Conectar::con());   
        
         
           while($reg = mysql_fetch_assoc($res)){ 
                  $ar[]=$reg;
            }
         
	if ($ar[0]["dispobible"] > 0)  // regresamos 1 si el usuario existe
             
		echo "1";
	
        else echo "0";
}
?>
