<?php

include "../AccesoDatos/Conexion.php";

function insertarDenuncia($nombre, $apellido, $direccion, $correoelectronico, $telefono, $identificacion, $iddelito, $direccionafectado, $nombreimplicado, $ciudad, $departamento, $esanonima, $denuncia) {    
    $sql = "INSERT INTO DENUNCIA (nombre, apellido, direccion, correoelectronico, telefono, identificacion, iddelito, direccionafectado, nombreimplicado, ciudad, departamento, fechacreacion, estado, esanonima, idciudad, denuncia)
            VALUES ('$nombre', '$apellido', '$direccion', '$correoelectronico', '$telefono', '$identificacion', '$iddelito', '$direccionafectado', '$nombreimplicado', '$ciudad', '$departamento', SYSDATE(), 'P', $esanonima, NULL, '$denuncia')";

    //echo $sql;
    
    $conn = abrir();
    
    if (mysqli_query($conn, $sql)) {
        cerrar($conn);
        return true;
    } else {
        cerrar($conn);
        return false;
    }
}