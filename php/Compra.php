<!--Definiciones necesarias-->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" type="text/css" href="../style/compra.css" />
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/ConfirmarCompra.js"></script>
    <?php include("../php/DbConfig.php");?>
    <title> Comprar en OASIS </title>
  </head>
  <body>
    <?php ## Código PHP que se encarga de linkear con la base de datos y obtener el producto que se ha clickado de la tienda. c
      if(isset($_POST['idProducto'])) {
        $id = $_POST['idProducto'];
        $link = mysqli_connect($server, $user, $pass, $basededatos);
        $query = "SELECT Nombre, Precio, Foto FROM ropa WHERE Id = '".$id."'";
        $resultado = mysqli_query($link, $query);
        if($row = mysqli_fetch_array($resultado)) {
          $nombre = $row['Nombre'];
          $precio = $row['Precio'];
          $foto = $row['Foto'];
        }
      }
      else { ## Si se accede a esta página desde la url, se redirecciona al Index.php
        header("Location: ../php/Index.php");
      }
    ?>
    <br>
    <!--Creación del div-->
    <div class="titulo">
      <!--Título-->
        <h1> Realizar Compra</h1>
    </div>
    <hr>
    <br>
    <br>
    <div id="block-container">
      <!--Creación de la tabla-->
      <table class="tablaNovedades">
        <tr>
          <td>
            <div id="foto">
              <div class="cuadrado">
                <!--Imagen de la prenda-->
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode ($foto).'"height="220" width="220"/>';?>
              </div>
              <br>
            </div>
          </td>
        </tr>
      </table>
      <div id="cajaConfirmacion"> <!-- DIV que contiene la información del producto a comprar y el botón para comprarlo -->

        <h2>DATOS DEL PRODUCTO</h2>
        <p><b>Nombre del produto:</b> <?php echo($nombre); ?></p>
        <p><b>Precio:</b> <?php echo($precio); ?></p>
        <a id="comprarButton" href="#">Comprar artículo</a>
      </div>
      <div id="cajaLoading">  <!-- DIV que contiene el mensaje de confirmación y de agradecimiento al cliente -->

        <h2>Compra realizada satisfactoriamente</h2>
        <p>¡Muchas gracias por confiar en Oasis!</p>
      <!--Imagen de carga-->
      </div>
      <img id="loading" src="../src/loading.gif">
    </div>
      <br>
      <br>
      <!--Pie de la página estático-->
    <div class="footer">
      <p id="footerTexto"> <b> <i> Copyright@ 2021 OASIS, Todos los Derechos Reservados </i> </b></p>
    </div>
  </body>
</html>