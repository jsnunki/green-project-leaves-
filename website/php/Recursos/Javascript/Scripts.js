async function request(url = "", data, method = "GET") {
    const options = {
      method,
      body: data && JSON.stringify(data),
      headers: { "Content-Type": "application/json" }
    };
  
    const response = await fetch(url, options);
    return await response.json();
  }
  
  async function sendFormData(data) {
    SolicitudAjax(        
        "POST",
        "/Servicios/Denuncia.php",
        data,
        "json",
        function(respuesta) {
            if (respuesta == true) {
                window.location = "Gracias.html";
            }
        }
    );
//    const API_URL = "/Servicios/Denuncia.php";
//  
//    try {
//      const response = await request(API_URL, data, "POST");
//      console.info(response);
//    } catch (error) {
//      console.error(error);
//    }
  }
  
  function getFormData() {
    const tipodenuncia = Boolean($("[name='tipo']:checked").val());
    const nombre = $("#nombre").val();
    const apellido = $("#apellidos").val();
    const direccion = $("#direccion").val();
    const departamento = $("#departamento").val();
    const ciudad = $("#ciudad").val();
    const correoelectronico = $("#correo").val();
    const telefono = $("#telefono").val();
    const identificacion = $("#identificacion").val();
    const iddelito = $("#delito").val();
    const direccionafectado = $("#direccionAfectado").val();
    const nombreimplicado = $("#nombreImplicado").val();
    const denuncia = $("form #denuncia").val();
    const archivos = [];
  
    return {
      tipodenuncia,
      nombre,
      apellido,
      direccion,
      departamento,
      ciudad,
      correoelectronico,
      telefono,
      identificacion,
      iddelito,
      direccionafectado,
      nombreimplicado,
      denuncia,
      archivos
    };
  }
  
  async function sendComplain(event) {
    event && event.preventDefault();
    const formData = getFormData();
    await sendFormData(formData);
  }
  
  async function loadCitiesAndDepartments() {
    const DATOS_GOV_URL = "https://www.datos.gov.co/resource/";
    const RESOURCE = "xdk5-pm3f";
  
    const FORBIDDEN_ATTRIBUTES = [
      "c_digo_dane_del_departamento",
      "c_digo_dane_del_municipio"
    ];
  
    const cleanCityAttributes = city => _.omit(city, FORBIDDEN_ATTRIBUTES);
    const cleanCitiesAttributes = cities => cities.map(cleanCityAttributes);
    const groupCitiesByDeparment = cities => _.groupBy(cities, "departamento");
  
    try {
      const response = await request(`${DATOS_GOV_URL}${RESOURCE}.json`);
      const cleanedCities = cleanCitiesAttributes(response);
      const citiesByDeparment = groupCitiesByDeparment(cleanedCities);
      const departaments = Object.keys(citiesByDeparment);
  
      return { departaments, citiesByDeparment };
    } catch (error) {
      console.log(error);
    }
  }
  
  function buildCities({ citiesByDeparment }) {
    return function(event) {
      const deparment = event && event.target && event.target.value;
      const filteredCities = citiesByDeparment[deparment];
  
      const $ciudad = $("#ciudad");
      $ciudad.empty();
  
      filteredCities.forEach(city => {
        $ciudad.append(
          $(`<option>${city.municipio}</option>`).attr("value", city.municipio)
        );
      });
    };
  }
  
  function buildDepartments({ departaments }) {
    const $departamento = $("#departamento");
  
    departaments.forEach(department => {
      $departamento.append(
        $(`<option>${department}</option>`).attr("value", department)
      );
    });
  }
  
  function loadAutocomplete() {
    const $direccion = document.getElementById('direccion');
    new google.maps.places.Autocomplete($direccion);
  }
  
  $(async function() {
    // load departments and cities
    const { departaments, citiesByDeparment } = await loadCitiesAndDepartments();
    buildDepartments({ departaments });
  
    // load autocomplete
    loadAutocomplete();
  
    // handlers
    $("#denuncia").on("submit", sendComplain);
    $("#departamento").on("change", buildCities({ citiesByDeparment }));
  });
  
  

