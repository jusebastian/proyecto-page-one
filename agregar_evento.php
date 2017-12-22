<?php
  session_start();
  require_once "includes/funciones/funciones.php";
  usuario_autenticado();

  if (isset($_POST['submit'])):

    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $id_categoria = $_POST['categoria'];
    $id_invitado = $_POST['invitado'];

    try {
      require_once "includes/funciones/db_conexion.php";
      $stmt = $con->prepare("SELECT cat_evento, COUNT(DISTINCT nombre_evento)
      FROM eventos
      INNER JOIN categoria_evento
      ON eventos.id_cat_evento=categoria_evento.id_categoria
      WHERE id_cat_evento = ? ");

      $stmt->bind_param('s', $id_categoria);
      $stmt->execute();
      $stmt->bind_result($categoria_evento,$total);
      $stmt->store_result();
      //Insertando los datos
      $stmts = $con->prepare("INSERT INTO eventos(nombre_evento,
                                                     fecha_evento,
                                                     hora_evento,
                                                     id_cat_evento,
                                                     id_inv_evento,
                                                     clave)
                              VALUES (?,?,?,?,?,?)");
      $stmt->fetch();//me muestra la respectiva informaciòn
      //convertir en un entero a total
      (int)$total = $total;
      $total++;
      $clave = strtolower(substr($categoria_evento, 0, 5)) . "_" . $total;
      $stmts->bind_param('ssssss', $nombre,$fecha,$hora,$id_categoria,$id_invitado,$clave);
      $stmts->execute();
      $stmts->close();
      $stmt->close();


      header('Location:agregar_evento.php?exitoso=1');
    } catch (Exception $e) {
      echo $error = $e->getMessage();
    }

  endif;



 ?>


<?php include_once "includes/templates/header.php"; ?>
  <section class="seccion admin contenedor">
    <h2>Registrar Eventos</h2>
    <p> Bievenvenido <?php echo $_SESSION['usuario']; ?></p>

    <?php include_once "includes/templates/admin_nav.php" ?>

    <form class="evento" action="agregar_evento.php" method="post">
      <div class="campo">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre Evento...">
      </div>
      <div class="campo">
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha">
      </div>
      <div class="campo">
        <label for="hora">Hora:</label>
        <input type="time" name="hora" id="hora" >
      </div>
      <div class="campo">
        <label for="Categoria">Categoria:</label>
        <?php try {
          require_once "includes/funciones/db_conexion.php";
          $sql = "SELECT * FROM `categoria_evento` ";
          $respuesta_evento = $con->query($sql);?>

          <?php while($eventos = $respuesta_evento->fetch_assoc()){ ?>
            <input type="radio" name="categoria" value="<?php echo $eventos['id_categoria']?>">
            <?php echo $eventos['cat_evento']?>
          <?php } ?>

        <?php } catch (Exception $e) {
          echo $Error = $e->getMessage();
        }
        ?>
      </div>

      <div class="campo">
        <label for="invitado">Invitado:</label>
        <?php try {
          require_once "includes/funciones/db_conexion.php";
          $sql = "SELECT `id_invitados`,`nombre_invitado`,`apellido_invitado` FROM `invitados` ";
          $respuesta_invitados = $con->query($sql);?>


            <select class="" name="invitado">
              <?php while($invitados = $respuesta_invitados->fetch_assoc()){ ?>
              <option value="<?php echo $invitados['id_invitados']; ?>">
                <?php echo $invitados['nombre_invitado']. " " . $invitados['apellido_invitado']; ?>
              </option>
              <?php } ?>
            </select>


        <?php } catch (Exception $e) {
          echo $Error = $e->getMessage();
        }
        ?>

      </div>
      <div class="campo">
        <input type="submit" name="submit" class="button" value="Agregar Evento">
      </div>
    </form>

    <?php if (isset($_GET['exitoso'])):?>
      <?php
      echo "<div class='mensaje'>";
        echo "El contenido se almacenó correctamente";
      echo "</div>";
      ?>
    <?php endif;?>



    <?php $con->close(); ?>
  </section>
<?php include_once "includes/templates/footer.php"; ?>
