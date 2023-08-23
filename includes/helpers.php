<?php

function mostrarError($errores, $campo) {
    $alert = '';
    if(isset($errores[$campo]) && !empty($campo)) {
        $alert = "<div class='alert alert-error'>".$errores[$campo].'</div>';
    }
    return $alert;
}

function borrarErrores() {
    $borrado = false;
    if(isset($_SESSION['errores'])) {
    $_SESSION['errores'] = null;
    $borrado = true;
    }
    
    if(isset($_SESSION['completado'])) {
    $_SESSION['completado'] = null;
    $borrado = true;
    }
    
    if(isset($_SESSION['errores_entradas'])) {
    $_SESSION['errores_entradas'] = null;
    $borrado = true;
    }
       
    return $borrado;
}

function call_categories($conexion) {
    $query = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($conexion, $query);
    
    $result = array();
    if($categorias && mysqli_num_rows($categorias)>= 1) {
        $result = $categorias;
    }
    return $result;
}

function call_category($conexion, $id) {
    $query = "SELECT * FROM categorias WHERE id = $id";
    $categorias = mysqli_query($conexion, $query);
    
    $result = array();
    if($categorias && mysqli_num_rows($categorias)>= 1) {
        $result = mysqli_fetch_assoc($categorias);
    }
    return $result;
}

function call_entrada($conexion, $id) {
    $query = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos)"
            . "AS 'usuario' FROM entradas e "
            . "INNER JOIN categorias c ON e.categoria_id = c.id "
            . "INNER JOIN usuarios u ON e.usuario_id = u.id "
            . "WHERE e.id = $id";
    $entrada = mysqli_query($conexion, $query);
    
    $result = array();
    if($entrada && mysqli_num_rows($entrada)>= 1) {
        $result = mysqli_fetch_assoc($entrada);
    }
    return $result;
}

function conseguir_entradas($conexion, $limit = null, $categoria = null, $buscar = null) {
    $query = "SELECT e.*,  c.nombre AS 'categoria' FROM entradas e ".
            "INNER JOIN categorias c ON e.categoria_id = c.id ";
    //Primero va el WHERE
    if(!empty($categoria)) {
        $query .= "WHERE e.categoria_id = $categoria ";
    }
    if(!empty($buscar) && empty($categoria)) {
        $query .= "WHERE e.titulo LIKE '%$buscar%' ";
    }
    //Después el ORDER BY
    $query .= "ORDER BY e.id DESC ";
    //Finalmente el LIMIT
    if ($limit) {
        $query .= "LIMIT 4";
    }
    $entradas = mysqli_query($conexion, $query);
    $result = array();
    if ($entradas && mysqli_num_rows($entradas)>=1) {
        $result = $entradas;
    }
    return $result;
}