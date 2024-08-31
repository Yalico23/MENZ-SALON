<div class="contenedor posicion cita">
    <h1>Reserva tu Cita en los proximos dias</h1>
    <p>Elije tu servicio a continuacion</p>

    <div class="app contenedor">
        <nav class="tabs">
            <button type="button" data-paso="1">Servicios</button>
            <button type="button" data-paso="2">Información de la Cita</button>
            <button type="button" data-paso="3">Resumen</button>
            <button type="button" data-paso="4">Mis Citas</button>
        </nav>

        <div id="paso-1" class="seccion">
            <h2>Servicios</h2>
            <p>Elije tus servicios a continuacion</p>
            <div id="servicios">
                <!--Aqui insertamos los servicios-->
            </div>
        </div>

        <div id="paso-2" class="seccion">
            <h2>Tus Datos y Cita</h2>
            <p>Coloca tus datos y Cita</p>
            <form method="post">
                <div class="campo">
                    <label for="Nombre">Nombre</label>
                    <input type="text" id="Nombre" placeholder="Nombre" value="<?php echo $Nombre ?>" disabled>
                </div>
                <?php
                date_default_timezone_set('America/Lima');
                ?>
                <div class="campo">
                    <label for="Fecha">Fecha</label>
                    <input type="date" id="Fecha" min="<?php echo date('Y-m-d', strtotime('+1 day')) ?>" max="<?php echo date('Y-m-d', strtotime('+30 day')) ?>">
                </div>

                <div class="campo">
                    <label for="Hora">Hora</label>
                    <input type="time" id="Hora">
                </div>

                <!-- <div class="campo">
                    <label for="Hora">Hora</label>
                    <select name="Hora" id="Hora">
                        <option value="" disabled selected>--Seleccionar--</option>
                        <option value="20:00">20:00</option>
                    </select>
                </div> -->

                <input type="hidden" id="Id" value="<?php echo $Id ?>">
                <div class="alertas"></div>
            </form>
        </div>
        <div id="paso-3" class="seccion">
            <div class="contenido-resumen"></div>
            <div class="servicio-resumen"></div>
            <div class="total-resumen"></div>
        </div>
        
        <div id="paso-4" class="seccion">
            <div class="contenido-usuario-cita">
            </div>
        </div>

        <div class="paginacion">
            <button id="boton-anterior" class="boton-web">&laquo; Anterior</button>
            <button id="boton-siguiente" class="boton-web">Siguiente &raquo;</button>
        </div>
    </div>

</div>

<?php
$script = "
<script src='build/js/apiCitas.js'></script>
<script src='build/js/cita.js'></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
";
?>