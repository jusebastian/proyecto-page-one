  <footer class="site-footer">
     <div class="contenedor clearfix">
         <div class="footer-informacion">
            <h3>sobre<span>gdlwebcam</span></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi numquam rerum distinctio dolores illo quae sunt, impedit quia nam voluptates quod reprehenderit. Alias atque quisquam optio molestiae, modi perferendis perspiciatis.</p>
         </div>
         <div class="ultimos-tweets">
             <h3>ültimos<span>Tweets</span></h3>
             <a class="twitter-timeline" href="https://twitter.com/juseranew">Tweets by juseranew</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
         </div>
         <div class="menu">
             <h3>redes<span>sociales</span></h3>
              <nav class="redes-sociales">
                 <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                 <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                 <a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                 <a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                 <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
             </nav><!--Redes-Sociales-->

         </div>
     </div>

     <p class="copyright">
         Todos los derechos Reservados GLDWEBCAM 2017.
     </p>

     <!---New Lines--->
           <!-- Begin MailChimp Signup Form -->
      <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
      <style type="text/css">
      	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
      	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
      	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
      </style>
      <div style="display:none">
        <div id="mc_embed_signup">
        <form action="//website.us16.list-manage.com/subscribe/post?u=cf73ad20b0504f0bb674d48df&amp;id=7a2a3e4de0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
        	<h2>Suscribete a nuestro Newsletter</h2>
        <div class="indicates-required"><span class="asterisk">*</span> Campo requerido</div>
        <div class="mc-field-group">
        	<label for="mce-EMAIL">Correo electronico <span class="asterisk">*</span>
        </label>
        	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
        </div>
        	<div id="mce-responses" class="clear">
        		<div class="response" id="mce-error-response" style="display:none"></div>
        		<div class="response" id="mce-success-response" style="display:none"></div>
        	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_cf73ad20b0504f0bb674d48df_7a2a3e4de0" tabindex="-1" value=""></div>
            <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
            </div>
        </form>
        </div>
        <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
        <!--End mc_embed_signup-->
      </div>


  </footer>

  <!-- Add your site or application content here -->
  <!---<p>Hello world! This is HTML5 Boilerplate.</p>-->

  <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script src="js/main.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.lettering.js"></script>


  <?php
    $archivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php", "" , $archivo);
    if($pagina == 'invitado' || $pagina == 'index'){
      echo '<script src="js/jquery.colorbox-min.js"></script>';
    }else if($pagina == 'conferencia'){
      echo  '<script src="js/lightbox.js"></script>';
    }
  ?>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAomh8Os8Z5_QZwBtwdxRiHPQ4H5PNkhrc&callback=initMap" async defer></script>

  <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
  <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='https://www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X','auto');ga('send','pageview');
  </script>

  <script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/signup-forms/popup/embed.js"
  data-dojo-config="usePlainJson: true, isDebug: false"></script>
 <script type="text/javascript">require(["mojo/signup-forms/Loader"], function(L)
   { L.start({"baseUrl":"mc.us16.list-manage.com","uuid":"cf73ad20b0504f0bb674d48df","lid":"2f808ecead"}) })
 </script>





  </body>
</html>