$(function() {
    // Formulario de Login
    $("#btnLoginEmail").click(function() {
        $("#exampleModalCenter").modal("toggle");
        $("#modalLogin").modal("toggle");
    });
    
    $("#formLogin").submit(function(e) {
        e.preventDefault();
        var elemento = $(this);
        SolicitudAjax(
            "POST", 
            "/Servicios/IniciarSesion.php",
            { correoelectronico: elemento.find("[name='correoelectronico']").val(), clave: elemento.find("[name='clave']").val() },
            "json",
            function(respuesta) {
                if (respuesta !== "") {
                    window.location = "Inicio.php";
                } else {
                    $("#msgLoginError").show();
                    setTimeout(function() { $("#msgLoginError").slideUp("slow"); }, 8000);
                }
            }
        );
        
        return false;
    });

    // Formulario de registro
    $("#btnRegistrarme").click(function() {
        $("#modalLogin").modal("toggle");
        $("#modalRegistro").modal("toggle");
    });

    $("#btnIrLogin").click(function() {
        $("#modalLogin").modal("toggle");
        $("#modalRegistro").modal("toggle");
    });
    
    $("form#formRegistro").submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var _nombre = form.find("[name='nombre']").val();
        var _correoelectronico = form.find("[name='correoelectronico']").val();
        var _telefono = form.find("[name='telefono']").val();
        var _clave = form.find("[name='clave']").val();
        var _claveconfirmar = form.find("[name='claveconfirmar']").val();
        
        if (_clave !== _claveconfirmar) {
            $("#msgLoginRegistro").text("Las contraseñas no coinciden!").slideDown();
            setTimeout(function() { $("#msgLoginRegistro").slideUp("slow"); }, 8000);
        } else {        
            SolicitudAjax(
                "POST", 
                "/Servicios/ValidarRegistroEmail.php", 
                { correoelectronico: _correoelectronico }, 
                "json",
                function(respuesta) {
                    if (respuesta != "") {
                        $("#msgLoginRegistro").text("El correo electrónico ya se encuentra registrado!").slideDown();
                        setTimeout(function() { $("#msgLoginRegistro").slideUp("slow"); }, 8000);
                    } else {
                        SolicitudAjax(
                            "POST", 
                            "/Servicios/Registro.php",
                            { nombre: _nombre, correoelectronico: _correoelectronico, telefono: _telefono, clave: _clave },
                            "json",
                            function(respuesta2) {
                                if (respuesta2 != "") {
                                    window.location = "Inicio.php";
                                } else {
                                    $("#msgLoginRegistro").text("No fue posible realizar el registro!").slideDown();
                                    setTimeout(function() { $("#msgLoginRegistro").slideUp("slow"); }, 8000);
                                }                                
                            }
                        );
                    }
                }
            );
        }
        return false;
    });
    
    
    // Denuncias
    
    var txt_correoelectronico = $("form#denuncia [name='correoelectronico']");
    $("form#denuncia input[name='tipodenuncia']").change(function() {
        if ($(this).val() == "1") {
            txt_correoelectronico.attr("required", "required");
        } else {
            txt_correoelectronico.removeAttr("required");
        }
    });    
    
    // Se refresca contador de visitas cada minuto
    setInterval(function() {
        ActualizarVisistas();
    }, 10000);    
    ActualizarVisistas();
    
});

function ActualizarVisistas() {
    SolicitudAjax(
            "GET", 
            "/Servicios/Visita.php", 
            null, 
            "json",
            function(respuesta) {
                $("span.contador-visitas").text(respuesta);
            }
        );  
}

function SolicitudAjax(_method, _url, _data, _dataType, fDone, fFail) {
    if (fDone == null || fDone == undefined)
        fDone = function (data) { };
    if (fFail == null || fFail == undefined)
        fFail = function (data) { };
   
    $.ajax({
        method: _method,
        url: _url,
        data: _data,
        dataType: _dataType,
        async: true,
        cache: false
    }).done(function (data) {
        fDone(data);
    }).fail(function (data, err1, err2, err3) {
        fFail(data, err1, err2, err3);
    });
}