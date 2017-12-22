<?php
if (isset($_POST['submit'])) {
  session_start(); //Iniciar una nueva sesión o reanudar la existente
  $usuario = $_POST['usuario'];
  $password = $_POST['password'];


  //Recorriendo la base de datos y comparando el usuario para dar acceso
  try {
    require_once "includes/funciones/db_conexion.php";
    $stmt =$con->prepare( "SELECT * FROM  admins WHERE usuario_admin = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($id, $nombre_usuario, $password_usuario);
    while ($stmt->fetch()) {
      if (password_verify($password,$password_usuario)) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['id'] = $id;
        header('Location:admin_area.php');
      }else {
        $resultado = "<div class='mensaje error'> Nombre de usuario o constraseña incorrectas</div>";
      }
    }
    $stmt->close();
    $con->close();
  } catch (Exception $e) {
    $Error = $e->getMessage();
  }


}





?>

<?php  include_once "includes/templates/header.php" ?>

  <section class="seccion contenedor">
    <h2>Iniciar Sesión</h2>

    <form class="login" action="login.php" method="post">
      <div class="campo">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" placeholder="Tu usuario">
      </div>
      <div class="campo">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Tu password">
      </div>
      <div class="campo">
        <input type="submit" name="submit" class="button" value="Iniciar sesión">
      </div>
    </form>

    <?php echo $resultado; ?>

  </section>




<?php  include_once "includes/templates/footer.php" ?>
