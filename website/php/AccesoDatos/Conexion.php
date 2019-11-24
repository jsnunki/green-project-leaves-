<?php

function abrir()
{
    $dbhost = "localhost";
    $dbuser = "usuariobd";
    $dbpass = "*****";
    $db = "green";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Error de conexión a la base de datos: %s\n". $conn -> error);
    
    return $conn;
}

function cerrar($conn)
{
    $conn -> close();
}

function obtenerValor($sql) {    
    $conn = abrir();    
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    cerrar($conn);
    return is_array($row) ? $row[0] : '';
}
