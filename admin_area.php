<?php
  session_start();
  //si el usuario no se ha registro que lo mande a la pagina de logeo
  //si no existe el logeo o la variable que lo redirija a la pagìna principal
  /*if (!isset($_SESSION['usuario'])):
    header('Location:login.php');
  endif;*/
  require_once 'includes/funciones/funciones.php';
  usuario_autenticado();
 ?>
<?php include_once "includes/templates/header.php" ?>

  <section class=" admin seccion contenedor">
    <h2>Panel de Administracón</h2>
    <p>Bienvenido <?php echo $_SESSION['usuario']; ?></p>

    <?php include_once "includes/templates/admin_nav.php"; ?>
  </section>



<?php include_once "includes/templates/footer.php" ?>
