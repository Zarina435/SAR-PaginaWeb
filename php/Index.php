<?php
    session_start();
?>
 <!--Definiciones necesarias-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" type="text/css" href="../style/index.css" />
    <?php include("../php/DbConfig.php"); ?>
    <title> OASIS </title>
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
     <!--Título-->
    <h1 id="oasisTitle"> <i> OASIS </i></h1>
    <?php
      $link = mysqli_connect($server, $user, $pass, $basededatos);
      $query = "SELECT Nombre, Precio, Foto FROM ropa WHERE Id = 10 OR Id = 17 OR Id = 23";
      $resultado = mysqli_query($link, $query);
      $cont = 1;
      while($row = mysqli_fetch_array($resultado)) {
        if($cont == 1) {
          $nombre1 = $row['Nombre'];
          $precio1 = $row['Precio'];
          $foto1 = $row['Foto'];
        }
        if($cont == 2) {
          $nombre2 = $row['Nombre'];
          $precio2 = $row['Precio'];
          $foto2 = $row['Foto'];
        }
        if($cont == 3) {
          $nombre3 = $row['Nombre'];
          $precio3 = $row['Precio'];
          $foto3 = $row['Foto'];
        }
        $cont = $cont + 1;
      }
    ?>
     <!--Barra estática en el lateral izquierdo-->
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
    <br>
     <!--Título novedades-->
    <h1 > Novedades </h1>
    <br>
    <br>
    <!--Tabla para poner fotos-->
    <table class="tablaNovedades">
      <tr>
        <td>
          <div id="foto1">
            <div class="cuadrado">
              <?php
                echo '<img src="data:image/jpeg;base64,'.base64_encode ($foto1).'"height="220" width="220"/>';
              ?>
            </div>
            <br>
            <div class="descripcion">
              <b id="nombrePrenda"><?php echo($nombre1); ?></b>
              <p id="precioPrenda"><?php echo($precio1); ?></p>
            </div>
          </div>
        </td>
        <td>
          <div id="foto2">
            <div class="cuadrado">
              <?php
                echo '<img src="data:image/jpeg;base64,'.base64_encode ($foto2).'"height="220" width="220"/>';
              ?>
            </div>
            <br>
            <div class="descripcion">
              <b id="nombrePrenda"><?php echo($nombre2); ?></b>
              <p id="precioPrenda"><?php echo($precio2); ?></p>
            </div>
          </div>
        </td>
        <td>
          <div id="foto3">
            <div class="cuadrado">
              <?php
                $row = mysqli_fetch_array($resultado);
                echo '<img src="data:image/jpeg;base64,'.base64_encode ($foto3).'"height="220" width="220"/>';
              ?>
            </div>
            <br>
            <div class="descripcion">
              <b id="nombrePrenda"><?php echo($nombre3); ?></b>
              <p id="precioPrenda"><?php echo($precio3); ?></p>
            </div>
          </div>
        </td>
      </tr>
    </table>
    <br>
    <br>
    <!--Título opiniones-->
    <h1 > Opiniones de vosotros, nuestros clientes </h1>
    <br>
    <br>
    <!--Tabla en la que se muestran los comentarios-->
    <table class="tablaComentarios">
      <tr>
        <td>
          <div id="comentario1">
            <p id="nombreUsuario"><i> Luciano </i></p>
            <div class="cuadradoComentario">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vitae efficitur nulla. Sed varius, leo quis rutrum tempor, sem neque porttitor dolor, eget faucibus ante leo id orci. Sed metus tortor, vestibulum non libero in.</p>
            </div>
            <br>
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <div id="comentario1">
            <p id="nombreUsuario"><i> Josu </i></p>
            <div class="cuadradoComentario">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed bibendum lacus diam, non sodales augue sodales eu. Suspendisse ultrices aliquam justo. Integer id nulla vitae mauris consequat eleifend nec quis justo. Quisque aliquet lectus sed.</p>
            </div>
            <br>
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <div id="comentario1">
            <p id="nombreUsuario"><i> Sara </i></p>
            <div class="cuadradoComentario">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam et ullamcorper est, sed egestas nisl. Proin lacus velit, aliquet non libero ut, accumsan vehicula ligula. Mauris accumsan sit amet dolor vel bibendum. Cras nunc lacus.</p>
            </div>
            <br>
          </div>
        </td>
      </tr>
    </table>
    <!--Pie de página estático-->
    <div class="footer">
        <p id="footerTexto"> <b> <i> Copyright@ 2021 OASIS, Todos los Derechos Reservados </i> </b></p>
    </div>
  </body>
</html>
