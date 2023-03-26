
//Funcion AJAX para añadir un comentario al XML y al mismo tiempo visualizarlo
function addComentario(){

    //Creamos un FormDara el cual contiene los datos del formulario necesarios para el comentario
    let form = document.getElementById('formulario');
    var formData = new FormData(form);
    var xml = new XMLHttpRequest();
    
    //Enviamos la solicitud junto a los datos en modo POST
    xml.open("POST","../php/AñadirComentario.php", true);
    xml.responseType = 'document';
    console.log(formData.get('comentario'));

    //Enviamos los datos
    xml.send(formData);

    xml.onload = function(){

        //Aqui cargamos una tabla de los comentarios en el div con el id "div2", antes borramos lo que habia anteriormente
        var parent = document.getElementById("div2");
        var response = xml.response;

        parent.innerHTML='';
    
        parent.append(response.body);
    }
}