<?php
  session_start();
  include_once "includes/funciones/funciones.php";
  usuario_autenticado();
?>

<?php include_once("includes/templates/header.php") ?>



  <section class=" seccion admin contenedor">
    <h2>Registrados</h2>
    <p>Bienvenido <?php echo $_SESSION['usuario']; ?></p>
    <?php include_once "includes/templates/admin_nav.php"; ?>

    <?php //creando menu para mirar los usuarios que pagaron y quienes no ?>
    <p>Filtros:</p>
    <nav id="filtros">
      <a id="pagados" href="#">Pagado</a>
      <a id="no_pagados"  href="#">No pagado</a>
    </nav>

    <table class="registrados">
      <thead>
        <tr >
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Registro</th>
          <th>Articulos</th>
          <th>Regalo</th>
          <th>Total Pagado</th>
          <th>Pagado</th>
        </tr>
      </thead>
      <tbody>
        <?php
            try {

              require_once "includes/funciones/db_conexion.php";
              $sql = "SELECT * FROM `registrados` INNER JOIN `regalos` ON registrados.regalo=regalos.id_regalo";
              $respuesta = $con->query($sql);

              while ($registros = $respuesta->fetch_assoc()){ ?>

                  <tr class="<?php  echo $registros['pagado'] ? 'pagado' : 'no_pagado' ?>" >
                    <td><?php echo $registros['id_registrado']; ?></td>
                    <td><?php echo $registros['nombre_registrado'] ." " . $registros['apellido_registrado'] ; ?></td>
                    <td><?php echo $registros['email_registrado']; ?></td>
                    <td>
                      <?php

                        $fecha = $registros['fecha_registro'];
                        //formateando fecha con la funcion date
                        echo date('jS, F, Y H:i', strtotime($fecha)); //convierte un string a un formato de fecha y le puede pasar cualquier parametro de fecha


                       ?>
                    </td>
                    <td><?php
                        $articulos = $registros['pases_articulos'];
                        $pedido = formatear_pedido($articulos);
                        echo $pedido;

                    ?></td>

                    <td><?php echo $registros['nombre_regalo']; ?></td>
                    <td><span>$</span><?php echo $registros['total_pagado']; ?></td>
                    <td>
                      <?php if ($registros['pagado'] == 1) {
                        echo "<span><i class='fa fa-check fa-2x' aria-hidden='true'></i></span>";
                      }else{
                        echo "<span><i class='fa fa-times fa-2x' aria-hidden='true'></i></span>";
                      }?>


                    </td>

                  </tr>
                  <tr >

                    <td colspan="7" >
                      <strong>Eventos Registrados:</strong> <br>
                      <?php
                        $eventos = $registros['talleres_registrados']; //eventos que han escojido cada una de los registrados
                        $sql = formatear_eventos_sql($eventos);
                        $evento_registrado = $con->query($sql);

                        while ($eventos = $evento_registrado->fetch_assoc()) {
                          foreach ($eventos as $evento) {
                            echo utf8_encode($evento.", ");
                          }
                        }


                      ?>
                    </td>
                  </tr>

              <?php }


            $con->close();
            } catch (Exception $e) {
              $Error = $e->getMessage();
            }
         ?>


      </tbody>
    </table>

  </section>


<?php include_once("includes/templates/footer.php") ?>
