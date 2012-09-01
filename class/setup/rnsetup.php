<?php  
include_once ('instalation.php');


$createDataBases = new createDB();

 $createDataBases->CreateDatabase("users");
 $createDataBases->UseDatabase("users");
// tabla datos de usuarios 
$createDataBases->CreateTable('user', '(id_user INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
user_name VARCHAR( 20 ) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
password VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
email VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL ,
url VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
name VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
lastname VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
current_image_user  VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL 
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_spanish_ci;');

$createDataBases->CreateTable('personal_state', '(id_user_rel INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
current_image_user VARCHAR( 80 ) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
quote text( 150 ) CHARACTER SET ucs2 COLLATE ucs2_spanish_ci NOT NULL  
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_spanish_ci;');

// tabla follow
$createDataBases->CreateTable('follow', '(id_follow INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
follower id_follow INT UNSIGNED NOT NULL ,
following id_follow INT UNSIGNED NOT NULL ,  
) ENGINE = InnoDB;');


//  tabla de comentarios
$createDataBases->CreateTable('coment', '(id_coment INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
coment TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL ,
date DATE NOT NULL,  
) ENGINE = InnoDB;');

$createDataBases->CreateTable('id_relcoment', '(id_coment INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
id_user_set INT UNSIGNED NOT NULL,
id_user_profile INT UNSIGNED NOT NULL 
) ENGINE = InnoDB;');


$createDataBases->CreateTable('thread_coment', '(id_thread_coment INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
id_thread_coment INT UNSIGNED NOT NULL,
id_coment INT UNSIGNED NOT NULL 
) ENGINE = InnoDB;');




 



?>




