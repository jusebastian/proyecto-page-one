<?php

  require_once 'includes/paypal/autoload.php';

  define('URL_SITIO','http://localhost:81/Desarrollo-web/gldWebCam_Original/'); //defino una variable con define variable
//instalando el SDK en la aplicación
$apiContext = new \PayPal\Rest\ApiContext(
      new \PayPal\Auth\OAuthTokenCredential(

          'AZ9y8j4RfZRBUhXO9vBZac83L11x6VQGl8HQherjQtQnL4CVLCoPHoZH8qkOATzmF7FZPfGxhphi7iMi',//cliente id
          'EEtr9f06vypVw7ttgNH0x8M7yiMuY6y7gIFqDdcYx7mvZgsYZsiyar5Uud0la7m_RVuUEwQUbGJPQLFQ'//Secret

        )

  );



?>
