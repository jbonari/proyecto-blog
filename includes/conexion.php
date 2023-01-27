<?php
//Conexion BBDD

$servidor="localhost";
$usuario="root";
$password="";
$basededatos= "blog_master";

$db=mysqli_connect($servidor,$usuario,$password,$basededatos);



//mysqli_query($db,"SET NAME 'utf8'");

//printf("Conjunto de caracteres inicial: %s\n", $db->character_set_name());

/* cambiar el conjunto de caracteres a utf8 */
if (!mysqli_set_charset($db, "utf8")) {
    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($db));
    exit();
} else {
    printf("Conjunto de caracteres actual: %s\n", mysqli_character_set_name($db));
}

if(!isset($_SESSION)){
    //iniciar la session
    session_start();
}