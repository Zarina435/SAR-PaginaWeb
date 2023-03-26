<?php     session_start();?>
<!--TDefiniciones necesarias-->
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php include("../php/DbConfig.php") ?>
  <link rel="stylesheet" type="text/css" href="../style/ropa.css">
  <script src="../js/AñadirVerComentariosAjax.js"></script>

  <title>OASIS</title>
</head>
<body>
<?php
    if(isset($_SESSION['user'])) {
      echo ('<div class="topBar">
      <ul>
          <li><a id="OASIS_topbar"    href="../php/Index.php">Home</a>                </li>
          <li><a id="OASIS2_topbar"   href="../php/about.php">About</a>      </li>
          <li><a id="register_topbar" href="../php/Logout.php">Logout</a></li>
      </ul>
  </div>');


    }
    else{
   echo ('<div class="topBar">
        <ul>
            <li><a id="OASIS_topbar"    href="../php/Index.php">Home</a>                </li>
            <li><a id="OASIS2_topbar"   href="../php/about.php">About</a>      </li>
            <li><a id="login_topbar"    href="../php/Login.php">Login</a>      </li>
            <li><a id="register_topbar" href="../php/Register.php">Register</a></li>
        </ul>
    </div>');}
    ?>
  <br>
  <br>
  <!--Menú estático zona izquierda-->
  <div class="tienda">
    <ul id="listatienda" class="listatienda">
      <li class="dropdown"><a href="../php/ropa.php?genero=Hombre" class="dropbtn">Hombre</a>
        <div class="dropdown-content">
          <a href="../php/ropa.php?parte=Sudaderas&genero=Hombre">Sudaderas</a>
          <a href="../php/ropa.php?parte=Pantalones&genero=Hombre">Pantalones</a>
        </div>
      </li>
      <li class="dropdown"><a href="../php/ropa.php?genero=Mujer" class="dropbtn">Mujer</a>
        <div class="dropdown-content">
          <a href="../php/ropa.php?parte=Sudaderas&genero=Mujer">Sudaderas</a>
          <a href="../php/ropa.php?parte=Pantalones&genero=Mujer">Pantalones</a>
        </div>
      </li>
      <li id="li1"><a href="../php/ropa.php?parte=Accesorios">Accesorios</a></li>
      <li id="li1"><a href="../php/ropa.php?parte=Zapatos">Zapatos</a></li>
    </ul>
  </div>
  <?php
    ## COMPROBACIONES para el GET[id]
    if(isset($_GET['id'])) {
      $Id = $_GET['id'];
      ## Conseguir datos de UNA PRENDRA EN ESPECIFICOS de la BD
      $link = mysqli_connect($server, $user, $pass, $basededatos);
      $query = "SELECT Nombre, Precio, Foto, Descripcion FROM ropa WHERE Id = ".$Id;
      $resultado = mysqli_query($link, $query);
      if($row = mysqli_fetch_array($resultado)) {
        echo("
          <div id='titulo'>
            <h1 class='titulo'>".$row['Nombre']."</h1>
          </div>
          <div id='foto1'>
            <div class='cuadrado2'>");
            echo '<img src="data:image/jpeg;base64,'.base64_encode ($row['Foto']).'"height="502" width="502"/>';

           echo (" </div>
          </div>
          <div id='texto'>
            <div id='descripcion'>
              ".$row['Descripcion']."
            </div>
          <br>
          <div id='precio'>
            <h2>".$row['Precio']."</h2>
          </div>
        ");
      }
      else {
        echo("Error: Parece que ha insertado un ID inexistente.");
      }
    }

  ?>
  <!--Boton compra-->
      <br>
      <div id="bot">
        <form id="compraForm" name="compraForm" action="../php/Compra.php" method="POST">
          <input type="submit" name="comprarBtn" value="COMPRAR">
          <input type="hidden" name="idProducto" value=<?php echo("'".$_GET['id']."'");?>>
        </form>
      </div>
  </div>

  <div id='Añadircomentario'>
  <?php 
    if(!isset($_SESSION['user'])) {
      echo ("<h2>Necesitas iniciar sesion para poder añadir un comentario</h2>");
    }
    else {
    echo ("<form id='formulario' name='formulario' method='POST'>

    <textarea  name='comentario'  rows='2' cols='80' placeholder='Añade tu comentario'></textarea>
    <input type='hidden' id='Id' name='Id' value='".$_GET['id']."'> <br><br>

    <input type='reset' name='reset' value='Cancelar'>
    </form>");?>
    <input id='añadirComentarioBoton' type='button' value='Añadir comentario' onclick='addComentario()'>
    <?php   
    };
  ?>
  </div>




  <div id="div2" >
  <?php 
   $ListaComentarios .= '<table id="comentarios" style="margin-left: 200px;">
   <tr>
      <th colspan="2">Comentarios</th>
   </tr>';


   $xml = simplexml_load_file("../xml/comentarios.xml");
   if ($xml === false) {
    echo "Couldn't load file\n";
    exit (1);
  }
  $i=0;
   foreach ($xml->children() as $comentario){
     if($comentario['Id']==$_GET['id']){
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
  ?></div>


  </body>
  </html>