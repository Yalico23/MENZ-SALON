<?php
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/'); 


function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}
function esUltimo (string $actual, string $proximo): bool{

    if ($actual !== $proximo) {
        return true;
    }else{
        return false;
    }
}

function is_Auth() : void{
    if (!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function is_Admin() : void{
    if (!isset($_SESSION['Admin'])) {
        header('Location: /');
    }
}

function redireccionar(): void{

    if (isset($_SESSION['login']) && isset($_SESSION['Admin'])) {
        header("Location: /admin");
    }elseif(isset($_SESSION['login'])){
        header("Location: /cita");
    }
}

function validarRedireccionar($URL)
{
    //validar la URL po ID valido
    $Id = $_GET['Id'];
    $Id = filter_var($Id, FILTER_VALIDATE_INT);

    if (!$Id) {
        header("Location: $URL");
    }

    return $Id;
}
function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];
    return in_array($tipo, $tipos);
}

/*
$Id = $_POST['Id'];
            $Id = filter_var($Id, FILTER_VALIDATE_INT);
            $tipo = $_POST['tipo']; //Vendedor o propiedad

            if (validarTipoContenido($tipo)) {
                $propiedad = Propiedad::find($Id);
                $propiedad->eliminar();
            }
*/
