<?php
session_start();
if (!isset($_SESSION["loggedin"])  || $_SESSION["loggedin"] !== true){
  header("location: index.php");
  exit;
}
  ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>Bienvenido</title>
  <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

  <div class="contenedor-welcome">
    <img src="" alt="" class="logo-welcome">
    <h1 class="title-welcome">Bienvenido </h1>
    <a href="conexiones/close_session.php" class="close-sesion">Cerrar sesión</a>


  </div>


</body>

</html>