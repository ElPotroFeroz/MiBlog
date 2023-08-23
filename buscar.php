<?php
   if(!isset($_POST['busqueda'])) {      
       header('Location: index.php');
   }
?>

<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!--CAJA PRINCIPAL-->
<div id="caja_principal">
    
    <h1>Busqueda: <?=$_POST['busqueda']?></h1>
    <?php 
        $busca = conseguir_entradas($db, null, null, $_POST['busqueda']); 
        if(!empty($busca) && mysqli_num_rows($busca) >= 1):
            while($entrada = mysqli_fetch_assoc($busca)):
    ?>
    
                <article class="entrada">
                    <a href="ampliaentrada.php?id=<?=$entrada['id']?>">
                        <h2><?=$entrada['titulo']?></h2>
                        <span class="fecha">Categoría: <?=$entrada['categoria'].' | '.$entrada['fecha']?></span>                      
                        <p>
                            <?=substr($entrada['descripcion'], 0, 180)."..."?>
                        </p>
                    </a>
                </article>
    <?php 
        endwhile;
        else:
    ?>
                    <div class="alert">No hay entradas en esta categoría</div>
       <?php endif; ?>
                               
<?php require_once 'includes/footer.php'; ?>  
