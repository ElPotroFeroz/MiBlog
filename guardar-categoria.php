<?php

if(isset($_POST)) {
    //Conexion to database
    require_once 'includes/conexion.php';
    
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    
    //array errores
    $errores = array();
    
    //Validate before save
    //Name
    if (!empty($nombre)) {
        $validate_name = true;       
    } else {
        $validate_name = false;
        $errores['nombre'] = "Nombre no valido";
    }
    if (count($errores)==0) {
        $sql = "INSERT INTO categorias VALUES(null, '$nombre');";
        $guardar = mysqli_query($db, $sql);       
    } else {
        var_dump($errores);
        die();
    }
}
header('Location: index.php');