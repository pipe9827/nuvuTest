    <?php 
        include 'includes/funciones/funciones.php';
        include 'includes/templates/header.php'; 

        session_start();
        if(isset($_GET['cerrar_sesion'])){
            $_SESSION = array();
            setcookie("token","",time()-1,'/');
        }
        
    ?>
    <div class="contenedor-formulario">
        <h1>NUVU</h1>
        <form id="formulario" class="caja-login js-caja-login" method="post">
            <div class="campo">
                <label for="usuario">Usuario: </label>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario" required>
            </div>
            <div class="campo">
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="campo enviar">
                <input type="hidden" id="tipo" name="tipo" value="login" required>
                <input type="submit" class="boton" value="Iniciar Sesión">
            </div>

            <div class="campo">
                <a href="crear-cuenta.php">Crea una cuenta nueva</a>
            </div>
        </form>
    </div>

    >

    <?php
        include 'includes/templates/footer.php';
    ?>