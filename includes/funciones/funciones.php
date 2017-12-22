<?php
/**
 * Function para convertir variables a JsonSerializable
 * se realiza el paso por referencia mediante le asnperzan junto su variable
 *@Autor Sebastian Ramirez
 */

function productos_json(&$boletos,&$camisas = 0,&$etiquetas = 0){

    $dias = array(0 => 'un_dia' , 1 => 'pase_completo', 2 => 'pase_2dias');
    $total_boletos = array_combine($dias, $boletos);
    $json = array();

    foreach ($total_boletos as $key => $boletos):
      //convertir string a intero
      if((int) $boletos > 0):
        //guardando array asociativo
        $json[$key] = (int) $boletos;
      endif;

    endforeach;

    //Validando campos camisas y etiquetas, combirtiendo un strign a entero y asignandolo al array
    $camisas = (int) $camisas;
    $etiquetas = (int) $etiquetas;

    if ($camisas > 0):
      $json['camisas'] = $camisas;
    endif;

    if ($etiquetas > 0):
      $json['etiquetas'] = $etiquetas;
    endif;
    //retornando json
    return json_encode($json);
}

function formatear_pedido(&$articulos){

  $articulos = json_decode($articulos, true); //me lo convierte a un array asosiativo
  $pedido = '';

  if (array_key_exists('un_dia', $articulos)):
    $pedido .= "Pase(s) 1 día:". $articulos['un_dia'] . "<br>";
  endif;

  if (array_key_exists('pase_2dias', $articulos)):
    $pedido .= "Pase(s) 2 día:". $articulos['pase_2dias'] . "<br>";
  endif;

  if (array_key_exists('pase_completo', $articulos)):
    $pedido .= "Pase(s) completos:". $articulos['pase_completo'] . "<br>";
  endif;

  if (array_key_exists('camisas', $articulos)):
    $pedido .= "Camisas:". $articulos['camisas'] . "<br>";
  endif;

  if (array_key_exists('etiquetas', $articulos)):
    $pedido .= "Etiquetas:". $articulos['etiquetas'] . "<br>";
  endif;

  return $pedido;


}

/**
 * Function para convertir variables a JsonSerializable
 * se realiza el paso por referencia mediante le asnperzan junto su variable
 *@Autor Sebastian Ramirez
 */


 function eventos_json(&$eventos){

   $evento_json = array();

   foreach ($eventos as $evento){
     $evento_json['eventos']= $eventos;
   }

   return json_encode($evento_json);

 }





function formatear_eventos_sql($eventos){
  $eventos = json_decode($eventos, true); //lo convierte el conteidno json a array
  $sql = "SELECT `nombre_evento` FROM eventos WHERE clave = 'a' ";


  foreach($eventos['eventos'] as $evento):
    $sql .= " OR clave = '{$evento}'";
  endforeach;

  return $sql;

}


function usuario_autenticado(){
  if (!revisar_usuario()){
    header('Location:login.php');
  }
}

function revisar_usuario(){
  return isset($_SESSION['usuario']);
}

?>
