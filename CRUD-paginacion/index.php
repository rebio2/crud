<?php
define('FPAG', 10);
require_once "app/AccesoDAO.php";
require_once "app/Cliente.php";
require_once "app/acciones.php";

session_start();

$primero = isset($_SESSION['posini']) ? $_SESSION['posini'] : 0;
$ultimo = AccesoDAO::getModelo()->totalClientes() - 1;

$orden = isset($_GET['orden']) ? $_GET['orden'] : null;

switch ($orden) {
    case "Nuevo":
        accionAlta();
        break;
    case "PostAlta":
        accionPostAlta();
        break;
    case "Modificar":
        accionModificar($_GET['id']);
        break;
    case "PostModificar":
        accionPostModificar();
        break;
    case "Borrar":
        accionBorrar($_GET['id']);
        break;
    case "Detalles":
        accionDetalles($_GET['id']);
        break;
    case "Primero":
        $primero = 0;
        break;
    case "Siguiente":
        $primero += FPAG;
        if ($primero > $ultimo) {
            $primero = $ultimo;
        }
        break;
    case "Anterior":
        $primero -= FPAG;
        if ($primero < 0) {
            $primero = 0;
        }
        break;
    case "Ultimo":
        $primero = $ultimo;
        break;
    case "Terminar":
        accionTerminar();
        break;
    default:
        $primero = 0;
        break;
}

$_SESSION['posini'] = $primero;

$tclientes = AccesoDAO::getModelo()->getClientes($primero, FPAG);
include "app/plantillas/principal.php";
?>