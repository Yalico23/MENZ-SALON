<div class="contenedor ">
    <div class="contenedor-login posicion">
        <div class="formulario-contenedor">
            <form action="/olvide" method="post">
                <fieldset>
                    <legend>Olvide Password</legend>
                    <p>Restablece tu password escribiendo tu email a continuació</p>
                    <div class="campo">
                        <label for="Email">Email</label>
                        <input type="email" id="Email" name="Email" placeholder="Ingresar Email..." >
                    </div>

                    <input type="submit" value="Cambiar Password" class="boton-web boton">

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