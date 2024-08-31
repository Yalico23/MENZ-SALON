<?php 
namespace Model;

class citaUsuarios extends ActiveRecord{
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['Id','Hora','cliente','Email','Telefono','servicio','Precio', 'Fecha'];

    public $Id;
    public $Hora;
    public $cliente;
    public $Email;
    public $Telefono;
    public $servicio;
    public $Precio;
    public $Fecha;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? null;
        $this->Hora = $args['Hora'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->Email = $args['Email'] ?? '';
        $this->Telefono = $args['Telefono'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->Precio = $args['Precio'] ?? '';
        $this->Fecha = $args['Fecha'] ?? '';
    }
}
?>