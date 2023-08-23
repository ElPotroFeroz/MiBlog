<?php
//Init sesion and the conexion to database
require_once 'includes/conexion.php';

//Collect data of the user
if (isset($_POST)) {
     //Delete old session
     if(isset($_SESSION['error_login'])) {
        unset($_SESSION['error_login']);
     }
    
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    //Query database
    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $query);
    
    if ($login && mysqli_num_rows($login) == 1) {
        $usuario = mysqli_fetch_assoc($login);
        
        //Verify password
        $password_verify = password_verify($password, $usuario['password']);
        if ($password_verify) {
            $_SESSION['usuario'] = $usuario;
            
        } else {
            //If something fail
            $_SESSION['error_login'] = "Login incorrecto";
        }  
    
    } else {
        $_SESSION['error_login'] = "Login incorrecto";
    }
}
//Comeback to index
header('Location: index.php');