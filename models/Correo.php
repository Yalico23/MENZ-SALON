<?php

namespace Model;

class Correo extends ActiveRecord
{ 

    public $Nombre;
    public $Apellidos;
    public $Telefono;
    public $Correo;
    public $Mensaje;

    public function __construct($args = [])
    {
        $this->Nombre = $args['Nombre'] ?? '';
        $this->Apellidos = $args['Apellidos'] ?? '';
        $this->Telefono = $args['Telefono'] ?? '';
        $this->Correo = $args['Correo'] ?? '';
        $this->Mensaje = $args['Mensaje'] ?? '';
    }

    public function validar(){
        !$this->Nombre ? self::$alertas['error'][] = 'Nombre es requerido' : '';
        !$this->Apellidos ? self::$alertas['error'][] = 'Apellidos es requerido' : '';
        !$this->Telefono ? self::$alertas['error'][] = 'Telefono es requerido' : '';
        !$this->Correo ? self::$alertas['error'][] = 'Correo es requerido' : '';
        !$this->Mensaje ? self::$alertas['error'][] = 'Mensaje es requerido' : '';

        return self::$alertas;
    }
}
