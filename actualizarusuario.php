<?php

if (isset($_POST)) {
    //Load conection to the DataBase
    require_once 'includes/conexion.php';
    
    //Collect values   
    $name = isset($_POST['nombre']) ? $_POST['nombre'] : false ;
    $surname = isset($_POST['apellidos']) ? $_POST['apellidos'] : false ;
    $email = isset($_POST['email']) ? trim($_POST['email']) : false ;
    
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
    
    if (count($errores) == 0) {
        $save_user = true;
        $usuario = $_SESSION['usuario']; //Asignamos a la variable la sesion del usuario identificado
        
        //PREPARE FOR CHECK IF EMAIL EXIST IN DATABASE
        $check_email = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $check_email);
        $isset_user = mysqli_fetch_assoc($isset_email);
                
        //CHECK with if()
        if($isset_user['id'] == $usuario['id'] || empty($isset_user)) {
            //ACTUALIZE USER IN DATABASE     
            //Prepare the query
            $query = "UPDATE usuarios SET nombre = ?, apellidos = ?, "
                    . "email = ? WHERE id = " . $usuario['id'];
            $stmt = mysqli_prepare($db, $query); 
            mysqli_stmt_bind_param($stmt, "sss", $name, $surname, $email);

            //Execute the query
            if(mysqli_stmt_execute($stmt)) {
                $_SESSION['completado'] = "Tus datos se han actualizado con exito!";
                //Actualize the data of the user
                $_SESSION['usuario']['nombre'] = $name;
                $_SESSION['usuario']['apellidos'] = $surname;
                $_SESSION['usuario']['email'] = $email;
            //ERROR
            } else {
                $_SESSION['errores']['general'] = "Fallo al actualizar tus datos".mysqli_error($db);
            }
        } else {
            $_SESSION['errores']['general'] = "El usuario ya existe!";
        }
      
    } else {
        $_SESSION['errores'] = $errores;        
    }
}
header('Location: misdatos.php');
