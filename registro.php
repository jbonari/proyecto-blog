<?php

if (isset($_POST)) {

    //Conectamos a la BBDD
    require_once 'includes/conexion.php';

    //iniciamos la sesion
    if(!isset($_SESSION)){
        session_start();
    }

    //recoger valores formulario

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = $_POST['apellidos'] ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

    //Array de errores
    $errores=array();

    //validar datos antes de guardarlos

    //validar campo nombre
    if(!empty($nombre) && !is_numeric($nombre)&&!preg_match("/[0-9]/",$nombre)){
        $nombre_validado=true;
    }else{
        $nombre_validado=false;
        $errores['nombre']="El nombre no es válido";
    }


    //validar apellido
    if(!empty($apellidos) && !is_numeric($apellidos)&&!preg_match("/[0-9]/",$apellidos)){
        $apellidos_validado=true;
    }else{
        $apellidos_validado=false;
        $errores['apellidos']="Los apellidos no son válidos";
    }

    //validar email
    if(!empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL)){
        $email_validado=true;
    }else{
        $email_validado=false;
        $errores['email']="El email no es válido";
    }

    //validar password
    if(!empty($password) ){
        $password_validado=true;
    }else{
        $password_validado=false;
        $errores['password']="contraseña vacía";
    }

    $guardar_usuario=false;
    if(count($errores)==0){
        $guardar_usuario=true;

        //ciframmos la contraseña
        $password_segura=password_hash($password,PASSWORD_BCRYPT,['cost'=>4]);

        var_dump($password);
        var_dump($password_segura);
        var_dump(password_verify($password,$password_segura));
        //die();

        //insertamos usuarios en BBDD

        $sql= "INSERT INTO usuarios VALUES(null, '$nombre','$apellidos','$email','$password_segura',CURDATE())";
        $guardar =mysqli_query($db,$sql);

        var_dump(mysqli_error($db));
        //die();

        if($guardar){
            $_SESSION['completado']="Registro completado con éxito";
        }else{
            $_SESSION['errores']['general']="Fallo al guardar el usuario";
        }


    }else{
    $_SESSION['errores']=$errores;

    }
}

header('Location: index_maqueta.php');