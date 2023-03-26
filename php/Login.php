<?php
    session_start();
    if(isset($_SESSION['user'])) {
        include_once("../html/Desconocido.html");
        exit();
    }
?>
<!--Definiciones necesarias-->
<head>
    <meta charset="UFT-8">
    <link rel="stylesheet" href="../style/login.css">
    <?php include_once "DbConfig.php"?>
</head>
<body>
    <!--Título-->
    <div id="titulo">
        <h1 class="titulo">Iniciar sesión</h1>
    </div>
    <!--Formulario-->
    <form id="LoginForm" method="POST" action="../php/Login.php">
        <div id="prueba">
            <label for="email">Correo Electrónico</label>
            <input type="text" id="Email" name="email">
            <br>
            <label for="passwd">Contraseña</label>
            <input type="password" id="Passwd" name="passwd">
            <br>
            <input type="submit" id="BtnSubmit" name="btnSubmit" value="Log In!">
        </div>
    </form>
<!--Barra estática superior-->
    <div class="topBar">
        <ul>
            <li><a id="OASIS_topbar"    href="Index.php">Home</a>      </li>
            <li><a id="OASIS2_topbar"   href="../php/about.php">About</a>      </li>
            <li><a id="login_topbar"    href="../php/Login.php">Login</a>      </li>
            <li><a id="register_topbar" href="Register.php">Register</a></li>
        </ul>
    </div>
      <br>
      <br>
      <!--Menú estático de la zona izquierda-->
      <div class="tienda">
        <ul id="listatienda" class="listatienda">
            <li class="dropdown"><a href="#" class="dropbtn">Hombre</a>
              <div class="dropdown-content">
                <a href="#">Sudaderas</a>
                <a href="#">Pantalones</a>
              </div>
            </li>
            <li class="dropdown"><a href="#" class="dropbtn">Mujer</a>
              <div class="dropdown-content">
                <a href="#">Sudaderas</a>
                <a href="#">Pantalones</a>
              </div>
            </li>
            <li id="li1"><a href="#">Accesorios</a></li>
            <li id="li1"><a href="#">Zapatos</a></li>
        </ul>
      </div>
</body>
<?php
    if(isset($_POST['btnSubmit'])) {
        $error = 2;
        ## Comprobacion de email
        if(isset($_POST['email']) && $_POST['email'] != "") {
            $email = $_POST['email'];
            $error = $error - 1;
        }
        ## Comprobación de contraseña
        if(isset($_POST['passwd']) && $_POST['passwd'] != "") {
            $passwd = $_POST['passwd'];
            $error = $error - 1;
        }
        ## Operaciones en la base de datos
        if($error == 0) {

            #Se conecta a la base de datos
            $link = mysqli_connect($server, $user, $pass, $basededatos);
            if(!$link) {
                die("Fallo al conectar a MySQL: " .mysqli_connect_error());
            }

            #Operación SQL para conseguir datos del usuario
            $query = "SELECT Email, Contraseña, Nombre FROM usuarios WHERE Email = '" . $email . "'";
            $resultado = mysqli_query($link, $query);
            if(!$row = mysqli_fetch_array($resultado)) {
                echo("<p class='errorMsg'>Datos incorrectos</p>");
            }
            else {
                $passwd_bd = $row['Contraseña'];
                if(hash_equals($passwd_bd, crypt($passwd, 'Oasis'))) {
                    $_SESSION['user'] = $row['Email'];
                    $_SESSION['name'] = $row['Nombre'];
                    echo "<script>console.log('Debug Objects: ".$_SESSION['user']."' );</script>";

                    if($_SESSION['user']=="administrador"){
                        echo "<script> alert('Bienvenido admin');
                        window.location.href='../php/AñadirRopa.php';
                        </script>";
                    }else{

                    echo "<script> alert('Has iniciado sesion correctamente');
                        window.location.href='../php/Index.php';
                        </script>";}
                }
                else {
                    echo("<p class='errorMsg'>Datos incorrectos</p>");
                }
            }
            mysqli_close($link);
        }
        else {
            echo("<p class='errorMsg'>Por favor, rellene el formulario</p>");
        }
    }
?>