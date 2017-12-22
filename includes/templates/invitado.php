<?php

try {
    include 'includes/funciones/db_conexion.php';
    $sql = "SELECT * FROM invitados";
    $respuesta = $con->query($sql);
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>

<section class="invitados contenedor seccion">
<h2>Nuestros Invitados</h2>
<ul class="lista-invitados clarfix">
  <?php  while($invitados = $respuesta->fetch_assoc() ) { ?>
    <li>
        <div class="invitado">
          <!--Agregado link interno  img --->
            <a class="info-invitado" href="#invitado<?php echo $invitados['id_invitados']; ?>">
              <img src="img/<?php echo $invitados['url_imagen']; ?>" alt="">
              <p><?php echo $invitados['nombre_invitado']." ". $invitados['apellido_invitado']; ?></p>
            </a>
        </div>
    </li>

    <!--Creando ColorBOX para hacer modal mediante php y Plugin ColorBOX-->
    <div style="display:none;">
        <div class="info-invitado" id="invitado<?php echo $invitados['id_invitados'];?>">
            <h2><?php echo $invitados['nombre_invitado']." ". $invitados['apellido_invitado']; ?></h2>
            <img src="img/<?php echo $invitados['url_imagen']; ?>" alt="">
            <p><?php echo $invitados['descripcion'];?></p>
        </div>
    </div>

  <?php }?>
</ul>

<?php $con->close(); ?>
</section>
