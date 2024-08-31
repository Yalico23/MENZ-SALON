<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminControllers;
use Controllers\ApiControllers;
use Controllers\CitaControllers;
use MVC\Router;
use Controllers\InicioControllers;
use Controllers\LoginControllers;

$router = new Router();

//Public    
$router->get("/", [InicioControllers::class , "index"]); //pagina principal
$router->get("/services", [InicioControllers::class , "servicios"]); //pagina servicios
$router->get("/blog", [InicioControllers::class , "blog"]); //pagina blog

$router->get("/contacto", [InicioControllers::class , "contacto"]); //pagina contacto
$router->post("/api/contacto", [InicioControllers::class , "mandar"]); //pagina contacto

//Login
$router->get("/login", [LoginControllers::class, "login"]);
$router->post("/login", [LoginControllers::class, "login"]);

$router->get("/logout", [LoginControllers::class, "logout"]);

$router->get("/crear-login", [LoginControllers::class, "crear"]);
$router->post("/crear-login", [LoginControllers::class, "crear"]);

$router->get("/mensaje", [LoginControllers::class, "mensaje"]);

$router->get("/confirmar-cuenta", [LoginControllers::class, "confirmar"]);

$router->get("/olvide", [LoginControllers::class, "olvide"]);
$router->post("/olvide", [LoginControllers::class, "olvide"]);

$router->get("/recuperar", [LoginControllers::class, "recuperar"]);
$router->post("/recuperar", [LoginControllers::class, "recuperar"]);

//Interfaz de Usuario
$router->get("/cita", [CitaControllers::class, "index"]);
$router->post("/cita", [CitaControllers::class, "index"]);



//Apis
$router->get("/api/servicios", [ApiControllers::class, "servicios"]);
$router->post("/api/citas", [ApiControllers::class, "guardar"]);
$router->post("/api/msj", [ApiControllers::class, "correo"]);

$router->get("/api/citas", [ApiControllers::class, "citas"]);
$router->post("/api/citas-eliminar", [ApiControllers::class, "eliminarCita"]);

//Admin
$router->get("/admin", [AdminControllers::class, "index"]);
$router->post("/admin", [AdminControllers::class, "index"]);

$router->get("/servicios", [AdminControllers::class, "servicios"]);
$router->post("/servicios", [AdminControllers::class, "servicios"]);

$router->get("/crear-servicio", [AdminControllers::class, "crear"]);
$router->post("/crear-servicio", [AdminControllers::class, "crear"]);

$router->get("/actualizar-servicio", [AdminControllers::class, "actualizar"]);
$router->post("/actualizar-servicio", [AdminControllers::class, "actualizar"]);

$router->post("/servicio-eliminar", [AdminControllers::class, "eliminar"]);
$router->post("/servicio-desabilitar", [AdminControllers::class, "desabilitar"]);
$router->post("/servicio-habilitar", [AdminControllers::class, "habilitar"]);

//Ejemplo Diana
$router->get("/api/get/usuarios", [ApiControllers::class, "loginApiGet"]);
$router->post("/api/post/usuarios", [ApiControllers::class, "loginApiPost"]);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();