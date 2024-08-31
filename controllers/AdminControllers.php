<?php 
namespace Controllers;

use GuzzleHttp\Psr7\Header;
use MVC\Router;
use Model\Admin;
use Model\Cita;
use Model\Servicios;
use Intervention\Image\ImageManagerStatic as Image;

class AdminControllers {

    public static function index (Router $router){
        is_Admin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-',$fecha);

        if (!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header("Location: /404");
        }

        $consulta = "SELECT citas.Id, citas.Hora, CONCAT( usuarios.Nombre, ' ', usuarios.Apellido) as cliente, ";
        $consulta .= " usuarios.Email, usuarios.Telefono, servicios.Nombre as servicio, servicios.Precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.UsuarioId=usuarios.Id  ";
        $consulta .= " LEFT OUTER JOIN citasservicios ";
        $consulta .= " ON citasservicios.CitasId=citas.Id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.Id=citasservicios.ServiciosId ";
        $consulta .= " WHERE Fecha =  '$fecha' ";

        $citas = Admin::SQL($consulta);

        $router->render('admin/index',[
            "citas" => $citas,
            "fecha" => $fecha
        ]);
    }
    
    public static function servicios (Router $router){
        is_Admin();
        $servicios = Servicios::all();
        $msj = $_GET['msj'] ?? null;
        Servicios::setAlerta('error',$msj);
        $alertas = Servicios::getAlertas();
        
        $router->render('admin/servicios',[
            "servicios" => $servicios,
            "alertas" => $alertas
        ]);
    }
    
    public static function crear (Router $router){
        is_Admin();
        $servicio=new Servicios();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio = new Servicios($_POST);
            $nombreImagen = md5(uniqid(rand(),true)) . '.jpg';
            
            if($_FILES['Imagen']['tmp_name']){
                $Imagen = Image::make($_FILES['Imagen']['tmp_name'])->fit(800,600);
                $servicio->SetFiles($nombreImagen);
            }
            $alertas = $servicio->validar();
            if(empty($alertas)){
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                $Imagen->save(CARPETA_IMAGENES . $nombreImagen);
                $servicio->activo();
                $servicio->guardar();
                header("Location: /servicios");
            }
        }

        $router->render('admin/crear',[
            'alertas' => $alertas,
            'servicio' => $servicio
        ]);
    }

    public static function actualizar (Router $router) {
        is_Admin();
        $Id = $_GET['Id'];

        if (!is_numeric($_GET['Id'])) return;
        $servicio = Servicios::find($Id);

        if ($servicio === null) {
            header("Location: /servicios");
        }

        $servicio=Servicios::find($Id);
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $servicio->sincronizar($_POST);
            $servicio->activo();

            $nombreImagen = md5(uniqid(rand(),true)) . '.jpg';
            
            if($_FILES['Imagen']['tmp_name']){
                $Imagen = Image::make($_FILES['Imagen']['tmp_name'])->fit(800,600);
                $servicio->SetFiles($nombreImagen);
            }
            $alertas = $servicio->validar();
            if (empty($alertas)) {
                if (isset($Imagen)) {
                    $Imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $servicio->guardar();
                header("Location: /servicios");
            }
        }
        
        $router->render('admin/actualizar',[
            "servicio" => $servicio,
            "alertas" => $alertas
        ]);
    }

    public static function eliminar(){
        is_Admin();
        $Id = $_POST['Id'];
        $servicio=Servicios::find($Id);

        $query = "DELETE FROM servicios
          WHERE Id = '$Id'
          AND NOT EXISTS (
              SELECT 1
              FROM citasservicios
              WHERE ServiciosId = '$Id'
          )";
        $resultado = $servicio->SQLEliminar($query);
        
        if (!$resultado) {
            Header("Location: /servicios?msj=No Eliminado existen citas con este servicio");
        }else{
            Header("Location: /servicios");
        }
    }

    public static function desabilitar(){
        is_Admin();
        $Id = $_POST['Id'];
        $servicio=Servicios::find($Id);
        $servicio->desactivar();
        $resultado = $servicio->guardar();
        if ($resultado) {
            header("Location: /servicios");
        }
    }
    
    public static function habilitar(){
        is_Admin();
        $Id = $_POST['Id'];
        $servicio=Servicios::find($Id);
        $servicio->activo();
        $resultado = $servicio->guardar();
        if ($resultado) {
            header("Location: /servicios");
        }
    }
}
?>