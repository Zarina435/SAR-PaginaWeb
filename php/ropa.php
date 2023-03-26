<?php     session_start();?>
<!--Definiciones necesarias-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" type="text/css" href="../style/ropa.css" />
    <title>OASIS</title>
    <?php include("../php/DbConfig.php") ?>
  </head>
  <body>
  <?php

    #Si el usuario esta logeado se le mostrara en la barra superior los links necesarios para hacer Logout, sino, le aparecera los de Login y Register
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

    <!--Menu vertical donde podras seleccionar que tipo de prendas quieres visualizar-->
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
    <div id="titulo">
      <h1 class="titulo">Catálogo</h1>
    </div>

    <?php
      if(isset($_GET['genero']) || isset($_GET['parte'])) {
        echo("<table id='tabla1'>
        ");
        ## Variables GET. Comprabacion
        ## Dependiendo de la variable GET, se hará una query SQL distinta
        if(isset($_GET['genero']) && isset($_GET['parte'])) { ## Se especifica GENERO y PARTE
          $genero = $_GET['genero'];
          $parte = $_GET['parte'];
          $query = "SELECT Id,Nombre, Precio, Foto FROM ropa WHERE Genero = '".$genero."' AND Parte = '".$parte."'";
        }
        elseif(isset($_GET['genero'])) { # Enseñar toda la ropa del GENERO especificado
          $genero = $_GET['genero'];
          $query = "SELECT Id,Nombre, Precio, Foto FROM ropa WHERE Genero = '".$genero."'";
        }
        elseif(isset($_GET['parte'])) {  # Enseñar la ropa de la PARTE especificada
          $parte = $_GET['parte'];
          $query = "SELECT Id,Nombre, Precio, Foto FROM ropa WHERE Parte = '".$parte."'";
        }

        ## Iniciar link con la BD
        $link = mysqli_connect($server, $user, $pass, $basededatos);
        if(!$link) {
          echo("<p class='errorMsg'>Error al conectar con la base de datos</p>");
        }
        $resultado = mysqli_query($link, $query);

        ##Creamos la tabla con la ropa especificada en la query
        $i=0;
        while($row = mysqli_fetch_array($resultado)) {
        if($i==0){echo("<tr>");}
         echo("<td>

             <div id='foto'>
             <div class='cuadrado'>");
             echo   '
             <a href="../php/prenda.php?id='.$row['Id'].'">
             <img src="data:image/jpeg;base64,'.base64_encode ($row['Foto']).'"height="302"; width="302";/>
             </a>';
               
             echo ("</div>
               <br>
               <div class='descripcion'>
                 <b> ".$row['Nombre']."</b>
                 <p>".$row['Precio']."</p>
               </div>
             </div>
           </td>");
           if($i==2){echo("<tr>");
             $i=0;}
           else{$i++;}
       }
        echo("
        </table>");
        mysqli_close($link);
      }else{

        ##Esto solo se ejecutara cuando entres a ropa.php a secas, donde se cargara toda la ropa de la BD
        $query = "SELECT Id,Nombre, Precio, Foto FROM ropa";

         ## Iniciar link con la BD
         $link = mysqli_connect($server, $user, $pass, $basededatos);
         if(!$link) {
           echo("<p class='errorMsg'>Error al conectar con la base de datos</p>");
         }
         $resultado = mysqli_query($link, $query);
         
         ##Creamos la tabla que contiene toda la ropa
         echo("<table id='tabla1'>
         ");

         $i=0;
         while($row = mysqli_fetch_array($resultado)) {
         if($i==0){echo("<tr>");}
          echo("<td>

              <div id='foto'>
              <div class='cuadrado'>");
              echo   '
              <a href="../php/prenda.php?id='.$row['Id'].'">
              <img src="data:image/jpeg;base64,'.base64_encode ($row['Foto']).'"height="302"; width="302";/>
              </a>';
                
              echo ("</div>
                <br>
                <div class='descripcion'>
                  <b> ".$row['Nombre']."</b>
                  <p>".$row['Precio']."</p>
                </div>
              </div>
            </td>");
            if($i==2){echo("<tr>");
              $i=0;}
            else{$i++;}
        }
        echo("</table>");
        mysqli_close($link);
      }
    ?>
  </body>
</html>