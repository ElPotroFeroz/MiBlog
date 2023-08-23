<?php

if(isset($_POST)) {
    require_once 'includes/conexion.php';
    
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
    $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
    $usuario = $_SESSION['usuario']['id'];
    //Validation
    $errores = array();
    
    if(empty($titulo)) {
        $errores['titulo'] = 'El titulo no es valido';
    }
    if(empty($descripcion)) {
        $errores['descripcion'] = 'La descipcion no es valida';
    }
    if(empty($categoria)) {
        $errores['categoria'] = 'La categoria no es valida';
    }
    
    //Prepare consulting
    if(count($errores) == 0) {
        //Comprueba si son datos para editar o insertar
        if(isset($_GET['editar'])) {
            $id_entrada_actual = $_GET['editar'];
            $stmt = mysqli_prepare($db, "UPDATE entradas SET titulo = ?, "
                    . "descripcion = ?, categoria_id = ? "
                    . "WHERE id = $id_entrada_actual AND usuario_id = $usuario");
            mysqli_stmt_bind_param($stmt, "ssi", $titulo, $descripcion, $categoria);
            
        } else {
            $stmt = mysqli_prepare($db, "INSERT INTO entradas "
                    . "(id, usuario_id, categoria_id, titulo, "
                    . "descripcion, fecha) "
                    . "VALUES (null, ?, ?, ?, ?, CURDATE());");
            mysqli_stmt_bind_param($stmt, "ssss", $usuario, $categoria, $titulo, $descripcion);
        }
    } else {
            $_SESSION['errores_entradas'] = $errores;
        }
    //Execute consulting
    if(count($errores) == 0 && mysqli_stmt_execute($stmt)) {
            $_SESSION['completado'] = "El registro se ha completado con exito!";
            header('Location: index.php');
    } else {
            if(isset($_GET['editar'])) {
                header('Location: editartradas.php?id='.$_GET['editar']);
            } else {           
                $errores['save_data'] = 'Ha ocurrido un error. No se han podido guardar los datos';
                $_SESSION['error_entradas'] = $errores;
                header('Location: crearentradas.php');
            }
        } 
        
}
