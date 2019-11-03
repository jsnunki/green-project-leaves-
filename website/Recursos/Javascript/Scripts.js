$(function () {

    var txtNombre = document.getElementById("txtNombre");
    var txtApellidos = document.getElementById("txtApellidos");
    var txtDireccion = document.getElementById("txtDireccion");
    var txtEmail = document.getElementById("txtEmail");
    var txtDireccionDenuncia = document.getElementById("txtDireccionDenuncia");
    var txtNombreImplicado = document.getElementById("txtNombreImplicado");

    if (txtNombre.value == '')
        alert("El campo Nombre es requerido.");

    if (txtApellidos.value == '')
        alert("El campo Apellidos es requerido.");

    if (txtDireccion.value == '')
        alert("El campo Dirección es requerido.");

    if (txtEmail.value == '')
        alert("El campo Email es requerido.");

    if (txtDireccionDenuncia.value == '')
        alert("El campo Dirección del lugar afectado es requerido.");

    if (txtNombreImplicado.value == '')
        alert("El campo Nombre del implicado es requerido.");

});