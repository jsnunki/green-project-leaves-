<?php

include "../AccesoDatos/Conexion.php";

function existePorCorreoYClave($correoelectronico, $clave) {
    $clavee = encriptarSHA256($clave);
    $sql = "SELECT CONCAT(NOMBRE, ' ', COALESCE(APELLIDO, '')) AS NOMBRE FROM USUARIO WHERE CORREOELECTRONICO = '$correoelectronico' AND CLAVE = '$clavee'";
    $resultado = obtenerValor($sql);
    return $resultado;
}

function existePorCorreo($correoelectronico) {
    $sql = "SELECT 1 FROM USUARIO WHERE CORREOELECTRONICO = '$correoelectronico'";
    $resultado = obtenerValor($sql);
    return $resultado;
}

function insertar($nombre, $correoelectronico, $telefono, $clave) {    
    $clavee = encriptarSHA256($clave);
    $sql = "INSERT INTO USUARIO (nombre, correoelectronico, telefono, clave, fecharegistro)
            VALUES ('$nombre', '$correoelectronico', '$telefono', '$clavee', SYSDATE())";

    $conn = abrir();
    
    if (mysqli_query($conn, $sql)) {
        cerrar($conn);
        return $nombre;
    } else {
        cerrar($conn);
        return "";
    }
}

function encriptarSHA256($clave)
{
   // return password_hash($clave, PASSWORD_DEFAULT);
    return hash_hmac("sha256", $clave, 'S65SD51G61DF65G1');
}