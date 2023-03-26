<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <!--Definiciones necesarias-->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" type="text/css" href="../style/about.css" />
    <title> About OASIS </title>
  </head>
  <body>
  <?php

    #Si el usuario esta logeado se le mostrara en la barra superior los links necesarios para hacer Logout, sino, le aparecera los de Login y Register
    if(isset($_SESSION['user'])) {
      echo ('<div class="topBar">
      <ul>
          <li><a id="OASIS_topbar"    href="Index.php">Home</a>                </li>
          <li><a id="OASIS2_topbar"   href="about.php">About</a>      </li>
          <li><a id="register_topbar" href="Logout.php">Logout</a></li>
      </ul>
      </div>');
    }else{
   echo ('<div class="topBar">
        <ul>
            <li><a id="OASIS_topbar"    href="Index.php">Home</a>                </li>
            <li><a id="OASIS2_topbar"   href="about.php">About</a>      </li>
            <li><a id="login_topbar"    href="Login.php">Login</a>      </li>
            <li><a id="register_topbar" href="Register.php">Register</a></li>
        </ul>
    </div>');}
    ?>
    <br>
    <br>
    <br>
    <br>
    <!--Texto que aparece en la página-->
    <div class="quien">
        <h1 id="titulo"> <i>Qui&eacute;nes somos</i> </h1>
        <h2 id="titulo2"> Desde 2001, porque somos j&oacute;venes </h2>
    </div>
    <br>
    <br>
    <div class="textoQ">
        <p id="textoQuien">Fusce pellentesque urna sollicitudin arcu ullamcorper, eu condimentum lectus vestibulum. Cras id lacus purus. Nulla magna justo, dignissim vulputate auctor at, dapibus quis nibh. Etiam non nisi magna. Praesent bibendum lectus sed mollis finibus. Nulla nec massa in velit convallis viverra. Proin euismod ligula ante, nec eleifend turpis sagittis nec. Aenean laoreet porta eros ultricies pulvinar. Morbi pretium nibh ut est lacinia eleifend. Vestibulum ac nisi vel nisl pellentesque faucibus sed at tortor. In sagittis condimentum arcu dictum tincidunt.</p>
    </div>
    <br>
    <br>
    <div class="porque">
        <h1 id="tituloSub"> <i>Por qu&eacute; lo hacemos</i> </h1>
        <h2 id="titulo2"> Queremos aprobar </h2>
    </div>
    <br>
    <br>
    <div class="textoQ">
        <p id="textoQuien">In ac est maximus, finibus orci ac, bibendum nunc. Nam in purus tempor, ultricies nisl vel, efficitur nisl. Integer nec nibh hendrerit, tempus est vel, pharetra mauris. Sed accumsan nibh sit amet enim varius sodales. Aliquam venenatis in mauris non placerat. Maecenas pellentesque non massa faucibus euismod. Aliquam risus leo, tincidunt ac venenatis vel, ullamcorper non massa. Nulla suscipit placerat elit, non sodales diam malesuada in. Sed efficitur maximus tellus vel maximus.</p>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="footer">
        <p id="footerTexto"> <b> <i> Copyright@ 2021 OASIS, Todos los Derechos Reservados </i> </b></p>
    </div>
  </body>
</html>
