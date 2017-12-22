<?php
  include_once('includes/templates/header.php')
?>

        <section class="seccion contenedor">
            <h2>La mejor conferencia de diseño web en español</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ipsam iste fugiat sapiente, atque dolore alias omnis ratione. Ducimus impedit vel soluta distinctio, neque dolor optio quo quam aliquid, rem itaque sapiente voluptates quia quidem officia ullam rerum ipsam magnam minus cumque debitis tenetur sint. Corporis vero consectetur dolor tenetur.</p>
        </section><!--Seccion descripcion-->

        <section class="programa">
            <div class="contenedor-video">
                <video autoplay loop poster="img/bg-talleres.jpg" >
                   <source src="video/video.mp4" type="video/mp4">
                   <source src="video/video.webm" type="video/webm">
                   <source src="video/video.ogv" type="video/ogg">
                </video>
            </div><!--Contenedor-Video-->

            <div class="contenido-programa">
                <div class="contenedor">
                    <div class="programa-evento">
                        <h2>Programa del Evento</h2>

                      <!---
                      #Creando codigo php para seleccionar las diferentes opciones del menu del programa evento
                      #Modificaciòn menu
                      #Auto: Sebastian Ramirez leyva
                      -->
                    <?php
                    try {

                      include_once "includes/funciones/db_conexion.php";
                      $sql = "SELECT * FROM `categoria_evento`";
                      $respuesta = $con->query($sql);
                    } catch (Exception $e) {
                       $error = $e->getMessage();
                    }
                     ?>
                        <nav class="menu-evento">
                          <?php while ($programa = $respuesta->fetch_array(MYSQLI_ASSOC)) { ?>

                                <?php $categoria = $programa['cat_evento']?>
                                <a href="#<?php echo strtolower($categoria);?>">
                                  <i class="fa <?php echo $programa['icon'] ?>" ></i>
                                  <?php echo $programa['cat_evento']?>
                                </a>

                          <?php } ?>
                            <!--<a href="#talleres"><i class="fa fa-code" aria-hidden="true"></i>Talleres</a>
                            <a href="#conferencias"><i class="fa fa-comment" aria-hidden="true"></i>Conferencias</a>
                            <a href="#seminarios"><i class="fa fa-university" aria-hidden="true"></i>Seminarios</a>-->
                        </nav><!--menu-evento-->

                        <?php
                        //MULTIPLES CONSULTAS CON PHP
                        try {
                          include_once "includes/funciones/db_conexion.php";
                          $sql = "SELECT `nombre_evento`, `hora_evento`, `fecha_evento` ,`nombre_invitado` ,`apellido_invitado` ,`cat_evento`
                                  FROM `eventos`
                                  INNER JOIN `categoria_evento` ON eventos.id_cat_evento=categoria_evento.id_categoria
                                  INNER JOIN  `invitados` ON eventos.id_inv_evento=invitados.id_invitados
                                  AND eventos.id_cat_evento = 1
                                  ORDER BY `id_evento` LIMIT 2;

                                  SELECT `nombre_evento`, `hora_evento`, `fecha_evento` ,`nombre_invitado` ,`apellido_invitado` ,`cat_evento`
                                  FROM `eventos`
                                  INNER JOIN `categoria_evento` ON eventos.id_cat_evento=categoria_evento.id_categoria
                                  INNER JOIN  `invitados` ON eventos.id_inv_evento=invitados.id_invitados
                                  AND eventos.id_cat_evento = 2
                                  ORDER BY `id_evento` LIMIT 2;

                                  SELECT `nombre_evento`, `hora_evento`, `fecha_evento` ,`nombre_invitado` ,`apellido_invitado` ,`cat_evento`
                                  FROM `eventos`
                                  INNER JOIN `categoria_evento` ON eventos.id_cat_evento=categoria_evento.id_categoria
                                  INNER JOIN  `invitados` ON eventos.id_inv_evento=invitados.id_invitados
                                  AND eventos.id_cat_evento = 3
                                  ORDER BY `id_evento` LIMIT 2;

                                  SELECT `nombre_evento`, `hora_evento`, `fecha_evento` ,`nombre_invitado` ,`apellido_invitado` ,`cat_evento`
                                  FROM `eventos`
                                  INNER JOIN `categoria_evento` ON eventos.id_cat_evento=categoria_evento.id_categoria
                                  INNER JOIN  `invitados` ON eventos.id_inv_evento=invitados.id_invitados
                                  AND eventos.id_cat_evento = 4
                                  ORDER BY `id_evento` LIMIT 2; ";




                        } catch (Exception $e) {
                          $error = $e->getMessage();
                        }
                        ?>

                        <?php $con->multi_query($sql); ?>


                        <?php do {?>

                          <!--Creando Variables -->
                          <?php

                            $resultado = $con->store_result();
                            $row = $resultado->fetch_all(MYSQLI_ASSOC);

                          ?>
                              <?php $contador = 0?>
                              <?php foreach ($row as $evento): ?>
                                <?php if ($contador % 2 == 0): ?>
                                  <div id="<?php echo strtolower($evento['cat_evento']); ?>" class="info-curso ocultar clearfix">
                                <?php endif; ?>
                                    <div class="detalle-evento">
                                        <h3><?php echo utf8_encode($evento['nombre_evento']); ?></h3>
                                        <p><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo $evento['hora_evento']?> hrs</p>
                                        <p><i class="fa fa-calendar" aria-hidden="true"></i><?php echo $evento['fecha_evento']?> </p>
                                        <p><i class="fa fa-user" aria-hidden="true"></i><?php echo $evento['nombre_invitado']." ". $evento['apellido_invitado']?> </p>
                                    </div><!--Detalle-evento-->


                                  <?php if ($contador % 2 == 1): ?>
                                    <a href="invitado.php" class="button float-right" >Ver Todos</a>
                                    </div><!--Talleres-->
                                  <?php endif; ?>

                                <?php $contador++; ?>
                              <?php endforeach; ?>
                              <?php $resultado->free();?>
                        <?php }while ($con->more_results() && $con->next_result());?>

                        <!--
                        <div id="" class="info-curso ocultar clearfix">
                            <div class="detalle-evento">
                                <h3></h3>
                                <p><i class="fa fa-clock-o" aria-hidden="true"></i> hrs</p>
                                <p><i class="fa fa-calendar" aria-hidden="true"></i> </p>
                                <p><i class="fa fa-user" aria-hidden="true"></i> </p>
                            </div><Detalle-evento
                            <a href="#" class="button float-right" >Ver Todos</a>
                        </div><!Talleres

                        <div id="conferencias" class="info-curso ocultar clearfix">
                            <div class="detalle-evento">
                                <h3>Como ser un Freenlacer</h3>
                                <p><i class="fa fa-clock-o" aria-hidden="true"></i>10:00 hrs</p>
                                <p><i class="fa fa-calendar" aria-hidden="true"></i>10 de Dic</p>
                                <p><i class="fa fa-user" aria-hidden="true"></i>Gregorio Sanchez</p>
                            </div><!Detalle-evento

                            <div class="detalle-evento">
                                <h3>Tecnlogías del Futuro</h3>
                                <p><i class="fa fa-clock-o" aria-hidden="true"></i>17:00 hrs</p>
                                <p><i class="fa fa-calendar" aria-hidden="true"></i>10 de Dic</p>
                                <p><i class="fa fa-user" aria-hidden="true"></i>Susan Sanchez</p>
                            </div><!Detalle-evento
                            <a href="#" class="button float-right" >Ver Todos</a>
                        </div><!conferencias

                        <div id="seminarios" class="info-curso ocultar clearfix">
                            <div class="detalle-evento">
                                <h3>Diseñor IU/UX móviles</h3>
                                <p><i class="fa fa-clock-o" aria-hidden="true"></i>17:00 hrs</p>
                                <p><i class="fa fa-calendar" aria-hidden="true"></i>11 de Dic</p>
                                <p><i class="fa fa-user" aria-hidden="true"></i>Sebastian Ramirez</p>
                            </div><!Detalle-evento

                            <div class="detalle-evento">
                                <h3>Aprende a programar en una mañana</h3>
                                <p><i class="fa fa-clock-o" aria-hidden="true"></i>10:00 hrs</p>
                                <p><i class="fa fa-calendar" aria-hidden="true"></i>11 de Dic</p>
                                <p><i class="fa fa-user" aria-hidden="true"></i>Edisney Garcia</p>
                            </div><!Detalle-evento
                            <a href="#" class="button float-right" >Ver Todos</a>
                        </div><!Seminarios-->

                    </div><!--Programa evento-->
                </div><!--contenedor-->
            </div><!--Contenido-programa-->
        </section><!--programa-->

        <!---Seccion Invitados------------------>
          <?php include_once "includes/templates/invitado.php" ;?>
        <!--------------------------------------------------->
        <!--<section class="invitados contenedor seccion">
            <h2>Nuestros Invitados</h2>
            <ul class="lista-invitados clarfix">
                <li>
                    <div class="invitado">
                        <img src="img/invitado1.jpg" alt="">
                        <p>Rafael Bautista</p>
                    </div>
                </li>
                <li>
                    <div class="invitado">
                        <img src="img/invitado2.jpg" alt="">
                        <p>Shari Herrera</p>
                    </div>
                </li>
                <li>
                    <div class="invitado">
                        <img src="img/invitado3.jpg" alt="">
                        <p>Gregorio Sanchez</p>
                    </div>
                </li>
                <li>
                    <div class="invitado">
                        <img src="img/invitado4.jpg" alt="">
                        <p>Susana Rivera</p>
                    </div>
                </li>
                <li>
                    <div class="invitado">
                        <img src="img/invitado5.jpg" alt="">
                        <p>Harold Garcia</p>
                    </div>
                </li>
                <li>
                    <div class="invitado">
                        <img src="img/invitado6.jpg" alt="">
                        <p>Susana Sanchez</p>
                    </div>
                </li>
            </ul><!lista Invitado
        </section><!Seccion Invitados-->

        <div class="contador parallax">
            <div class="contenedor">
                <ul class="resumen-evento clearfix">
                    <li><p class="numero">6</p>Invitados</li>
                    <li><p class="numero">15</p>Talleres</li>
                    <li><p class="numero">3</p>Días</li>
                    <li><p class="numero">9</p>Conferencias</li>
                </ul>
            </div>
        </div>

        <section class="precios seccion">
            <h2>precios</h2>
            <div class="contenedor">
               <ul class="lista-precios clearfix">
                  <li>
                      <div class="tabla-precio">
                          <h3>Pase por día</h3>
                          <p class="numero">$30</p>
                          <ul>
                              <li>Bocadillos Gratis</li>
                              <li>Todas las Conferencias</li>
                              <li>Todos los Talleres</li>
                          </ul>
                          <a href="" class="button hollow">Comprar</a>
                      </div>
                  </li>
                   <li>
                      <div class="tabla-precio">
                          <h3>Todos los días</h3>
                          <p class="numero">$50</p>
                          <ul>
                              <li>Bocadillos Gratis</li>
                              <li>Todas las Conferencias</li>
                              <li>Todos los Talleres</li>
                          </ul>
                          <a href="" class="button">Comprar</a>
                      </div>
                  </li>
                  <li>
                      <div class="tabla-precio">
                          <h3>Pase por 2 días</h3>
                          <p class="numero">$45</p>
                          <ul>
                              <li>Bocadillos Gratis</li>
                              <li>Todas las Conferencias</li>
                              <li>Todos los Talleres</li>
                          </ul>
                          <a href="" class="button hollow">Comprar</a>
                      </div>
                  </li>
               </ul>
            </div>
        </section>

        <div id="mapa" class="mapa"></div>

        <section class="seccion">
            <h2>testimoniales</h2>
            <div class="testimoniales contenedor clearfix">
                <div class="testimonial">
                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam provident, nulla aliquam, earum ipsum quam, quaerat vitae vel totam blanditiis facere rem nesciunt dolorum iusto reprehenderit perspiciatis dolor amet voluptas?</p>
                        <footer class="info-testimonial clearfix" >
                            <img src="img/testimonial.jpg" alt="imgaen testimonial">
                            <cite>Osvaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
                        </footer><!--Footer-->
                    </blockquote><!--blockquote-->
                </div><!--Testimonial-->
                <div class="testimonial">
                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam provident, nulla aliquam, earum ipsum quam, quaerat vitae vel totam blanditiis facere rem nesciunt dolorum iusto reprehenderit perspiciatis dolor amet voluptas?</p>
                        <footer class="info-testimonial clearfix" clearfix>
                            <img src="img/testimonial.jpg" alt="imgaen testimonial">
                            <cite>Osvaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
                        </footer><!--Footer-->
                    </blockquote><!--blockquote-->
                </div><!--Testimonial-->
                <div class="testimonial">
                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam provident, nulla aliquam, earum ipsum quam, quaerat vitae vel totam blanditiis facere rem nesciunt dolorum iusto reprehenderit perspiciatis dolor amet voluptas?</p>
                        <footer class="info-testimonial clearfix" clearfix>
                            <img src="img/testimonial.jpg" alt="imgaen testimonial">
                            <cite>Osvaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
                        </footer><!--Footer-->
                    </blockquote><!--blockquote-->
                </div><!--Testimonial-->
            </div><!--Testimoniales-->
        </section><!--Seccion-->

        <div class="newsletter parallax">
            <div class="contenido contenedor">
                <p>Regístrate al NewsLetter</p>
                <h3>gdlWebCam</h3>
                <a href="#mc_embed_signup" class="boton_newsletter button transparente">Registro</a>
            </div><!--contenido contenedor-->
        </div><!--Newsltter-->

        <section class="seccion">
            <h2>Faltan</h2>
            <div class="cuenta-regresiva contenedor">
                <ul class="clearfix">
                    <li><p id="dias" class="numero"></p>Días</li>
                    <li><p id="horas" class="numero"></p>Horas</li>
                    <li><p id="minutos" class="numero"></p>Minutos</li>
                    <li><p id="segundos" class="numero"></p>Segundos</li>
                </ul><!--clearfix-->
            </div><!--Cuenta-regresiva-->
        </section><!--seccion-->


<?php
  include_once('includes/templates/footer.php')
?>
