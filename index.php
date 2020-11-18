    <?php 
        error_reporting(E_ALL ^ E_NOTICE);
        include 'includes/funciones/sesiones.php';
        include 'includes/funciones/funciones.php';
        include 'includes/templates/header.php'; 
        include 'includes/templates/barra.php';

        //obtener el id 
        if(isset($_GET['id_proyecto'])) {
            $proyecto = obtenerNombreProyecto($_GET['id_proyecto']);
        }
    ?>



<div class="contenedor">
    <main>
        <div class="contenido-principal">
            <div class="busqueda">
                <label for="busqueda">Cliente: </label>
                <input type="search" name="marca" id="busqueda" placeholder="Cedula a buscar " required>
                <input type="submit" class="boton js-caja-busqueda" value="Buscar">
            </div>
            <form id="formularioCliente" class="caja-registro " method="post">
                    
                <div class="lado1">
                    <h2>Cliente</h2>
                    <div class="campo">
                        <label for="cedula">Cedula: </label>
                        <input type="text" name="cedula" id="cedula" placeholder="cedula" required>
                    </div>
                    <div class="campo">
                        <label for="nombre">Nombre: </label>
                        <input type="text" name="nombre" id="nombre" placeholder="nombre" required>
                    </div>
                    <div class="campo">
                        <label for="apellidos">Apellidos: </label>
                        <input type="text" name="apellidos" id="apellidos" placeholder="apellidos" required>
                    </div>
                    <div class="campo">
                        <label for="celular">Celular: </label>
                        <input type="tel" name="celular" id="celular" placeholder="celular" required>
                    </div>
                    <div class="campo">
                        <label for="correo">Correo: </label>
                        <input type="email" name="correo" id="correo" placeholder="correo" required>
                    </div>
                </div>
                <div class="lado2">
                    <h2>Tarjeta</h2>
                    <div class="campo">
                        <label for="marca">Marca: </label>
                        <input type="text" name="marca" id="marca" placeholder="marca" required>
                    </div>
                    <div class="campo">
                        <label for="numero">Numero: </label>
                        <input type="text" name="numero" id="numero" placeholder="numero" required>
                    </div>
                    <div class="campo">
                        <label for="fecha">Fecha de expiración: </label>
                        <input type="date" name="fecha" id="fecha" placeholder="fecha" required>
                    </div>
                    <div class="campo">
                        <label for="codigo">CVV: </label>
                        <input type="text" name="codigo" id="codigo" placeholder="codigo" required>
                    </div>
                </div>
                <div class="campo campo-enviar">
                    <input type="submit" class="boton js-caja-cliente" value="Registrar">
                    <input type="submit" class="boton js-caja-actualizar" value="Actualizar">
                </div>
                
            </form>
            
        </div>
        
    </main>
</div><!--.contenedor-->



<?php
    include 'includes/templates/footer.php';
?>