<?php 
namespace Controllers;

use MVC\Router;

class CitaControllers{

    public static function index(Router $router){
        is_Auth();

        $Id = $_SESSION['Id'];
        $Nombre = $_SESSION['Nombre'];

        
        $router->render("cita/index",[
            "Id" => $Id,
            "Nombre" => $Nombre
        ]);
    }
}
?>