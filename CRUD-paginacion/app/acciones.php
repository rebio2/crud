<?php
include_once "Cliente.php";
include_once 'AccesoDAO.php';

function accionBorrar($id) {
    $db = AccesoDAO::getModelo();
    $resultado = $db->borrarUsuario($id);

    if ($resultado) {
        $_SESSION['mensaje'] = "Cliente borrado correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al borrar el cliente.";
        $_SESSION['tipo_mensaje'] = "danger";
    }

    header("Location: index.php");
    exit();
}

function accionTerminar(){
    AccesoDAO::closeModelo();
    session_destroy();
    header("Refresh:0 url='./index.php'");
}
 
function accionAlta(){
    $cliente = new Cliente();
    $cliente->id  = "";
    $cliente->first_name   = "";
    $cliente->email   = "";
    $cliente->gender = "";
    $cliente->ip_address = "";
    $cliente->telefono = "";
    $orden= "Nuevo";
    include_once "plantillas/formulario.php";
    die;
}

function accionDetalles($id){
    $db = AccesoDAO::getModelo();
    $cliente = $db->getCliente($id);
    $orden = "Detalles";
    include_once "plantillas/formulario.php";
    die;
}


function accionModificar($id) {
    $db = AccesoDAO::getModelo();
    $cliente = $db->getCliente($id);
    $orden = "Modificar";
    include_once "plantillas/formulario.php";
    die;
}

function accionPostAlta() {
    $cliente = new Cliente();
    $cliente->first_name = $_POST['first_name'];
    $cliente->email = $_POST['email'];
    $cliente->gender = $_POST['gender'];
    $cliente->ip_address = $_POST['ip_address'];
    $cliente->telefono = $_POST['telefono'];
    
    $db = AccesoDAO::getModelo();
    $cliente->id = $db->getNextId(); // Obtener el siguiente ID libre
    
    $resultado = $db->addUsuario($cliente);
    
    if ($resultado) {
        $_SESSION['mensaje'] = "Cliente guardado correctamente.";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al guardar el cliente.";
        $_SESSION['tipo_mensaje'] = "danger";
    }

    header("Location: index.php");
    exit();
}

function accionPostModificar() {
    $cliente = new Cliente();
    $cliente->id = $_POST['id'];
    $cliente->first_name = $_POST['first_name'];
    $cliente->email = $_POST['email'];
    $cliente->gender = $_POST['gender'];
    $cliente->ip_address = $_POST['ip_address'];
    $cliente->telefono = $_POST['telefono'];
    
    $db = AccesoDAO::getModelo();
    $resultado = $db->modUsuario($cliente);
    
    if ($resultado) {
        echo "Cliente actualizado correctamente.";
    } else {
        echo "Error al actualizar el cliente.";
    }
}

