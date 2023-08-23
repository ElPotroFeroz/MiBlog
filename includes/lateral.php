 <!--BARRA LATERAL-->
 
<aside id="sidebar">
    <!--User logged-->
    
    <?php if(isset($_SESSION['usuario'])): ?>
        <div id="usuario-logueado" class="block_aside">
            <h3><?=$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'];?>
        <br/>
        <!--Buscador-->
        <div id="Buscador" class="block_aside">
            <h3>Buscar</h3>  
            <form action="buscar.php" method="POST">               
                <input type="text" name="busqueda" /> 
                <input type="submit" value="Buscar" />
            </form>
        </div>
        <!--Buttons-->
        <a href="crearentradas.php" class="button button-green">Crear entradas</a>
        <a href="crearcategorias.php" class="button button-green">Crear categorias</a>
        <a href="misdatos.php" class="button button-orange">Mis datos</a>
        <a href="cerrarsesion.php" class="button">LogOut</a>
        </div>
    <?php endif; ?>
    
    <!--Login-->
    <?php if(!isset($_SESSION['usuario'])): ?>
        <div id="login" class="block_aside">
            <h3>Identifícate</h3>
         <!--Error login-->   
        <?php if(isset($_SESSION['error_login'])): ?>
            <div class="alert alert-error">
                <h3><?=$_SESSION['error_login'];?>
            </div>
        <?php endif; ?>    

            <form action="login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" />
                <br/>
                <label for="password">Password</label>
                <input type="password" name="password" />
                <br/>
                <input type="submit" value="Entrar" />               
            </form>
        </div>
        <div id="register" class="block_aside">
            <h3>Regístrate</h3>

            <!--MOSTRAR SI SE HA REALIZADO CON EXITO-->
            <?php if (isset($_SESSION['completado'])): ?>
                <div  class="alert alert-exito">
                    <?=$_SESSION['completado'] ?>
                </div>
            <!--MOSTRAR SI HA FALLADO EL REGISTRO DE USUARIO-->
            <?php elseif(isset($_SESSION['errores']['general'])): ?>
                <div  class="alert alert-error">
                    <?=$_SESSION['errores']['general'] ?>
                </div>
            <?php endif; ?>

            <!--Registration-->
            <form action="register.php" method="POST">
                <label for="nombre">Name</label>
                <input type="text" name="nombre" />           
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

                <br/>
                <label for="apellidos">Surnames</label>
                <input type="text" name="apellidos" />          
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

                <br/>
                <label for="email">Email</label>
                <input type="email" name="email" />            
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

                <br/>
                <label for="password">Password</label>
                <input type="password" name="password" />           
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

                <br/>
                <input type="submit" name="submit" value="Registrarse" />               
            </form>
            <?php borrarErrores(); ?>
        </div>
    <?php endif; ?>
</aside>