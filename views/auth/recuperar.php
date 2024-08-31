<div class="contenedor ">
    <div class="contenedor-login posicion">
        <div class="formulario-contenedor">
            <form  method="post">
                <fieldset>
                    <legend>Recuperar Password</legend>
                    <p>Coloca tu nuevo password a continuación</p>

                    <?php if (!$error) : ?>

                        <div class="campo">
                            <label for="Password">Password</label>
                            <input type="Password" autofocus id="Password" placeholder="Your New Password" name="Password" autocomplete="off">
                        </div>

                        <input type="submit" value="Cambiar Password" class="boton-web boton">

                    <?php endif; ?>

                    <div class="enlaces">
                        <a href="/login">¿Ya tienes cuenta? Iniciar Sesión</a>
                        <a href="/crear-login">¿Aún no tienes cuenta? Crear una</a>
                    </div>
                </fieldset>
            </form>
        </div>

        <div class="bg-login">
            <div class="div-login">
                <?php
                include_once __DIR__ . '/../templates/alertas.php';
                ?>
            </div>
        </div>
    </div>
</div>