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
                <img class="h-logo" src="Recursos/Imagenes/logo-horizontal.png" alt="GREEN" />
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

    <article class="container b-contenedor">
        <div class="row">
            <div class="col-sm-6 t-inicio">
                <h1 class="font-weight-bold">El daño ambiental aumenta en todo el planeta!</h1>
                <h3 class="font-weight-bold">Pero aún hay tiempo para revertir el peor impacto.</h3>
                <a href="Denuncia.php" class="btn btn-info btn-lg font-weight-bold">
                    Realiza tu denuncia ¡Ahora!
                </a>
            </div>
            <div class="col-sm-6">
                <img class="img-paisaje" src="Recursos/Imagenes/inicio-paisaje.png" alt="Paisaje ilustrado" />
            </div>
        </div>
    </article>
    <div class="separador-50"></div>
    <article class="b-cifras text-white">
        <div class="container">
            <div class="separador-30"></div>
            <div class="text-center">
                <h1 class="h1">¡Ayudemos a la tierra!</h1>
            </div>
            <div class="separador-30"></div>
            <div class="row">
                <div class="col-sm-4 text-center">
                    <h5>Hemos recibido</h5>
                    <div class="separador-20"></div>
                    <h1 class="font-weight-bold">
                        <a href="ListaDenuncias.php" class="text-white">
                            <?php
                            $result = obtenerValor("SELECT COUNT(1) FROM DENUNCIA");
                            echo $result;
                            ?>
                        </a>
                    </h1>
                    <div class="separador-20"></div>
                    <h4 class="font-weight-bold">
                        <a href="ListaDenuncias.php" class="text-white">
                            Denuncias Ambientales
                        </a>
                    </h4>
                </div>
                <div class="col-sm-4 text-center">
                    <h5>Activos</h5>
                    <div class="separador-20"></div>
                    <h1 class="font-weight-bold">190</h1>
                    <div class="separador-20"></div>
                    <h4 class="font-weight-bold">Movimientos #Green</h4>
                </div>
                <div class="col-sm-4 text-center">
                    <h5>Alianzas Internacionales</h5>
                    <div class="separador-20"></div>
                    <h1 class="font-weight-bold">87</h1>
                    <div class="separador-20"></div>
                    <h4 class="font-weight-bold">Organizaciones</h4>
                </div>
            </div>
            <div class="separador-30"></div>
        </div>
    </article>
    <div class="separador-50"></div>
    <article class="container b-comoayudar">
        <div class="row">
            <div class="col-sm-6">
                <div class="separador-30"></div>
                <h1 class="font-weight-bold">¿Qué podemos denunciar?</h1>
                <div class="separador-20"></div>
                <p>Cualquier conducta de una persona o empresa que contamine el espacio aéreo, el suelo, subsuelo, las aguas o demás recursos naturales y cause graves daños en la salud humana.</p>
                <div class="separador-30"></div>
                <a href="Denuncia.php" class="btn btn-lg btn-info">Realiza tu denuncia ¡Ahora!</a>
            </div>
            <div class="col-sm-3 text-center">
                <img src="Recursos/Imagenes/mala_gestion_residuos.png" alt="Delito mala gestión de residuos" />
                <p class="font-weight-bold">Mala gestión de los residuos</p>
                <p class="text-justify">La mala clasificación y tratamiento de residuos sólidos y electrónicos ponen en peligro el medio ambiente y la salud pública. Contiene elementos tóxicos como el cadmio, el plomo, el óxido de plomo, plata, cobre, antimonio, el níquel, etc...</p>
            </div>
            <div class="col-sm-3 text-center">
                <img src="Recursos/Imagenes/delincuencia_medioambiental.png" alt="Delito delincuencia medioambiental"/>
                <p class="font-weight-bold">Delincuencia medioambiental</p>
                <p class="text-justify">Colaboramos estrechamente con organizaciones gubernamentales y no gubernamentales con miras a desmantelar grupos organizados de delincuencia implicados en delitos meidoambientales.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="Recursos/Imagenes/delitos_contaminacion.png" alt="Delito de contaminación" />
                <p class="font-weight-bold">Delitos de contaminación</p>
                <p class="text-justify">La liberación de residuos tóxicos contaminan los sistemas de aire, tierra y agua, conduciendo al aumento de las enfermedades, la muerte de la fauna y la filtración de agua en el suelo.</p>
            </div>
            <div class="col-md-3 text-center">
                <img src="Recursos/Imagenes/delitos_vida_animal.png" alt="Delito contra la vida animal" />
                <p class="font-weight-bold">Delitos contra la vida animal</p>
                <p class="text-justify">Una grave amenaza a la supervivencia de la biodiversidad del planeta, las especies más afectadas por el tráfico ilegal son aves tropicales, reptiles, arácnidos, monos, etc...</p>
            </div>
            <div class="col-md-3 text-center">
                <img src="Recursos/Imagenes/delitos_forestales.png" alt="Delitos forestales" />
                <p class="font-weight-bold">Delitos forestales</p>
                <p class="text-justify">La tala e incendios descontrolados destruyen la biodiversidad y contribuyen directamente al cambio climático aumentando las emisiones de carbono y la pérdida de agricultura.</p>
            </div>
            <div class="col-md-3 text-center">
                <img src="Recursos/Imagenes/delitos_pesqueros.png" alt="Delitos pesqueros" />
                <p class="font-weight-bold">Delitos pesqueros</p>
                <p class="text-justify">La pesca ilegal, no declarada y no reglamentada daña el medio marino, poniendo en peligro los recursos naturales y todo el ecosistema oceánico.</p>
            </div>
        </div>
    </article>
    <div class="separador-50"></div>
    <article class="b-boletin text-white">
        <div class="container">
            <div class="separador-30"></div>
            <div class="row">
                <div class="col-sm-9">
                    <h4>Somos parte del programa de las Naciones Unidas para el Medio Ambiente (ONU Medio Ambiente) y actuamos como un defenson autorizado del medio ambiente.</h4>
                    <div class="separador-20"></div>
                    <p class="font-weight-bold">¡Regístrate a nuestro boletín!</p>
                    <form>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="email" class="txt-boletin form-control text-white" placeholder="Ingresa tu correo electrónico" />
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <a class="btn btn-lg btn-light" data-toggle="modal" data-target="#exampleModalCenter" href="#">Registrarse</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-3 text-center">
                    <img src="Recursos/Imagenes/icono_boletin.png" alt="GREEN Boletín" />
                </div>
                <div class="separador-30"></div>
            </div>
        </div>
    </article>
    <div class="separador-50"></div>
    <article class="b-movimientos container">
        <div class="text-center">
            <h1>¡Movimientos para proteger nuestro planeta!</h1>
        </div>
        <div class="row justify-content-center">
            <div class="movimientos-carousel col-sm-6">
                <div class="bd-example">
                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="Recursos/Imagenes/movimiento_planeta.png" class="d-block w-100" alt="Movimiento planeta">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>#DesafíodelasCiudades</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="Recursos/Imagenes/movimiento_osos_polares.png" class="d-block w-100" alt="Movimiento osos polares">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>#SalvemoselÁrtico</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="Recursos/Imagenes/movimiento_plastico.png" class="d-block w-100" alt="Movimiento plástico">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>#LibertaddelPlástico</p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
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
    <script src="Recursos/Javascript/Scripts.js"></script>
    <script src="https://kit.fontawesome.com/c3e49213ce.js" crossorigin="anonymous"></script>    
</body>
</html>