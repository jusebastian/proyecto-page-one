<?php include_once('includes/templates/header.php') ?>

<?php /**
 * Validando consulta
 * se valida para que cuando se realize un reset no cargue los datos que se han enviado y no haya duplicidad de datos o contenidos
 *@Autor Sebastian Ramirez
 */?>

 <?php if(isset($_POST['submit'])): ?>
     <?php
       $nombre = $_POST['nombre'];
       $apellido = $_POST['apellido'];
       $email = $_POST['email'];
       $regalo = $_POST['regalo'];
       $total = $_POST['total_pedido'];
       //$boletos = $_POST['boletos'];
       $fecha = date('Y-m-d H:i:s');
       //Pedidos
       $boletos = $_POST['boletos'];
       $camisas = $_POST['pedido_camisas'];
       $etiquetas = $_POST['pedido_etiquetas'];
       include_once 'includes/funciones/funciones.php';
       $pedido = productos_json($boletos, $camisas, $etiquetas);
       //Eventos
       $eventos = $_POST['registro'];
       $registro = eventos_json($eventos);
       try {
         include_once("includes/funciones/db_conexion.php");
         $stms = $con->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado,email_registrado,fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado)
                               VALUES (?,?,?,?,?,?,?,?)");
         $stms->bind_param("ssssssis", $nombre , $apellido, $email, $fecha, $pedido, $registro , $regalo, $total);
         $stms->execute();
         $stms->close();
         $con->close();
         header('Location: validar_registro.php?exitoso=1');
       } catch (Exception $e) {
         $error = $e->getMessage();
       }

     ?>



 <?php endif; ?>

<section class="seccion contenedor">
    <h2>Resumen Registro</h2>
    <?php if (isset($_GET['exitoso'])):
      if ($_GET['exitoso'] == '1') {
        echo "<div class='registro'>Registro Exitoso</div>";
      }
    endif; ?>

</section>

<?php include_once('includes/templates/footer.php') ?>
