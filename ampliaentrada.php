<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php $entrada_actual = call_entrada($db, $_GET['id']); 
    if(!isset($entrada_actual['id'])) {
        header('Location: index.php');
    }
?>

<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!--CAJA PRINCIPAL-->
<div id="caja_principal">
    
    <h1><?=$entrada_actual['titulo']?></h1>
    <a href="vercategoria.php?id=<?=$entrada_actual['categoria_id']?>">
    <h2><?=$entrada_actual['categoria']?></h2>
    </a>
    <h3><?=$entrada_actual['fecha']?> | <?=$entrada_actual['usuario']?></h3>
    <p>
        <?=$entrada_actual['descripcion']?>
    </p>
    
    <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']): ?>
        <a href="editarentrada.php?id=<?=$entrada_actual['id']?>" class="button button-green">Editar entradas</a>
        <a href="borrarentrada.php?id=<?=$entrada_actual['id']?>" class="button button-green">Borrar entrada</a>
    <?php endif; ?>
                               
<?php require_once 'includes/footer.php'; ?>  
