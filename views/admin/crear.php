<div class="contenedor posicion admin">
    <?php include_once __DIR__ . '/../templates/barra.php' ?>
    <h1>Crear Servicio</h1>

    <form  method="post" enctype="multipart/form-data" id="crear">
        <?php include_once __DIR__ . '/../templates/formulario.php' ?>
        <button type="submit" class="boton-web" onclick="servicioCreado(event)">Crear Servicio</button>
    </form>

    <?php include_once __DIR__ . '/../templates/alertas.php' ?>

</div>

<?php 

    $script = "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script src='/build/js/sweetAlert.js'></script>
    ";

?>