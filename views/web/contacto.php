<main class="fondo-service">
    <picture>
        <source srcset="/build/img/png-servicio.webp" type="image/webp">
    <img  src="/build/img/png-servicio.png" alt="imagen">
    </picture>
    <h2>Contactanos</h2>
    <div><a href="/">Home</a> <span>/ Formas de contacto</span></div>
</main>
<div class="contenedor map">
    <picture>
        <source loading="lazy" srcset="/build/img/title-img-2.webp" type="image/webp">
        <img loading="lazy" src="/build/img/title-img-1.png" alt="">
    </picture>
    <h2>Encuentra nuestra sede</h2>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18564.860971662612!2d-77.01688734384685!3d-11.989632104492848!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c5656c15520b%3A0xa24c2369c7c1295b!2sUniversidad%20C%C3%A9sar%20Vallejo!5e0!3m2!1ses-419!2spe!4v1707245789868!5m2!1ses-419!2spe" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<div class="contenedor contenedor-contacto">
    <h2>Contactanos</h2>
    <div class="contacto">
        <picture>
            <source srcset="/build/img/scissor.webp" type="image/webp">
        <img  src="/build/img/scissor.png" alt="img">
        </picture>
        <div >
            <div class="campo">
                <label for="Nombre">Nombre</label>
                <input type="text" id="Nombre" placeholder="Ingresar Nombre">
            </div>
            <div class="campo">
                <label for="Apellidos">Apellidos</label>
                <input type="text" id="Apellidos" placeholder="Ingresar Apellidos">
            </div>
            <div class="campo">
                <label for="Telefono">Telefono</label>
                <input type="tel" id="Telefono" placeholder="Ingresar Telefono">
            </div>
            <div class="campo">
                <label for="Correo">Correo</label>
                <input type="email" id="Correo" placeholder="Ingresar Correo">
            </div>
            <div class="campo">
                <label for="Mensaje">Mensaje</label>
                <textarea id="Mensaje"></textarea>
            </div>
            <button id="btn-mandar" class="boton-web">Mandar Mensaje</button>
        </div>
    </div>
</div>

<?php 
$script = "
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script src='/build/js/correo.js'></script>
";
?>