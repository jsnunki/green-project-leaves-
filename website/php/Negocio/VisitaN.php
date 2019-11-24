<?php

include "../AccesoDatos/Conexion.php";

function obtenerVisitas() {
    $sql = "SELECT COUNT(1) FROM VISITAS";
    $resultado = obtenerValor($sql);
    return $resultado;
}