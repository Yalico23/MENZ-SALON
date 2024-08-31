<?php

namespace Controllers;

use Clases\Email;
use Clases\EmailCorreo;
use Model\Correo;
use Model\Servicios;
use MVC\Router;

class InicioControllers
{

    public static function index(Router $router)
    {

        $router->render("web/index", []);
    }

    public static function servicios(Router $router)
    {

        $servicios = Servicios::all();

        $router->render("web/servicios", [
            "servicios" => $servicios
        ]);
    }

    public static function blog(Router $router)
    {

        $router->render("web/blog", []);
    }



    public static function contacto(Router $router)
    {
        $router->render("web/contacto");
    }

    public static function mandar()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = new Correo($_POST);
            $alertas = $correo->validar();

            if (empty($alertas)) {
                $email = new EmailCorreo($correo->Nombre, $correo->Apellidos, $correo->Telefono,  $correo->Correo, $correo->Mensaje);
                $email->Correo();
                $resultado = ['resultado' => '1'];
            }else{
                $resultado = ['resultado' => '0',
                            'errores' => $alertas];
            }
            echo json_encode($resultado);
        }
    }
}
