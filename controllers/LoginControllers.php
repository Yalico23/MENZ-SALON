<?php 
namespace Controllers;


use MVC\Router;
use Clases\Email;
use Model\Usuarios;

class LoginControllers {
    
    public static function login (Router $router){
        redireccionar();
        $auth = new Usuarios();
        $alertas=[];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuarios($_POST);
            $alertas = $auth->validarLogin();
            if(empty($alertas)){
                $usuario = Usuarios::where('Email', $auth->Email);
                if ($usuario) {
                    //Verificar password
                    if ($usuario->checkPassword($auth->Password)) { //como es de manera dinamica no lo reconoce
                        session_start();
                        $_SESSION['Id'] = $usuario->Id;
                        $_SESSION['Nombre'] = $usuario->Nombre . " " . $usuario->Apellido;
                        $_SESSION['Email'] = $usuario->Email;
                        $_SESSION['login'] = true;

                        //Redireccionamiento
                        if ($usuario->Admin === '1') {
                            $_SESSION['Admin'] = $usuario->Admin ?? null;
                            header("Location: /admin");
                        } else {
                            header("Location: /cita");
                        }
                    }
                } else {
                    Usuarios::setAlerta('error', 'User not found');
                }
            }
        }
        $alertas=Usuarios::getAlertas();
        $router->render("auth/login",[
            "auth"=>$auth,
            "alertas"=>$alertas
        ]);
    } 

    public static function logout (){
        $_SESSION = [];
        header("Location: /");
    }

    public static function crear (Router $router){
        redireccionar();
        $usuario = new Usuarios();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuarios($_POST);
            $usuario->sincronizar($_POST);
            $alertas= $usuario->validar();

            if (empty($alertas)) {
                $resultado = $usuario->existeUsuario();
                if ($resultado->num_rows) {
                    $alertas = Usuarios::getAlertas(); //obtnego las alertas que estan en memoria despues de la validacion
                } else {
                    //Hashear el password
                    $usuario->hashPassword(); //60 caracteres
                    //Generar token unico
                    $usuario->CrearToken(); //13 caracteres
                    //Enviar Email
                    $email  = new Email($usuario->Email, $usuario->Nombre, $usuario->Token);
                    $email->EnviarConfirmacion();

                    //Crear usuario
                    $resultado = $usuario->guardar();
                    if ($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render("auth/crear",[
            "usuario"=>$usuario,
            "alertas"=>$alertas
        ]);
    } 

    public static function mensaje(Router $router){
        
        Usuarios::setAlerta("exito","Token Valido");
        $alertas = Usuarios::getAlertas();  
        //debuguear($alertas);
        $router->render("auth/mensaje",[
            "alertas"=>$alertas
        ]);
    }

    public static function confirmar(Router $router){

        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuarios::where('Token', $token);
        if (empty($usuario) || $usuario->Token === '') {
            Usuarios::setAlerta('error', 'Token no valido o expiro el tiempo');
        } else {
            $usuario->Confirmado = "1";
            $usuario->Token = null;
            date_default_timezone_set('America/Lima');
            $usuario->Creado = date('Y/m/d H:i:s');
            $usuario->guardar(); //aui actualiza el registro por el metodo guardar del activerecord
            Usuarios::setAlerta('exito', 'Token valido');
        }

        $alertas = Usuarios::getAlertas();
        $router->render("auth/confirmar",[
            "alertas"=>$alertas
        ]);
    }

    public static function olvide(Router $router){

        $alertas = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuarios($_POST);
            $alertas = $auth->validarEmail();
            if (empty($alertas)) {
                $usuario = Usuarios::where('Email', $auth->Email);
                if ($usuario && $usuario->Confirmado === '1') {
                    //Generar Token
                    $usuario->CrearToken();
                    $usuario->guardar();//usamos el update
                    // Enviar Email
                    $email = new Email($usuario->Email,$usuario->Nombre,$usuario->Token);
                    $email->enviarInstrucciones();
                    //Alerta de Exito
                    Usuarios::setAlerta('exito','Todo se ve Bien!! Revisa tu Email o Spam');
                }else{
                    Usuarios::setAlerta('error','User not found or not confirmed');
                }
            }
        }
        $alertas = Usuarios::getAlertas();
        $router->render("auth/olvide",[
            "alertas"=>$alertas
        ]);
    }

    public static function recuperar(Router $router){
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);
        $usuario = Usuarios::where('Token', $token);
        if (empty($usuario) || $usuario->Token === '') {
            Usuarios::setAlerta('error', 'Token no valido o expiro el tiempo');
            $error = true;
        } 
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = new Usuarios($_POST);
            $alertas=$password->validarPassword();
            if (empty($alertas)) {
                $usuario->Token = null;
                $usuario->Password=null;
                $usuario->Password=$password->Password;
                $usuario->hashPassword();
                $resultado=$usuario->guardar();//update
                if ($resultado) {
                    header("Location: /login");
                }
            }
        }

        $alertas = Usuarios::getAlertas();
        $router->render("auth/recuperar", [
            "alertas"=>$alertas,
            "error"=>$error
        ]);
    }
}
?>