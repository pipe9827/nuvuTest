


        
        <script src="js/sweetalert2.all.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
            <?php
                $actual = obtenerPaginaActual();
                if($actual === 'crear-cuenta' || $actual === 'login'){
                    echo '<script src="js/formulario.js"></script>';
                }else{
                    echo  '<script src="js/scripts.js"></script>';
                }
            ?>
    </body>
</html>