<?php ## Comprobacion: Si el usuario ya se encuentra loggeado, que no se muestre la página de REGISTER.PHP
    session_start();
    if(isset($_SESSION['user'])) {
        include_once("../html/Desconocido.html");
        exit();
    }
?>
<!--Definiciones necesarias-->
<!DOCTYPE html>
<head>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/RegisterJQuery.js"></script>
    <link rel="stylesheet" href="../style/register.css">
    <?php include("../php/DbConfig.php");?>
</head>
<body>
    <!--Título-->
    <div id="titulo">
        <h1 class="titulo">Registro</h1>
    </div>
    <!--Formularia para registrarse-->
    <form id="formRegister" method="POST" action="../php/Register.php">
        <div id="prueba">
            <label for="email">Correo Electrónico*</label>
            <input type="text" id="email" name="email" placeholder="example@example.ex">
            <p class="errorMsg" id="forEmail"></p>
            <br>
            <label for="passwd">Contraseña*</label>
            <input type="password" id="passwd" name="passwd">
            <p class="errorMsg" id="forPasswd"></p>
            <br>
            <label for="confPasswd">Repetir contraseña*</label>
            <input type="password" id="confPasswd" name="passwd2">
            <p class="errorMsg" id="forConfPasswd"></p>
            <br>
            <label for="name">Nombre formal*</label>
            <input type="text" id="name" name="name">
            <br>
            <label for="surname1">Primer Apellido*</label>
            <input type="text" id="surname1" name="surname1">
            <br>
            <label for="surname2">Segundo Apellido*</label>
            <input type="text" id="surname2" name="surname2">
            <br>
            <p>Los campos con un * son obligatorios</p>
            <input type="submit" id="btn" name="submitBtn" value="Registrarse">
        </div>
    </form>
    <!--Barra estática superior-->
    <div class="topBar">
      <ul>
          <li><a id="OASIS_topbar"    href="../php/Index.php">Home</a>      </li>
          <li><a id="OASIS2_topbar"   href="../php/about.php">About</a>      </li>
          <li><a id="login_topbar"    href="../php/Login.php">Login</a>      </li>
          <li><a id="register_topbar" href="../php/Register.php">Register</a></li>
      </ul>
    </div>
      <br>
      <br>
      <!--Menú estático de la zona izquierda-->
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

</body>

<?php
    echo("<div id='cajaErrores'>");
    $errores = "";
    if(isset($_POST['submitBtn'])) {
        if(isset($_POST['email']) && $_POST['email'] != "") {
            $email = $_POST['email'];
            if(!preg_match('/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9_.-]+\.[a-zA-Z]+$/', $email)) {
                echo("<p class='errorMsg'>Errores: Formato de email no válido</p>");
            }
        }
        else {
            $errores = "a";
            echo("<p class='errorMsg'>Email es un campo obligatorio</p>");
        }
        if(isset($_POST['passwd']) && $_POST['passwd'] != "") {
            $passwd = $_POST['passwd'];
            if(strlen($passwd) <8) {
                $errores = "a";
                echo("<p class='errorMsg'>La contraseña tiene que tener un mínimo de 8 caracteres</p>");
            }
        }
        else {
            $errores = "a";
            echo("<p class='errorMsg'>Contraseña es un campo obligatorio</p>");
        }
        if(isset($_POST['passwd2']) && $_POST['passwd2'] != $_POST['passwd']) {
            $errores = "a";
            echo("<p class='errorMsg'>Las contraseñas no coindicen</p>");
        }
        if(isset($_POST['name']) && $_POST['name'] != "") {
            $name = $_POST['name'];
        }
        else {
            $errores = "a";
            echo("<p class='errorMsg'>Nombre es un campo obligatorio</p>");
        }
        if(isset($_POST['surname1']) && $_POST['surname1'] != "") {
            $surname1 = $_POST['surname1'] . " ";
        }
        else {
            $errores = "a";
            echo("<p class='errorMsg'>Primer apellido es un campo obligatorio</p>");
        }
        if(isset($_POST['surname2']) && $_POST['surname2'] != "") {
            $surname2 = $_POST['surname2'];
        }
        else {
            $errores = "a";
            echo("<p class='errorMsg'>Segundo apellido es un campo obligatorio</p>");
        }
        if(isset($_POST['image']) && $_POST['image'] != "") {
            $image = $_POST['image'];
        }

        if($errores == "") {
            $apellidos = $surname1 . $surname2;
            $hashedPasswd = crypt($passwd, 'Oasis');
            #Se conecta a la base de datos
            $link = mysqli_connect($server, $user, $pass, $basededatos);
            #Operación SQL para insertar
            $sql="INSERT INTO usuarios(Email, Contraseña, Nombre, Apellidos) 
            VALUES ('$email', '$hashedPasswd', '$name', '$apellidos')";
            if (!mysqli_query($link ,$sql)) {
                echo ("<p class='errorMsg'>Error inesperado a la hora de ingresar tus datos. Vuelve a intentarlo</p>");
                echo "errno de depuracion: " . mysqli_connect_errno() . PHP_EOL;
                echo "<br>";
                echo "errno de depuracion: " . mysqli_connect_error() . PHP_EOL;
                die('Error: ' . mysqli_error($link));
            }
            echo("<script>alert('Se han enviado tus datos correctamente');</script>");
            mysqli_close($link);
        }
    }
    echo("</div>");
?>