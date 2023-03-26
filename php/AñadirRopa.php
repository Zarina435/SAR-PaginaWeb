<?php

    #Comprobamos que es el administrador, sino se le redirecciona a Index.php
    session_start();
    if(!isset($_SESSION['user']) || $_SESSION['user'] != "administrador"){
      header("Location: ../php/Index.php");
    }
?>

<!--Definiciones necesarias-->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../style/añadirRopa.css" />

</head>
<body>
<!--Creación de la barra estática superior-->
<div class="topBar">
          <ul>
          <li><a id="register_topbar" href="../php/Logout.php">Logout</a></li>
          </ul>
          </div>
  <?php include '../php/DbConfig.php' ?>
  
  <?php

$errores = '';
$precioError='';
$nombreError='';
$retrocederPag='';

if (isset($_POST['submit'])){
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];


        
        //Check for nombre 
        if(strlen($nombre)<=0){
            $nombreError .="El nombre tiene el formato incorrecto " ;
            $errores = 'Error';}

        //Check for precio 
        if(strlen($precio)<=0){
            $precioError .="El apellido tiene el formato incorrecto " ;
            $errores = 'Error';}
          
          //Check for precio 
          if(strlen($descripcion)<=0){
            $errores = 'Error';}

       
        //Check for IMG
        if($_FILES['file']['size'] == 0){
            $errorImg="No hay IMG";
            $errores = 'Error';
        }

        if( $errores ==''){
           //Conect to DB
           $conn = mysqli_connect($server, $user, $pass, $basededatos);
           //Check for connection error
           if(!$conn) die("Fallo al conectar MySQL:". mysqli_connect_error());
          
           //Escogemos la ultima id
            $getLastID="SELECT * FROM ropa where Id = (SELECT MAX(Id) FROM ropa)";
            
            $result = mysqli_query($conn, $getLastID);
            $row = mysqli_fetch_assoc($result);


          //Sentencia con la nueva informacion de la ropa a insertar
          $Id=$row["Id"]+1;
          $image = addslashes(file_get_contents($_FILES['file']['tmp_name']));
          $insert = "INSERT INTO ropa (Id,Nombre,Precio,Foto,Genero,Parte,Descripcion)
          VALUES ('$Id','$nombre','$precio','$image','$_POST[genero]','$_POST[parte]','$descripcion')";
         
           
            

            if(mysqli_query($conn,$insert)){
              $mensaje = "Se ha realizado la operacón de forma correcta";
              echo "<script>";
              echo "if(confirm('$mensaje'));";  
              echo "window.location = './AñadirRopa.php';";
              echo "</script>"; 
            }else{
              $mensaje = "Ha ocurrido algun error en la operación, vuelva a intentarlo";
              echo "<script>";
              echo "if(confirm('$mensaje'));";  
              echo "window.location = './AñadirRopa.php';";
              echo "</script>"; 
        }

        

            mysqli_close($conn);
        }else{
     
          $previous = "javascript:history.back()";
          $retrocederPag='Ir atrás';
          
        }
    
}
    ?>
    <!--Formulario para añadir ropa a la base de datos-->

  <section class="main" id="s1"  style="text-align:left;">
    <div id=formularioAddRP>

    <h3><span style='text-decoration: underline'>Añadir ropa</span> </h3>
      
      
      <form method="post" name="AddRopa" action="AñadirRopa.php" enctype="multipart/form-data">

       
        <label for="nombre">Nombre: </label>
        <input type="text" id="nombre" name="nombre" >  <span style='color: red'><?php echo $nombreError ?></span>   <br>  

        <label for="precio">Precio: </label>
        <input type="text" id="precio" name="precio"   > <span style='color: red'><?php echo $precioError ?></span><br>  

        <label for="genero">Genero: </label>  
        <input type="radio"  id="mujer" name="genero" value="mujer" checked>
        <label for="mujer">Mujer</label>
        <input type="radio" id="hombre" name="genero" value="hombre">
        <label for="hombre">Hombre</label> <br>

        <label for="parte">Parte: </label>  
        <input type="radio"  id="sudaderas" name="parte" value="sudaderas" checked>
        <label for="sudaderas">Sudaderas</label>
        <input type="radio" id="pantalones" name="parte" value="pantalones">
        <label for="pantalones">Pantalones</label>
        <input type="radio" id="zapatos" name="parte" value="zapatos">
        <label for="zapatos">Zapatos</label>
        <input type="radio" id="accesorios" name="parte" value="accesorios">
        <label for="accesorios">Accesorios</label> <br>
        
        <label for="descripcion">Descripcion: </label>
        <input type="text" id="descripcion" name="descripcion" >    <br>  

        <input type="file" name="file" id="inpFile" onchange="getImagePreview(event)"><br>           
        

        <input type="submit" name="submit" id="submit" value="Enviar solicitud"><br>
        <input type="button" value="Borrar imagen" onclick="resetImgFile()" ><br>
        <input type="reset" name="reset" value="Reset"><br>
        
        
        
        
      </form>
      <br>

      <div id="preview" ></div>
      <script languaje="JavaScript" src="../js/ShowImageInForm.js"></script>

 
      
      
      <a href="<?= $previous ?>"><?php echo $retrocederPag ?></a>

     
      

    </div>
    
    
  </section>

  
</body>
</html>