<div class="contenedor ">
    <div class="contenedor-login posicion">
        <div class="formulario-contenedor">
            <form method="POST">
                <fieldset>
                    <legend>Ingresar</legend>

                    <div class="campo">
                        <label for="Email">Email</label>
                        <input type="email" id="Email" name="Email" placeholder="Ingresar Email..." value="<?php echo $auth->Email ?>">
                    </div>
                    
                    <div class="campo">
                        <label for="Password">Password</label>
                        <input type="password" id="Password" name="Password" placeholder="Ingresar Password..." >
                    </div>

                    <input type="submit" value="Ingresar Para Reservar" class="boton-web boton" >

                    <div class="enlaces">
                        <a href="/crear-login">¿Aún no tienes cuenta? Crear una</a>
                        <a href="/olvide">¿Olvidaste tu contraseña?</a>
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
