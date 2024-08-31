<?php
if ($alertas != [] && isset($alertas['error'])) {
    echo '<h2>Upps Tenemos un problema...</h2>';
}

foreach ($alertas as $key => $mensajes) :
    foreach ($mensajes as  $mensaje) :
?>
    <div class="alerta <?php echo $key; ?>">
        <?php echo $mensaje ?>
    </div>
<?php
    endforeach;
endforeach;
?>