<?php

namespace Controllers;

use Model\Cita;
use Model\Servicios;
use Model\citaUsuarios;
use Model\CitaServicios;
use Clases\EmailComprobante;
use Model\Usuarios;

class ApiControllers
{

    public static function servicios()
    {
        $servicios = Servicios::all();
        echo json_encode($servicios);
    }

    public static function guardar()
    {
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $Id = $resultado['Id'];
        $IdServicios = explode(",", $_POST['Servicios']);

        foreach ($IdServicios as $IdServicio) {
            $args = [
                'CitasId' => $Id,
                'ServiciosId' => $IdServicio
            ];
            $citaServicio = new CitaServicios($args);
            $citaServicio->guardar();
        }

        echo json_encode(['resultado' => $resultado]);
    }

    public static function correo()
    {
        $email = $_SESSION['Email'];
        $mensaje = $_POST['Mensaje'] ?? '';
        $correo = new EmailComprobante($email, $mensaje);
        $correo->EnviarComprobante();

        $mensaje = ["resultado" => true];

        echo json_encode($mensaje);
    }

    public static function citas()
    {

        $correo = $_SESSION['Email'];

        $sql = "SELECT citas.Id, citas.Hora, CONCAT(usuarios.Nombre, ' ', usuarios.Apellido) as cliente, usuarios.Email, citas.Fecha, ";
        $sql .= "usuarios.Telefono, servicios.Nombre as servicio, servicios.Precio FROM citas LEFT OUTER JOIN usuarios ON ";
        $sql .= "citas.UsuarioId = usuarios.Id LEFT OUTER JOIN citasservicios ON citasservicios.CitasId = citas.Id LEFT OUTER ";
        $sql .= "JOIN servicios ON servicios.Id = citasservicios.ServiciosId WHERE usuarios.Email = '" . $correo . "'";


        $authCita = citaUsuarios::SQL($sql);

        echo json_encode($authCita);
    }

    public static function eliminarCita()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cita = Cita::find($_POST['Id']);
            $resultado = $cita->eliminar();
            echo json_encode(['resultado' => $resultado]);
        }
    }

    public static function loginApiGet()
    {

        $usuarios = Usuarios::all();
        echo json_encode($usuarios);
    }

    public static function loginApiPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Usuarios($_POST);
            $alertas = $auth->validarLogin();
            if (empty($alertas)) {
                $usuario = Usuarios::where('Email', $auth->Email);
                if ($usuario) {
                    //Verificar password
                    if ($usuario->checkPassword($auth->Password)) { //como es de manera dinamica no lo reconoce

                        if (session_status() === PHP_SESSION_NONE) {
                            session_start();
                        }

                        $_SESSION['Id'] = $usuario->Id;
                        $_SESSION['Nombre'] = $usuario->Nombre . " " . $usuario->Apellido;
                        $_SESSION['Email'] = $usuario->Email;
                        $_SESSION['login'] = true;

                        $respuesta = [
                            "estado" => true
                        ];

                        echo json_encode($respuesta);
                        exit;
                    }
                } else {
                    Usuarios::setAlerta('error', 'User not found');
                }
            }
            $alertas = Usuarios::getAlertas();

            $respuesta = [
                "alertas" => $alertas,
                "estado" => false
            ];
            echo json_encode($respuesta);
        }
    }
}
