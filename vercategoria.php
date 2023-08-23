<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php $categoria_actual = call_category($db, $_GET['id']); 
    if(!isset($categoria_actual['id'])) {
        header('Location: index.php');
    }
?>

<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!--CAJA PRINCIPAL-->
<div id="caja_principal">
    
    <h1>Categoría <?=$categoria_actual['nombre']?></h1>
    <?php 
        $entradas = conseguir_entradas($db, null, $_GET['id']); 
        if(!empty($entradas) && mysqli_num_rows($entradas) >= 1):
            while($entrada = mysqli_fetch_assoc($entradas)):
    ?>
    
                <article class="entrada">
                    <a href="ampliaentrada.php?id=<?=$entrada['id']?>">
                        <h2><?=$entrada['titulo']?></h2>
                        <span class="fecha">Categoría: <?=$entrada['categoria'].' | '.$entrada['fecha']?></span>                      
                        <p>
                            <?=substr($entrada['descripcion'], 0, 180)."..."?>
                        </p>
                    </a>
    
    <?php 
        endwhile;
        else:
    ?>
                    <div class="alert">No hay entradas en esta categoría</div>
       <?php endif; ?>
                               
<?php require_once 'includes/footer.php'; ?>  
