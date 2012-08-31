<?php
 
  class createDB{
       
       
       
     
    public static function con(){
    
       $conexion = mysql_connect("localhost","root","") or
    die("Error de conexion: " . mysql_error());  // hacemos conexion al serv
      
   
	mysql_query ("SET NAMES 'utf-8'");
    
     
  
       return $conexion;
         
    } 
 
       public function CreateTable($name, $query){
            
 
                mysql_query("CREATE TABLE $name$query",createDB::con()); // pasamos la consulta y la conexion
		echo "Table '$name' created<br />";
	 
    }
    
       public function CreateDatabase($name){

                mysql_query("CREATE DATABASE $name",createDB::con()); //  
		echo "Database '$name' created<br />";
	 
    }
    
      public function UseDatabase($name){

             mysql_select_db($name) or
    die("Error de conexion: " . mysql_error());//seleccionamso la tabla agency car   
           
    echo "changed ".$name; 
    }
     

    }

    
    ?>
