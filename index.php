<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!--CAJA PRINCIPAL-->
<div id="caja_principal">
    <h1>Ultimas entradas</h1>
    <?php 
        $entradas = conseguir_entradas($db, true); 
        if(!empty($entradas)):
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
        endif;
    ?>
 
    <div id="vertodas">
        <a href="verentradas.php">Ver todas las entradas</a>
    </div>
            
<?php require_once 'includes/footer.php'; ?>  
   