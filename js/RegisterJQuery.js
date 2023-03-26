$(document).ready(function () {
    $("#formRegister").submit(comprobarInputs);
})
/** Función JavaScript que comprueba en cliente los datos insertados en los inputs del formulario */
function comprobarInputs() {
    var email = $("#email").val();
    var passwd = $("#passwd").val();
    var confPasswd = $("#confPasswd").val();
    var errores = 3;
    if(!/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9_.-]+\.[a-zA-Z]+$/.test(email)) {
        $("#forEmail").text("El email no cumple los requisitos");
    }
    else {
        errores = errores - 1;
    }
    if(passwd.length < 8) {
        $("#forPasswd").text("La contraseña tiene menos de 8 caracteres");
    }
    else {
        errores = errores - 1;
    }
    if(passwd != confPasswd) {
        $("#forConfPasswd").text("Las contraseñas no coinciden.");
    }
    else {
        errores = errores - 1;
    }
    if (errores == 0) {
        // Todo ha ido guay
        return true;
    }
    return false;
}