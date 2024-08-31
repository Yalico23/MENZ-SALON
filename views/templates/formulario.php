<div class="campo">
            <label for="Nombre">Nombre</label>
            <input 
            type="text" 
            id="Nombre" 
            name="Nombre" 
            placeholder="Ingresar Nombre"
            value="<?php echo $servicio->Nombre ?>"
            >
        </div>
        <div class="campo">
            <label for="Precio">Precio</label>
            <input 
            type="number" 
            id="Precio" 
            step="any"
            name="Precio" 
            placeholder="Ingresar Precio"
            value="<?php echo $servicio->Precio ?>"
            >
        </div>
        <div class="campo">
            <label for="Descripcion">Descripcion</label>
            <textarea name="Descripcion" id="Descripcion"><?php echo $servicio->Descripcion ?></textarea>
        </div>
        <div class="campo">
            <label for="Imagen">Imagen</label>
            <input 
            type="file" 
            id="Imagen" 
            name="Imagen" 
            accept="image/jpeg, image/png , image/webp"
            >
            <?php if ($servicio->Imagen):?>
                <div class="img-form">
                    <img src="/imagenes/<?php echo $servicio->Imagen ?>" class="Imagen-pequeña" alt="Imagen-memoria">
                </div>
            <?php endif; ?>
        </div>