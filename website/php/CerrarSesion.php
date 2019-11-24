<?php

session_start();
if(!empty($_SESSION['sesionusuario']))
{
    $_SESSION['sesionusuario'] = '';
    session_destroy();
}
header("Location:Inicio.php");