<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
//cambie el nombre de la base de datos que creó
define('DB_NAME', 'database_project');
 
/* Intento de conexión a la base de datos MySQL */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Revisa conexión
if($link === false){
    die("ERROR: No se puede establecer la conexión " . mysqli_connect_error());
}
?>