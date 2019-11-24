<?php

include './IniciarSesion.php';

if (isset($_GET['nombre']) && isset($_GET['correoelectronico']) && 
    isset($_GET['telefono']) && isset($_GET['clave'])) {

    $nombre = $_GET['nombre'];
    $correoelectronico = $_GET['correoelectronico'];
    $telefono = $_GET['telefono'];
    $clave = $_GET['clave'];
    
    
    $resultado = insertar($nombre, $correoelectronico, $telefono, $clave);
    header('Content-type: application/json; charset=utf-8');
    
    CrearSesion($resultado);
        
    echo json_encode($resultado);
    exit();
}