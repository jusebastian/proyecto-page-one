                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php

  require_once 'includes/paypal.php';

  //importando conexion de credenciales con paypal
  //validando campos
  if (!isset($_POST['submit'])) {
    exit("Hubo un error!!");
  }

//importar las clases en php con namespace
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

  if(isset($_POST['submit'])):

      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $email = $_POST['email'];
      $regalo = $_POST['regalo'];
      $total = $_POST['total_pedido'];
      //$boletos = $_POST['boletos'];
      $fecha = date('Y-m-d H:i:s');
      //Pedidos
      $boletos = $_POST['boletos'];
      $numeroBoletos = $boletos;
      $pedidoExtras = $_POST['pedido_extras'];
      $camisas = $_POST['pedido_extras']['camisas']['cantidad'];
      $precioCamisas = $_POST['pedido_extras']['camisas']['precio'];
      $etiquetas = $_POST['pedido_extras']['etiquetas']['cantidad'];
      $precioEtiquetas = $_POST['pedido_extras']['etiquetas']['precio'];
      include_once 'includes/funciones/funciones.php';
      $pedido = productos_json($boletos, $camisas, $etiquetas);
      //Eventos
      $eventos = $_POST['registro'];
      $registro = eventos_json($eventos);
      try {
        include_once("includes/funciones/db_conexion.php");
        $stms = $con->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado,email_registrado,fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado)
                              VALUES (?,?,?,?,?,?,?,?)");
        $stms->bind_param("ssssssis", $nombre , $apellido, $email, $fecha, $pedido, $registro , $regalo, $total);
        $stms->execute();
        $ID_registro = $stms->insert_id;
        $stms->close();
        $con->close();
        //header('Location: validar_registro.php?exitoso=1');
      } catch (Exception $e) {
        $error = $e->getMessage();
      }

  endif;


//creando objeto e instanciando la clase o construirto payer  y llamamos al metodoº
$compra = new Payer();
$compra->setPaymentMethod('paypal'); //llamado metodo de la clse payer con argumento pypal que sera el unico medio de pago

//agregando segunda clases
//le pasamos por parametro al funcione setname el producto

$articulo = new Item();
$articulo->setName($producto)
         ->setCurrency('MXN')
         ->setQuantity(1)
         ->setPrice($precio);

$i = 0; //variable para contador global
$pedido_Arreglo = array(); //agregando arreglos para obtener diferentes key con diferentes cantidades
foreach ($numeroBoletos as $key => $value) {
  if((int)$value['cantidad'] > 0) {

    ${"articulo$i"} = new Item();
    $pedido_Arreglo[] = ${"articulo$i"};
    ${"articulo$i"}->setName('Pase:' . $key)
                   ->setCurrency('MXN')
                   ->setQuantity((int)$value['cantidad'])
                   ->setPrice((int)$value['precio']);
    $i++;
  }
}



foreach ($pedidoExtras as $key => $value) {

  if ($key == 'camisas') {
    $pedido = (float)$value['precio'] * .93;
  }else{
    $pedido = (int)$value['precio'] ;
  }



  if((int)$value['cantidad'] > 0){
    ${"articulo$i"} = new Item();
    $pedido_Arreglo[] = ${"articulo$i"};
    ${"articulo$i"}->setName('Extras:' . $key)
                   ->setCurrency('MXN')
                   ->setQuantity((int)$value['cantidad'])
                   ->setPrice($pedido);
    $i++;
  }
}



//echo $articulo3->getName();

//obtiene el arreglo donde contiene todos los articulos seleccionados
$listaArticulo = new ItemList();
$listaArticulo->setItems($pedido_Arreglo); //ingresamo la lista de los articulos


//Funcion cantidad de productos
$cantidad = new Amount();
$cantidad->setCurrency('MXN')
         ->setTotal($total); //si le mandamos el valor del precio y le sumamos un valor superior a cero este no lo va a tomar puesto que estamos trabajando con dos variable
         //el valor del envio y el precio  por lo tanto tendria que enviar el valor total puesto que en detalles estamos enlazando la variable precio y envio


$transaccion = new Transaction();
$transaccion->setAmount($cantidad)
           ->setItemList($listaArticulo) //todo los artiuclos que se va apagar
           ->setDescription('Pago ') //aparece cuando se realiza el pago
           ->setInvoiceNumber($ID_registro); //pasa el numero de tranferencia guragria e registro de la base de datos de la persona que esta pagando



//echo $transaccion->getInvoiceNumber();


//redireccionar la pagina una vez se envie el pago
$redireccionar = new RedirectUrls();
$redireccionar->setReturnUrl(URL_SITIO . "pago_finalizado.php?exitoso=true&id_pago={$ID_registro}");//se redigije despues de aprobar los pagos de paypal
$redireccionar->setCancelUrl(URL_SITIO . "pago_finalizado.php?exitoso=false&id_pago={$ID_registro}");

$pago = new Payment();
$pago->setIntent("sale")
     ->setPayer($compra)
     ->setRedirectUrls($redireccionar)
     ->setTransactions(array($transaccion));

     try{
       //creando el pago para paypal
       $pago->create($apiContext); //enlazando credenciales

     }catch(PayPal\Exception\PayPalConnectionException $pce){
        echo "<pre>";
        print_r(json_decode($pce->getData()));
        exit;
        echo "</pre>";
     }

$aprobado = $pago->getApprovalLink();

header("Location: {$aprobado}");



 ?>
