<?php 
namespace Model;

class Servicios extends ActiveRecord{
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['Id','Nombre','Precio', 'Imagen', 'Descripcion', 'Activo'];

    public $Id;
    public $Nombre;
    public $Precio;
    public $Imagen;
    public $Descripcion;
    public $Activo;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Nombre = $args['Nombre'] ?? '';
        $this->Precio = $args['Precio'] ?? '';
        $this->Imagen = $args['Imagen'] ?? '';
        $this->Descripcion = $args['Descripcion'] ?? '';
        $this->Activo = $args['Activo'] ?? '0';
    }

    public function validar(){

        !$this->Nombre ? self::$alertas['error'][] = 'Nombre es obligatorio' : '';
        !$this->Precio ? self::$alertas['error'][] = 'Precio es obligatorio' : '';
        !$this->Imagen ? self::$alertas['error'][] = 'Imagen es obligatorio' : '';
        !$this->Descripcion ? self::$alertas['error'][] = 'Descripcion es obligatorio' : '';

        return self::$alertas;
    }

    public function activo(){
        $this->Activo = '1';
    }
    
    public function desactivar(){
        $this->Activo = '0';
    }
}
?>