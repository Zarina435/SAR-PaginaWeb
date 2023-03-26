/** Función de JQuery que ejecuta las funciones cuando la página acaba de cargar (está ready) */
$(document).ready(function() {
    $("#loading").hide();
    $("#cajaLoading").hide();
    $("#comprarButton").click(comprar);
})

/** Función JavaScript que muestra un gif de loading y después lo oculta para mostrar una confirmación de compra */
function comprar() {
    $("#loading").show();
    setTimeout(function() {$("#loading").hide(); $("#cajaLoading").show();}, 2000);
    setTimeout(function() {window.location.href='../php/Index.php';}, 4000)
}