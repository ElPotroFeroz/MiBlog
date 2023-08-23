<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php 
    //Si el usuario intenta introducir en la url un id distinto lo redirije al index
    $entrada_actual = call_entrada($db, $_GET['id']); 
    if(!isset($entrada_actual['id'])) {
        header('Location: index.php');
    }
?>

<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!--Caja para editar la entrada-->
<div id="caja_principal">
    <h1>Editar entrada</h1>
    <p>
        Edita tu entrada en <strong><?=$entrada_actual['titulo']?></strong> el blog.
    </p>
    <br/>
    <form action="guardarentrada.php?editar=<?=$entrada_actual['id']?>" method="POST">
        <label for="titulo">Título entrada</label>
        <input type="text" name="titulo" value="<?=$entrada_actual['titulo']?>"/>
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'], 'titulo') : ''; ?>
        
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion"><?=$entrada_actual['descripcion']?></textarea>
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'], 'descripcion') : ''; ?>
    
        <label for="categoria">Categoría</label>
        <select name="categoria">
            <?php $categorias = call_categories($db);
                  if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)):
            ?>           
                        <option value="<?=$categoria['id']?>"
                        <?=($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected="selected"' : '' ?>>
                            <?=$categoria['nombre']?>
                        </option>            
            <?php
                    endwhile;
                  endif;
            ?>
        </select>
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'], 'categoria') : ''; ?>
       
        <!--If fail to save the data into database through error-->
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'], 'save_data') : ''; ?>
        <input type="submit" value="Guardar"/>
    </form>
    <?php borrarErrores(); ?>
</div>


<?php require_once 'includes/footer.php'; ?>  