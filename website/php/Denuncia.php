<?php

    include "./AccesoDatos/Conexion.php";

    session_start();
    
    insertarVisita();
    
    function insertarVisita() {    
        $sql = "INSERT INTO VISITAS (fecha) VALUES (SYSDATE())";
        $conn = abrir();

        if (mysqli_query($conn, $sql)) {
            cerrar($conn);
        }
        return true;
    }
?>
﻿<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <link href="Recursos/Css/bootstrap-4.3.1-dist/bootstrap.min.css" rel="stylesheet" />
    <link href="Recursos/Css/Estilos.css" rel="stylesheet" />
    
    <title>GREEN</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light h-menu">
            <a class="navbar-brand" href="Inicio.php">
                <img class="h-logo" src="Recursos/Imagenes/logo-horizontal.png" alt="GREEN Logo"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
                    <li class="nav-item active">
                        <a class="nav-link" href="Inicio.php">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Denuncia.php" tabindex="-1">Denuncias</a>
                    </li>
                    <?php
                    if (empty($_SESSION["sesionusuario"])) {
                        ?>
                        <li class="nav-item">
                            <a class="btn btn-success btn-lg" href="#" tabindex="-1" data-toggle="modal" data-target="#exampleModalCenter">Ingresar</a>
                        </li>
                    <?php
                    } else {
                    ?>    
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#" tabindex="-1">
                                <?php
                                    echo($_SESSION["sesionusuario"]);
                                ?>
                                <img src="Recursos/Imagenes/icono_usuario.png" alt="Icono de usuario"/>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="CerrarSesion.php">Cerrar sesión</a>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>

    <article class="f-denuncia">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">¡Denuncia ambiental!</h1>
                <h2>Nuestra obligación con el medio ambiente.</h2>
            </div>
        </div>
        <div class="separador-30"></div>
        <div class="container">
            <form id="denuncia" method="POST" action="#" enctype="multipart/form-data" >
                <div class="form-group">
                    <input type="radio" id="anonima" name="tipodenuncia" value="0" /> <label for="anonima">Denuncia anónima</label>
                    <input type="radio" id="notificado" checked name="tipodenuncia" value="1" /> <label for="notificado">Anónima pero quiero ser notificado</label>
                </div>
                <div class="separador-30"></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input id="nombre" name="nombre" type="text" class="form-control"  />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apellidos">Apellidos</label>
                                    <input id="apellidos" name="apellido" type="text" class="form-control"  />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="departamento">Departamento</label>
                                    <select id="departamento" name="departamento" class="form-control" required>
                                        <option selected="true" disabled="disabled" value="">Seleccione...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ciudad">Ciudad</label>
                                    <select id="ciudad" name="ciudad" class="form-control" required>
                                        <option selected="true" disabled="disabled" value="">Seleccione...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input id="direccion" name="direccion" type="text" class="form-control"  />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="correo">Correo electrónico</label>
                                    <input id="correo" type="email" name="correoelectronico" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="telefono">Telefono</label>
                                    <input id="telefono" type="text" name="telefono" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="identificacion">No. Identificación</label>
                                    <input id="identificacion" type="number" name="identificacion" class="form-control"  />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="delito">Tipo de delito</label>
                                    <select id="delito" name="iddelito" class="form-control" required>
                                        <option selected="true" disabled="disabled" value="">Seleccione...</option>
                                        <?php
                                        $conn = abrir();
                                        $sql = "SELECT ID, NOMBRE FROM DELITO";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo "<option value='" . $row['ID'] ."'>" . $row['NOMBRE'] ."</option>";
                                        }
                                        cerrar($conn);
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="direccionAfectado">Dirección del lugar afectado</label>
                                    <input id="direccionAfectado" name="direccionafectado" type="text" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nombreImplicado">Nombre del implicado (Persona o empresa)</label>
                                    <input id="nombreImplicado" name="nombreimplicado" type="text" class="form-control" required />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="denuncia">Denuncia</label>
                            <textarea id="denuncia" name="denuncia" class="form-control" rows="15" placeholder="Escribe tu denuncia y adjunta las evidencias (Fotos, videos, documentos..)" required></textarea>
                        </div>
                        <div class="form-group">
                            <img src="Recursos/Imagenes/icono_adjuntar.png" class="icono-adjuntar" alt="Icono de adjuntar evidencia"/>
                            <div class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="archivos" >
                                    <label for="archivos" class="custom-file-label">Subir archivos...</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input id="acepto" type="checkbox" required /> <label for="acepto">Acepto términos y condiciones.</label>
                        </div>
                        <div class="separador-30"></div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn-enviar btn btn-large btn-info">Enviar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </article>

    <div class="separador-40"></div>
    <footer>
        <div class="f-pie container">
            <div class="row">
                <div class="col-sm-12">
                    <a href="Inicio.php" class="btn btn-link text-dark font-weight-bold">Inicio</a>
                    <a href="Denuncia.php" class="btn btn-link text-dark font-weight-bold">Denuncias</a>
                    <strong class="btn text-dark font-weight-bold">Hemos recibido <span class="contador-visitas">...</span> visitas de pesonas interasadas en ayudar al planeta!</strong>
                </div>
                <div class="col-sm-6"> 
                    <div class="separador-50"></div>
                    <a href="Inicio.php" class="btn btn-link logo">
                        <img src="Recursos/Imagenes/logo-horizontal.png" alt="GREEN Logo"/>
                    </a>
                    <a href="#" class="btn btn-link text-dark">Política de Privacidad</a>
                    <a href="#" class="btn btn-link text-dark">Términos y Condiciones</a>
                </div>
                <div class="col-sm-6 text-right redes-sociales">
                    <div class="separador-50"></div>
                    <div class="separador-10"></div>
                    Conéctate con nosostros:
                    <img src="Recursos/Imagenes/icono_twitter.png" alt="GREEN Facebook" />
                    <img src="Recursos/Imagenes/icono_instagram.png" alt="GREEN Instagram" />
                    <img src="Recursos/Imagenes/icono_facebook.png" alt="GREEN Facebook" />
                </div>
            </div>
            <div class="separador-30"></div>
            <p class="t-derechos">© 2019 Green. All rights reserved. Any reference to Ginchy or any associated logos is for demostration purposes anly and is not intended to refer to any actual organization or event.</p>
        </div>
    </footer>

    
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <img src="Recursos/Imagenes/logo-horizontal.png" alt="GREEN Logo" />
                        <div class="separador-10"></div>
                        <p class="t">Cuidar el planeta es tarea de todos, únete a nosotros y participa promoviendo los movimientos a favor de nuestro medio ambiente.</p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="separador-20"></div>
                    <button class="btn btn-large btn-info btn-facebook">Iniciar con Facebook</button>
                    <div class="separador-10"></div>
                    <button class="btn btn-large btn-twitter">Iniciar con Twitter</button>
                    <div class="separador-10"></div>
                    <button class="btn btn-large btn-google">Iniciar con Google</button>
                    <div class="separador-10"></div>
                    <button id="btnLoginEmail" class="btn btn-large btn-email">Iniciar con Email</button>
                    <div class="separador-20"></div>
                    <a href="#">Olvidé mi contraseña</a>
                    <div class="separador-30"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <img src="Recursos/Imagenes/logo-horizontal.png" alt="GREEN Logo" />
                        <div class="separador-10"></div>
                        <p class="t">Cuidar el planeta es tarea de todos, únete a nosotros y participa promoviendo los movimientos a favor de nuestro medio ambiente.</p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="separador-20"></div>
                    <form id="formLogin" method="post" action="#" >
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" id="btnGroupAddon">
                                        <i class="far fa-user"></i>
                                    </div>
                                </div>
                                <input type="email" name="correoelectronico" required class="form-control" placeholder="Correo electrónico" aria-label="Input group example" aria-describedby="btnGroupAddon"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" id="btnGroupAddon">
                                        <i class="fas fa-key"></i>
                                    </div>
                                </div>
                                <input type="password" name="clave" required class="form-control" placeholder="Contraseña" aria-label="Input group example" aria-describedby="btnGroupAddon"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-info">Iniciar sesión</button>
                        </div>
                        <div id="msgLoginError" class="form-group alert alert-danger"  role="alert" style="display: none;">
                            Usuario o clave incorrectos.
                        </div>
                        <div class="separador-10"></div>
                        Aún no tengo una cuenta, <button type="button" class="btn btn-link" id="btnRegistrarme">registrarme</button>
                    </form>
                    <div class="separador-30"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <img src="Recursos/Imagenes/logo-horizontal.png" alt="GREEN Logo" />
                        <div class="separador-10"></div>
                        <p class="t">Cuidar el planeta es tarea de todos, únete a nosotros y participa promoviendo los movimientos a favor de nuestro medio ambiente.</p>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="separador-20"></div>
                    <form id="formRegistro" method="post" action="">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="far fa-user"></i>
                                    </div>
                                </div>
                                <input type="text" name="nombre" required class="form-control" placeholder="Nombre de usuario" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-at"></i>
                                    </div>
                                </div>
                                <input type="email" name="correoelectronico" required class="form-control txt-email" placeholder="Correo electrónico" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                </div>
                                <input type="text" name="telefono" required class="form-control txt-phone" placeholder="Teléfono" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </div>
                                </div>
                                <input type="password" name="clave" required class="form-control" placeholder="Contraseña" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-key"></i>
                                    </div>
                                </div>
                                <input type="password" name="claveconfirmar" required class="form-control" placeholder="Confirmar contraseña" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="acepto" id="acepto" required />
                            <label for="acepto">Acepto los términos y condiciones</label>
                        </div>
                        <div id="msgLoginRegistro" class="form-group alert alert-danger"  role="alert" style="display: none;">                            
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-info">Registrarme</button>
                        </div>
                        <div class="separador-10"></div>
                        Ya tengo una cuenta, <button type="button" class="btn btn-link" id="btnIrLogin">Iniciar sesión</button>
                    <form>
                    <div class="separador-30"></div>
                </div>
            </div>
        </div>
    </div>



    <script src="Recursos/Javascript/jquery-3.4.1.min.js"></script>
    <script src="Recursos/Javascript/popper.min.js"></script>
    <script src="Recursos/Javascript/bootstrap-4.3.1-dist/bootstrap.min.js"></script>
    <script src="Recursos/Javascript/lodash.min.js"></script>
    <script src="Recursos/Javascript/Scripts.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDffOY9ydazyFX6Nd7ytjFH9djys3unB2c&libraries=places"async defer></script>
    <script src="https://kit.fontawesome.com/c3e49213ce.js" crossorigin="anonymous"></script>    
</body>
</html>