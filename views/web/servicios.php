<main class="fondo-service">
    <picture>
        <source srcset="/build/img/png-servicio.webp" type="image/webp">
    <img  src="/build/img/png-servicio.png" alt="imagen">
    </picture>
    <h2>Nuestros Servicios</h2>
    <div><a href="/">Home</a> <span>/ Columna de Servicios</span></div>
</main>
<div class="contenedor">
    <div class="contenedor-servicios">
        <?php foreach ($servicios as $servicio) : ?>
            <?php if($servicio->Activo === '1'): ?>
            <div class="servicio-contenedor">
                <img src="/imagenes/<?php echo $servicio->Imagen ?>" alt="Imagen servicio">
                <div class="info-servicio">
                    <h3><?php echo $servicio->Nombre ?></h3>
                    <p><?php echo $servicio->Descripcion ?></p>
                    <div class="enlace">
                        <a href="" class="">Saber más</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>