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
    const API_URL = "http://localhost/GREEN/api/denuncia";
  
    try {
      const response = await request(API_URL, data, "POST");
      console.info(response);
    } catch (error) {
      console.error(error);
    }
  }
  
  function getFormData() {
    const anonima = Boolean($("[name='tipo']:checked").val());
    const nombre = $("#nombre").val();
    const apellidos = $("#apellidos").val();
    const direccion = $("#direccion").val();
    const departamento = $("#departamento").val();
    const ciudad = $("#ciudad").val();
    const correo = $("#correo").val();
    const telefono = $("#telefono").val();
    const identificacion = $("#identificacion").val();
    const delito = $("#delito").val();
    const direccionAfectado = $("#direccionAfectado").val();
    const nombreImplicado = $("#nombreImplicado").val();
    const denuncia = $("#denuncia").val();
    const archivos = [];
  
    return {
      anonima,
      nombre,
      apellidos,
      direccion,
      departamento,
      ciudad,
      correo,
      telefono,
      identificacion,
      delito,
      direccionAfectado,
      nombreImplicado,
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