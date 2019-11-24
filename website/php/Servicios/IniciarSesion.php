<?php

include '../Negocio/UsuarioN.php';

session_start();

if (isset($_POST['correoelectronico']) && isset($_POST['clave']) && empty($_POST["nombre"])) {

    $correoelectronico = $_POST['correoelectronico'];
    $clave = $_POST['clave'];
    $resultado = existePorCorreoYClave($correoelectronico, $clave);
    header('Content-type: application/json; charset=utf-8');
    
    if ($resultado != "") {
        CrearSesion($resultado);
    }
    
    echo json_encode($resultado);
    exit();
}

function CrearSesion($Usuario) {

    if(!isset($_COOKIE['sesionusuario'])) { 
      setcookie('sesionusuario', $Usuario, 7 * 24 * 60 * 60);
    }
    
    $_SESSION['sesionusuario'] = $Usuario; 
}