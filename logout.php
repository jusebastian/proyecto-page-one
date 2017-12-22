<?php
  session_start();
  require_once "includes/funciones/funciones.php";
  usuario_autenticado();
?>

<?php

    require_once "includes/funciones/db_conexion.php";
    unset($_SESSION['usuario']);
    unset($_SESSION['id']);
    session_destroy();
    header('Location: login.php');
    exit;

 ?>
