<?php

include "../Negocio/DenunciaN.php";

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$correoelectronico = $_POST['correoelectronico'];
$telefono = $_POST['telefono'];
$identificacion = $_POST['identificacion'];
$iddelito = $_POST['iddelito'];
$direccionafectado = $_POST['direccionafectado'];
$nombreimplicado = $_POST['nombreimplicado'];
$ciudad = $_POST['ciudad'];
$departamento = $_POST['departamento'];
$esanonima = $_POST['tipodenuncia'];
$denuncia = $_POST['denuncia'];

$resultado = insertarDenuncia($nombre, $apellido, $direccion, $correoelectronico, $telefono, $identificacion, $iddelito, $direccionafectado, $nombreimplicado, $ciudad, $departamento, $esanonima, $denuncia);
header('Content-type: application/json; charset=utf-8');

echo json_encode($resultado);
exit();