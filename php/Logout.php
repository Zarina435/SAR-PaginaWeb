<?php
    #Borramos la variable de sesion
    session_start();
    session_unset();
    session_destroy();

    #Mediante un alert de despedida redireccionamos al usuario a la pagina principal(Index.php)
    echo "<script> alert('Hasta luego usuario');
                        window.location.href='../php/Index.php';
                        </script>";
?>