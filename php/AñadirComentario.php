<?php

 session_start();

#Comprobamos que se ha iniciado sesion
 if(isset($_SESSION['user'])) {
   #Creamos/cargamos las variables necesarias a añadir
   $fecha = date("d/m/y");
   $correo = $_SESSION['user'];
   $nombre = $_SESSION['name'];
   $comen = $_POST["comentario"];
   $Id=$_POST["Id"];


   #Cargar XML a $comentarios
   $xml = simplexml_load_file("../xml/comentarios.xml");

   #Añadimos el nuevo comentario
   $comentario = $xml->addChild("comentario");
   $comentario->addAttribute("Id", $Id);
   $email = $comentario->addChild("email", $correo);
   $comentario->addChild("nombre", $nombre);
   $comentario->addChild("fecha", $fecha);
   $comentario->addChild("comen", $comen);

   #Sobresquibimos el xml con los nuevos datos
   $xml->asXML("../xml/comentarios.xml");


   #Aqui creamos la tabla que se va a mostrar con el nuevo comentario mediate AJAX
   $ListaComentarios='';
   $ListaComentarios .= '<table id="comentarios" style="margin-left: 200px;">
   <tr>
      <th colspan="2">Comentarios</th>
   </tr>';


   $xml = simplexml_load_file("../xml/comentarios.xml");
  $i=0;
   foreach ($xml->children() as $comentario){
     if($comentario['Id']==$_POST['Id']){
        if($i==0){$ListaComentarios .= "<tr>";}

            $ListaComentarios .= "<td>
                        <div id='comentario'>
                              <h3>".$comentario->nombre."</h3>
                              <p>".$comentario->fecha."</p>
                              <br>
                              ".$comentario->comen."
                           </div>
                        </td>";
      if($i==1){
              $ListaComentarios .="</tr>";
              $i=0;
      }else{$i++;}
   }}
   $ListaComentarios .= '</table>';
   echo $ListaComentarios;

  
   
   

 }
?>



