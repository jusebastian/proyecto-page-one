<?php
  session_start();
  require_once 'includes/funciones/funciones.php';
  usuario_autenticado();

?>

<?php include_once "includes/templates/header.php"; ?>

    <section class="seccion admin contenedor">
      <h2>Crear Administradores</h2>
      <?php include_once "includes/templates/admin_nav.php"; ?>
        <form class="login_admin" action="crear_admin.php" method="post">
            <div class="campo">
              <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" placeholder="Tu Usuario">
            </div>

            <div class="campo">
              <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" placeholder="Tu Contraseña">
            </div>
            <div class="campo">
              <input type="submit" name="submit" class="button" value="Crear">
            </div>
        </form>


        <?php

          //validando boton submit
          if (isset($_POST["submit"])) {

            if (isset($_POST['usuario'])) {
              $usuario = $_POST['usuario'];
            }
            if (isset($_POST['password'])) {
              $password = $_POST['password'];
            }

            /*if($usuario == ""){
              echo "Debe ingresar el Usuario en el campo";
            }else if(strlen($usuario) < 8){
              echo "Debe ingresar 8 mas caracteres";
            }*/

            //Metodo de incripción de datos mas seguros--------
            $opciones = array(
              'cost' => 12,
              'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
            );


            //--------------------------------------------------

            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            try {
              if($usuario != "" and $hashed_password != ""){
                require_once('includes/funciones/db_conexion.php');
                $stmt = $con->prepare("INSERT INTO admins (usuario_admin, pass_admin) VALUES (?,?)");
                $stmt->bind_param("ss",$usuario, $hashed_password);
                $stmt->execute();
                if($stmt->error){
                  echo "<div class='mensaje error'>";
                  echo "Error, al amacenar los datos";
                  echo "</div>";
                }else{
                  echo "<div class='mensaje'>";
                  echo "El usuario se registro Correctamente";
                  echo "</div>";
                }
                $stmt->close();
                $con->close();
              }else{
                echo "<div class='mensaje'>Debe ingresar datos en los campos</div>";
              }
            } catch (Exception $e) {
               echo "Error:". $e->getMessage();
            }

          }
        ?>

    </section>
<?php include_once "includes/templates/footer.php"; ?>
