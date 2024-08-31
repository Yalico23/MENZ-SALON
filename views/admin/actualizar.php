<div class="contenedor posicion admin">
    <h1>Actualizar Producto</h1>

    

    <form action="" method="post" enctype="multipart/form-data">
        <?php include_once __DIR__ . '/../templates/formulario.php' ?>
        <button type="submit" class="boton-web" onclick="servicioActualizado(event)">Actualizar Servicio</button>
    </form>

    <a href="/servicios" class="boton-web"> Regresar </a>

    <?php include_once __DIR__ . '/../templates/alertas.php' ?>
</div>

<?php 

    $script = "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script src='/build/js/sweetAlert.js'></script>
    ";

?>