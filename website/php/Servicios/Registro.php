<?php

include './IniciarSesion.php';

if (isset($_POST['nombre']) && isset($_POST['correoelectronico']) && 
    isset($_POST['telefono']) && isset($_POST['clave'])) {

    $nombre = $_POST['nombre'];
    $correoelectronico = $_POST['correoelectronico'];
    $telefono = $_POST['telefono'];
    $clave = $_POST['clave'];
    
    
    $resultado = insertar($nombre, $correoelectronico, $telefono, $clave);
    header('Content-type: application/json; charset=utf-8');
    
    CrearSesion($resultado);
        
    echo json_encode($resultado);
    exit();
}