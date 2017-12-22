<?php
  session_start();
  include_once "includes/funciones/funciones.php";
  usuario_autenticado();

  if (isset($_POST['submit'])):
    $categoria = $_POST['categoria'];
    $icono = $_POST['icono'];

    try {
      require_once "includes/funciones/db_conexion.php";
      $stmt = $con->prepare("INSERT INTO categoria_evento (cat_evento,icon) VALUES (?,?)");
      $stmt->bind_param('ss',$categoria, $icono);
      $stmt->execute();
      $stmt->close();
      $con->close();
      header('Location: login.php');
    } catch (Exception $e) {
      echo $error = $e->getMessage();
    }

  endif;


?>
<?php include_once "includes/templates/header.php" ?>

  <section class="seccion admin contenedor">
    <h2>Agregar Categoria Evento</h2>

    <?php include_once "includes/templates/admin_nav.php" ?>

    <form class="categoria" action="agregar_categoria.php" method="post">

      <div class="campo">
        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" id="categoria" placeholder="Nombre categoria">
      </div>

      <div class="campo">
        <label for="icono">Icono:</label>
        <input type="text" name="icono" id="icono" placeholder="Nombre icono">
      </div>

      <div class="campo">

        <input type="submit" name="submit" class="button" id="submit" value="Agregar">
      </div>

    </form>
    <?php if (isset($_GET['exitoso'])): ?>
      <?php
        echo "<div mensaje>";
          echo "la Categoria se agrego correctamente";
        echo "</div>";
      ?>
    <?php endif ?>


  </section>



<?php include_once "includes/templates/footer.php" ?>
