<?php require_once "includes/templates/header.php" ?>

  <section class="seccion contenedor">
    <h2>Pagos con paypal</h2>

    <?php

      $resultado = $_GET['exitoso'];
      $id_pago  = (int) $_GET['id_pago'];


      if ($resultado == "true") {
        echo "El pago se realizó Correctamente <br>";
        echo "el ID es: ". $_GET['paymentId'];
        require_once("includes/funciones/db_conexion.php");
        $pagado ='1';
        $stms = $con->prepare("UPDATE registrados SET pagado = '$pagado' WHERE id_registrado = ? ");
        $stms->bind_param("i",  $id_pago);
        $ID_registro = $stms->insert_id;
        $stms->execute();
        $stms->close();
        $con->close();

      }else{
        echo "El pago no fue realizado <br>";
      }

    ?>

  </section>


<?php require_once "includes/templates/footer.php" ?>
