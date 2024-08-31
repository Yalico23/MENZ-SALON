<div class="contenedor ">
    <div class="contenedor-login posicion">
        <div class="formulario-contenedor">
            <form action="/crear-login" method="post">
                <fieldset>
                    <legend>Crear Cuenta</legend>

                    <div class="campo">
                        <label for="Nombre">Nombre</label>
                        <input type="text" id="Nombre" name="Nombre" placeholder="Ingresar Nombre..." value="<?php echo $usuario->Nombre ?>">
                    </div>
                    <div class="campo">
                        <label for="Apellido">Apellido</label>
                        <input type="text" id="Apellido" name="Apellido" placeholder="Ingresar Apellido..." value="<?php echo $usuario->Apellido ?>">
                    </div>
                    <div class="campo">
                        <label for="Email">Email</label>
                        <input type="email" id="Email" name="Email" placeholder="Ingresar Email..." value="<?php echo $usuario->Email ?>">
                    </div>
                    <div class="campo">
                        <label for="Telefono">Telefono</label>
                        <input type="tel" id="Telefono" name="Telefono" placeholder="Ingresar Telefono..." value="<?php echo $usuario->Telefono ?>">
                    </div>
                    <div class="campo">
                        <label for="Password">Password</label>
                        <input type="password" id="Password" name="Password" placeholder="Ingresar Password...">
                    </div>
                    <input type="submit" value="Crear Cuenta" class="boton-web boton">

                    <div class="enlaces">
                        <a href="/login">¿Ya tienes cuenta? Iniciar Sesión</a>
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