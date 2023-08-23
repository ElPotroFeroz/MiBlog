<?php

if (isset($_POST)) {
    //Cargar la conexion a la DataBase
    require_once 'includes/conexion.php';
    if(!isset($_SESSION)) { 
    //Start session
    session_start();
    }
    //Colect values   
    $name = isset($_POST['nombre']) ? $_POST['nombre'] : false ;
    $surname = isset($_POST['apellidos']) ? $_POST['apellidos'] : false ;
    $email = isset($_POST['email']) ? trim($_POST['email']) : false ;
    $password = isset($_POST['password']) ? $_POST['password'] : false ;
    
    //array errores
    $errores = array();
    
    //Validate before save
    //Name
    if (!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)) {
        $validate_name = true;
    } else {
        $validate_name = false;
        $errores['nombre'] = "Nombre no valido";
    }
    //Surname
    if (!empty($surname) && !is_numeric($surname) && !preg_match("/[0-9]/", $surname)) {
        $validate_surname = true;
    } else {
        $validate_surname = false;
        $errores['apellidos'] = "Apellido no valido";
    }
    //Email
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validate_email = true;
    } else {
        $validate_email = false;
        $errores['email'] = "Email no valido";
    }
    //Password
    if (!empty($password)) {
        $validate_password = true;
    } else {
        $validate_password = false;
        $errores['password'] = "Password no valida";
    }
    if (count($errores) == 0) {
        $save_user = true;
        
        //ENCRYPT PASSWORD
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
        
        //INSERT USER IN DATABASE
        /*
        $sql = "INSERT INTO usuarios VALUES(null, '$name', '$surname', '$email', '$password_segura', CURDATE());";
        $save = mysqli_query($db, $sql);
        */
        $stmt = mysqli_prepare($db, "INSERT INTO usuarios (id, nombre, apellidos, email, password, fecha) "
                . "VALUES (null, ?, ?, ?, ?, CURDATE())");
        mysqli_stmt_bind_param($stmt, "ssss", $name, $surname, $email, $password_segura);
        
//        var_dump(mysqli_error($db));
//        die();
        
        if(mysqli_stmt_execute($stmt)) {
            $_SESSION['completado'] = "El registro se ha completado con exito!";
        } else {
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario!";
        }
      
    } else {
        $_SESSION['errores'] = $errores;        
    }
}
header('Location: index.php');
