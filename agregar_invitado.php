<?php

//NOTA: con multipart/form-data nos permite exponer diferente tipo de informaciòn
  session_start();
  require_once "includes/funciones/funciones.php";
  usuario_autenticado();

  if(isset($_POST['submit'])):
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $descripcion = $_POST['descripcion'];

    $directorio = "img";
                                                        //se pasa al directorio u ubicación nuevo
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], __DIR__.$directorio.$_FILES['imagen']['name'])){
      $imagen_url = $_FILES['imagen']['name'];
      $resultado = "Se agrego correctamente";

    try {
      require_once("includes/funciones/db_conexion.php");
      $stmt = $con->prepare("INSERT INTO invitados (nombre_invitado, apellido_invitado, descripcion, url_imagen) VALUES (?,?,?,?)");
      $stmt->bind_param("ssss",$nombre, $apellido, $descripcion, $imagen_url);
      $stmt->execute();
      $stmt->close();
      $con->close();
      header('Location:agregar_invitado.php?exitoso=1');
    } catch (Exception $e) {
      $Error = $e->getMessage();
    }


    }
    echo "<pre>";
    var_dump($_FILES);
    echo "</pre>";
  endif;

?>

<?php include_once "includes/templates/header.php" ?>
  <section class="seccion admin contenedor">
    <h2>Panel Agregar invitado</h2>
    <p>Bienvenido <?php echo $_SESSION['usuario']; ?> </p>

    <?php include_once "includes/templates/admin_nav.php"; ?>

    <form class="invitado" action="agregar_invitado.php" method="post" enctype="multipart/form-data">

      <div class="campo">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre..." required>
      </div>
      <div class="campo">
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" placeholder="Apellido..." required>
      </div>
      <div class="campo">
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" id="descripcion" required></textarea>
      </div>

      <div class="campo">
        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" class="imagen" id="imagen" rows="8" col="8" required>
      </div>

      <div class="campo">
        <input type="submit" name="submit" class="button" value="Agregar">
      </div>


    </form>

    <?php if (isset($_GET['exitoso']) == 1):?>
      <?php
      echo "<div class='mensaje'>";
        echo "El contenido se almacenó correctamente";
      echo "</div>";
      ?>

    <?php endif; ?>





  </section>
<?php  include_once "includes/templates/footer.php" ?>
