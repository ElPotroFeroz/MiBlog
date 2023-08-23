<?php require_once 'includes/redireccion.php'; ?>  
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<div id="caja_principal">
    <h1>Crear entrada</h1>
    <p>
        Añade nuevas entradas al blog.
    </p>
    <br/>
    <form action="guardarentrada.php" method="POST">
        <label for="titulo">Título entrada</label>
        <input type="text" name="titulo"/>
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'], 'titulo') : ''; ?>
        
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion"/></textarea>
        <?php echo isset($_SESSION['errores_entradas']) ? mostrarError($_SESSION['errores_entradas'], 'descripcion') : ''; ?>
    
        <label for="categoria">Categoría</label>
        <select name="categoria">
            <?php $categorias = call_categories($db);
                  if(!empty($categorias)):
                    while($categoria = mysqli_fetch_assoc($categorias)):
            ?>           
                        <option value="<?=$categoria['id']?>">
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

