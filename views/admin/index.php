<div class="contenedor posicion admin">
    <?php include_once __DIR__ . '/../templates/barra.php' ?>
    <h1>Buscar Cita</h1>

    <div class="busqueda">
        <form method="post">
            <div class="campo">
                <label for="Fecha">Fecha</label>
                <input type="date" name="Fecha" id="Fecha" value="<?php echo $fecha ?>">
            </div>
        </form>
        <button class="btn-buscar boton-web">Buscar</button>
    </div>

    <ul>

        <?php $processedIds = [] ?>

        <?php foreach ($citas as $key => $cita) : ?>

            <?php $Id = $cita->Id; ?>

            <?php if (!in_array($Id, $processedIds)) : ?>
                <?php $total = 0 ?>
                <li>

                    <p>Id : <span><?php echo $cita->Id ?></span></p>
                    <p>Hora : <span><?php echo $cita->Hora ?></span></p>
                    <p>Cliente : <span><?php echo $cita->cliente ?></span></p>
                    <p>Email : <span><?php echo $cita->Email ?></span></p>
                    <p>Telefono : <span><?php echo $cita->Telefono ?></span></p>

                    <?php $processedIds[] = $Id; ?>

                <?php endif; ?>

                <p>&rfisht; Servicio : <span><?php echo $cita->servicio ?>, S/.<?php echo $cita->Precio ?></span></p>
                <?php $total += $cita->Precio ?>

                <?php $proximo = $citas[$key + 1]->Id ?? 0 ?>

                <?php if ($proximo !== $cita->Id) : ?>
                    <p class="precio-total"> S/. <?php echo $total ?> </p>
                <?php endif; ?>

                

            <?php endforeach; ?>
            
    </ul>

    <?php if (empty($citas)) : ?>
        <h2>Hoy no tenemos ninguna Cita...</h2>
    <?php endif; ?>

</div>

<?php
$script = "
        <script src='/build/js/buscar.js'></script>
    ";
?>