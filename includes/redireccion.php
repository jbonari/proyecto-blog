<?php

if(!isset($_SESSION)){
    //iniciar la session
    session_start();
}


if(!isset($_SESSION['usuario'])){
    header("location:index_maqueta.php");
}