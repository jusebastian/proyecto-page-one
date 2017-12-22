<?php
    include_once('includes/templates/header.php')
?>

  <section class=" seccion contenedor">
    <h2>Calendario de Eventos</h2>
    <?php
    try {
      require_once('includes/funciones/db_conexion.php');

       //UTILIZANDO UN INNER JOIN PARA RELACIONAR LAS TABLAS CON EL VALOR REAL
      $sql = "SELECT `id_evento`,`nombre_evento`, `fecha_evento`,`hora_evento`,`cat_evento`,`nombre_invitado`,`apellido_invitado` FROM `eventos`
       INNER JOIN `categoria_evento` ON eventos.id_cat_evento=categoria_evento.id_categoria
       INNER JOIN `invitados` ON eventos.id_inv_evento=invitados.id_invitados
       ORDER BY `id_evento`";
      $resultado = $con->query($sql);


    } catch (Exception $e) {
      $error = $e->getMessage();
    }

     ?>

<?php  #ME SELECCIONA TODOS LOS DATOS EN UN SOLO ARRAY Y NO POR SEPARADO COMO EL FETCH_ASSOC() DONDE ME DEJA LOS DATOS ASSOCIADOS CON UNA LLAVE Y VALOR?>

    <div class="calendario">

       <?php while($eventos = $resultado->fetch_all(MYSQLI_ASSOC)) { ?>
         <!--Array indexado-->
         <?php $day = array();?>

         <?php foreach ($eventos as $evento) {
            $day[] = $evento['fecha_evento'];
         }?><!--.fin foreach-->

         <!--ASIGNANDO VALORES UNICOS E IRREPETIBLES-->
         <?php $dayArray = array_values(array_unique($day)); ?>
         <?php $contador = 0 ; ?>

        <?php foreach($eventos as $evento):?>

          <?php $dayEvento = $evento['fecha_evento']; ?>
            <?php if($dayEvento == $dayArray[$contador]): ?>
                <h3>
                  <i class="fa fa-calendar" aria-hidden="true"></i>
                  <?php echo $evento['fecha_evento']; ?>
                </h3>
                <?php $contador++; ?> <!--.Contador-->
            <?php endif; ?> <!--.fin if-->

           <div class="presentacion ">

               <p class="titulo"><?php echo  utf8_encode($evento['nombre_evento'])?></p>
               <p class="hora"><i class="fa fa-clock-o" arian-hidden="true"></i><?php echo $evento['fecha_evento']." ". $evento['hora_evento']."hrs"?></p>

               <p>
                 <?php $categoria_evento = $evento['cat_evento']; ?>

                 <?php
                  //seleccionar una opcion
                  switch ($categoria_evento) {
                    case 'Talleres': echo '<i class="fa fa-code" aria-hidden="true"></i>Taller';break;
                    case 'Conferencias':echo '<i class="fa fa-comment" aria-hidden="true"></i>Conferencia';break;
                    case 'seminario': echo '<i class="fa fa-university" aria-hidden="true"></i>Seminario';break;
                    default: echo ""; break;
                  }
                 ?>
               </p>

               <p><i class="fa fa-user" aria-hidden="true"></i>
                 <?php echo $evento['nombre_invitado']."  ".$evento['apellido_invitado']; ?>
               </p>

           </div><!--.fin presentacion-->
        <?php endforeach; ?> <!--.Fin foreach-->
       <?php }?><!--.Fin while-->
    </div><!--.Calendario-->

    <?php $con->close(); ?>
  </section>


<?php
    include_once('includes/templates/footer.php')
?>
