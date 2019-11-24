<?php

include "../Negocio/VisitaN.php";

$resultado = obtenerVisitas();
header('Content-type: application/json; charset=utf-8');

echo json_encode($resultado);
exit();