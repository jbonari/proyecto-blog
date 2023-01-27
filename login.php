<?php

//iniciar la sesion y la conexion

require_once 'includes/conexion.php';

//recoger datos del formulario

if(isset($_POST)){

    //Borrar error antiguo
    if(isset($_SESSION['error_login'])){
        unset($_SESSION['error_login']);
    }

    //recoger datos del formulario
    $email=trim($_POST['email']);
    $password=$_POST['password'];

    //consulta para comprobar las credenciales del usuario
    $sql= "SELECT * FROM usuarios WHERE email='$email'";
    $login=mysqli_query($db,$sql);

    if($login && mysqli_num_rows($login)==1){
        $usuario=mysqli_fetch_assoc($login);

        //comprobar password
        $verify=password_verify($password,$usuario['password']);
        var_dump($usuario);
        //die();
        if($verify){
            //utilizar una sesion para guardar los datos del usuario
            $_SESSION['usuario']=$usuario;

        }else{
            //si algo falla, enviar una sesion con el fallo
            $_SESSION['error_login']="login incorrecto";
            }

    }else{
    //mensaje error
        $_SESSION['error_login']="login incorrecto";
    }


}



//redirigir al index_maqueta.php

header('Location: index.php');
