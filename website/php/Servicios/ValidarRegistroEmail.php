<?php

include '../Negocio/UsuarioN.php';

session_start();

if (isset($_POST['correoelectronico'])) {

    $correoelectronico = $_POST['correoelectronico'];
    $resultado = existePorCorreo($correoelectronico);
    header('Content-type: application/json; charset=utf-8');
        
    echo json_encode($resultado);
    exit();
}