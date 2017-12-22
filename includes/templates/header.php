<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>GDLWEBCAM</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">

        <?php
          $archivo = basename($_SERVER['PHP_SELF']);
          $pagina = str_replace(".php", "", $archivo);
          if ($pagina == 'invitado' || $pagina == 'index' ) {
            echo'<link rel="stylesheet" href="css/colorbox.css">';
          }else if($pagina == 'conferencia'){
            echo'<link rel="stylesheet" href="css/lightbox.css">';
          }
        ?>

        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Oswald|PT+Sans" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body class="<?php echo $pagina;  ?>">
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

       <header class="site-header">
           <div class="hero">
               <div class="contenido-header">
                   <nav class="redes-sociales">
                       <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                       <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                       <a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                       <a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                       <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                   </nav><!--Redes-Sociales-->
                   <div class="session">
                     <a href="login.php">Login</a>
                   </div>
                   <div class="informacion-evento">
                       <div class="clearfix">
                         <p class="fecha"><i class="fa fa-calendar" aria-hidden="true"></i>10-12 Dic</p>
                         <p class="ciudad"><i class="fa fa-map-marker" aria-hidden="true"></i>Colombia</p>
                       </div>
                         <h1 class="nombre-sitio">GdlWebCam</h1>
                         <p class="slogan">la mejor conferencia de <span>diseño web</span></p>
                   </div><!-- .informacion-evento-->
               </div><!--contenido-header-->
           </div><!--Hero-->
       </header><!--.Site Header-->

        <div class="barra">
            <div class="contenedor  clearfix">
                <div class="logo">
                    <a href="index.php"><img src="img/logo.svg" alt=""></a>
                </div><!--Logo-->

                <div class="menu-movil">
                   <span></span>
                   <span></span>
                   <span></span>
                </div><!--Menu principal-->

                <nav class="navegacion-principal  clearfix ">
                    <a href="conferencia.php">Conferencia</a>
                    <a href="calendario.php">Calendario</a>
                    <a href="invitado.php">Invitado</a>
                    <a href="registro.php">Reservaciones</a>
                </nav><!--Navegacion Principal-->

            </div><!--Contenedor-->
        </div><!--Barra-->
