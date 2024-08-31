<div class="contenedor posicion admin">
    <?php include_once __DIR__ . '/../templates/barra.php' ?>
    <h1>Servicios</h1>

    <?php if(!is_null($alertas['error'][0])): ?>
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($servicios as $servicio): ?>
                <tr>
                <td><?php echo $servicio->Id ?></td>
                <td><?php echo $servicio->Nombre ?></td>
                <td><?php echo $servicio->Precio ?></td>
                <td><img src="/imagenes/<?php echo $servicio->Imagen ?>" alt="Imagen Servicio" class="Imagen-pequeña"></td>
                <td>
                    <a class="boton-azul" href="/actualizar-servicio?Id=<?php echo $servicio->Id ?>">Actualizar</a>
                    <?php if($servicio->Activo === '0'): ?>
                        <form action="/servicio-habilitar" method="post" id="modo-<?php echo $servicio->Id; ?>">
                        <input type="hidden" name="Id" value="<?php echo $servicio->Id?>">
                        <button class="btn-habilitar" type="submit" id="Eliminar" onclick="desabilitar(event, 'modo-<?php echo $servicio->Id; ?>')">Activar</button>
                    </form>
                    <?php else: ?>
                        <form action="/servicio-desabilitar" method="post" id="modo-<?php echo $servicio->Id; ?>">
                        <input type="hidden" name="Id" value="<?php echo $servicio->Id?>">
                        <button class="btn-deshabilitar" type="submit" id="Eliminar" onclick="habilitar(event, 'modo-<?php echo $servicio->Id; ?>')">Desabilitar</button>
                    </form>
                    <?php endif; ?>
                    <form action="/servicio-eliminar" method="post" id="formEliminarServicio-<?php echo $servicio->Id; ?>">
                        <input type="hidden" name="Id" value="<?php echo $servicio->Id?>">
                        <button class="btn-eliminar" type="submit" id="Eliminar" onclick="eliminar(event, 'formEliminarServicio-<?php echo $servicio->Id; ?>')">Eliminar</button>
                    </form>
                </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>


<?php 

    $script = "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script src='/build/js/sweetAlert.js'></script>
    ";

?>