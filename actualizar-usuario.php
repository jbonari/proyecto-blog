<?php

if (isset($_POST)) {

    //Conectamos a la BBDD
    require_once 'includes/conexion.php';

    //recoger valores formulario

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;


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

    $guardar_usuario=false;

    if(count($errores)==0){
        $usuario=$_SESSION['usuario'];
        $guardar_usuario=true;

        //comprobar si el email ya existe
        $sql="SELECT id,email FROM usuarios WHERE email='$email'";
        $isset_email=mysqli_query($db,$sql);
        $isset_user=mysqli_fetch_assoc($isset_email);

        if($isset_user['id']==$usuario['id'] || empty($isset_user)){
            //actualizar usuarios en BBDD
            $usuario=$_SESSION['usuario'];

            $sql= "UPDATE usuarios SET 
               nombre ='$nombre',
               apellidos='$apellidos',
               email='$email'
               WHERE id =".$usuario['id'] ;
            $guardar =mysqli_query($db,$sql);


            if($guardar){
                //actualizamos los datos en la sesion del usuario
                $_SESSION['usuario']['nombre']=$nombre;
                $_SESSION['usuario']['apellidos']=$apellidos;
                $_SESSION['usuario']['email']=$email;
                $_SESSION['completado']="Tus datos se han actualizado con éxito";
            }else{
                $_SESSION['errores']['general']="Fallo al actualizar el usuario";
            }

        }else{
            $_SESSION['errores']['general']="Ya existe el usuario";
        }


    }else{
        $_SESSION['errores']=$errores;

    }
}

header('Location: mis-datos.php');
