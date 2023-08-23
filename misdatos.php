<?php require_once 'includes/redireccion.php'; ?>  
<?php require_once 'includes/header.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!--CAJA PRINCIPAL-->
<div id="caja_principal">
    <h1>Mis datos</h1>
    <?php echo isset($_SESSION['completado']) ? $_SESSION['completado'] : ''; ?>
    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'general') : ''; ?>
     <form action="actualizarusuario.php" method="POST">
        <label for="nombre">Name</label>
        <input type="text" name="nombre" value="<?=$_SESSION['usuario']['nombre']?>"/>           
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

        <br/>
        <label for="apellidos">Surnames</label>
        <input type="text" name="apellidos" value="<?=$_SESSION['usuario']['apellidos']?>"/>          
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

        <br/>
        <label for="email">Email</label>
        <input type="email" name="email" value="<?=$_SESSION['usuario']['email']?>"/>            
        <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>
        
        <br/>
        <br/>
        <input type="submit" name="submit" value="Actualizar" />               
    </form>
    <?php borrarErrores(); ?>

 </div>            
<?php require_once 'includes/footer.php'; ?>  
   