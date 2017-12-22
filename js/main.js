 //Google maps
var api = 'AIzaSyD24nPAOgEYuYc21bCW2HeLLx1PVK1KvVc';

function initMap() {
    //Creando longitud
    var latlng = {

        lat: 2.9117893,
        lng: -75.2770491
    }

    var map = new google.maps.Map(document.getElementById('mapa'), {
        center: latlng,
        zoom: 10,
        //draggable:false,
    });

    //Cargar contenido
    var contenido = '<h2>GDLWEBCAM</h2>'+
                    '<p>Del 10 al 12 de Diciembre</p>'+
                    '<p>Visitanos!</p>';

    //creando objeto informacion
    var informacion = new google.maps.InfoWindow({
        content: contenido,
    });

    //Creando Pin (Marker)
    var marker = new google.maps.Marker({
        position:latlng,
        map:map,
        title:'GDLWEBCAM'
    });

    //Creando información en el pi
    marker.addListener('click', function(){
        informacion.open(map, marker); //abrir informacion
    });
}

/**
 *
 * @Autor Sebastian Ramirez
 */

(function(){
    //se ejecute el codigo javaScript
    "use strict";

    //Variable globales
    var regalo = document.getElementById('regalo');
    //Cargar escucha cuando el codigo html este cargado
    document.addEventListener('DOMContentLoaded', function(){

        //Datos usuarios
        var nombre = document.getElementById('nombre');
        var apellido = document.getElementById('apellido');
        var email = document.getElementById('email');

        //Campos pases
        var pase_dia = document.getElementById('pase_dia');
        var pase_dos_dias = document.getElementById('pase_dos_dias');
        var pase_completo = document.getElementById('pase_completo');

        //Butones y Divs
        var errorDiv = document.getElementById('error');
        var calcular = document.getElementById('calcular');
        var botonRegistro = document.getElementById('btn-registro');
        var lista_productos = document.getElementById('lista-productos');
        var suma = document.getElementById("suma-total");

        //Extras
        var etiquetas = document.getElementById('etiquetas');
        var camisas = document.getElementById('camisa-evento');



        //Dias
        /*var viernes = document.getElementById('viernes');
        var sabado  = document.getElementById('sabado');
        var domingo = document.getElementById('domingo');*/

        //escuchando mediante un click, dando click en esta ejecutará una función
        calcular.addEventListener('click', calcularMontos);

        pase_dia.addEventListener('blur', mostrarDias); //el evento blur obtiene el valor escrito y seleccionado por el usuario
        pase_dos_dias.addEventListener('blur', mostrarDias);
        pase_completo.addEventListener('blur', mostrarDias);
        //Formmulario registro de usuario
        nombre.addEventListener('blur',validarCampos);
        apellido.addEventListener('blur',validarCampos);
        email.addEventListener('blur',validarCampos);

        //Validar Email
        email.addEventListener('blur',validarEmail);

        //Desabilitar boton Pagar
        botonRegistro.disabled = true;






//=====================================================================================================================
//=====================================================================================================================
        /**
         *Funcion calcular Monto
         * Se realiza la vaidacion de campos
         * Se calcula los campos seleccionados
         * Se agregan los Valores a un array
         *@Autor Sebastian Ramirez
         *
         **/

        function calcularMontos(event){
            event.preventDefault();
            if(regalo.value == ''){
               alert("Seleccione algun regalo");
               regalo.focus();//se utiliza para dirigir el enfoque de un elemento
            }else{
                var boletoDia=parseInt(pase_dia.value, 10) || 0,
                boletoDosDias=parseInt(pase_dos_dias.value,10 )||0,
                boletoCompleto=parseInt(pase_completo.value, 10) || 0,
                cantidadEtiquetas = parseInt(etiquetas.value, 10) || 0,
                cantidadCamisas = camisas.value;

                var totalPagar = (boletoDia * 30)+(boletoDosDias * 45)+(boletoCompleto * 50)+((cantidadCamisas * 10)*.93)+(cantidadEtiquetas * 2);
                console.log("Total Pagar:"+totalPagar);

                var listaProductos = [];

                if(boletoDia>=1){
                    listaProductos.push(boletoDia + " Boletos por día");
                }
                if(boletoDosDias>=1){
                   listaProductos.push(boletoDosDias + " Boletos por dos Días");
                }

                if(boletoCompleto>=1){
                   listaProductos.push(boletoCompleto + " Boletos Completo");
                }

                if(cantidadEtiquetas>=1){
                   listaProductos.push(cantidadEtiquetas + " Etiquetas");
                }

                if(cantidadCamisas>=1){
                   listaProductos.push(cantidadCamisas + " Camisas");
                }

                //console.log(listaProductos);
                lista_productos.style.display = "block";
                lista_productos.innerHTML = ''; //limpia el contenido
                for(var i = 0; i< listaProductos.length; i++){
                    lista_productos.innerHTML += listaProductos[i] + "</br>";
                }

                suma.innerHTML = "$" + totalPagar.toFixed(2);//recorta los decimales

                //Desabilitando el boton registro
                botonRegistro.disabled = false;
                document.getElementById('total_pedido').value = totalPagar;



            }

        }

//============================================================================================================
//============================================================================================================


        /**
        * @Funcion mostrarDias
        *la funcion mostrar dias nos permie identificar los dias
        *par cuando se seleccione el boleto a comprar este despleglara los dias
        * que sera valido esta comprar.
        *@Autor: Sebastian Ramirez Leyva
        *


        **/

        function  mostrarDias(){

            var boletosDia=parseInt(pase_dia.value, 10) || 0,
                boletosDosDias=parseInt(pase_dos_dias.value,10 )||0,
                boletosCompleto=parseInt(pase_completo.value, 10) || 0;

            //creando Arreglo
            var diasElegidos = [];


            if(boletosDia > 0){
               diasElegidos.push('viernes');
               console.log(diasElegidos);
            }

            if(boletosDosDias > 0){
               diasElegidos.push('viernes','sabado');
               console.log(diasElegidos);
            }

            if(boletosCompleto > 0){
               diasElegidos.push('viernes','sabado','domingo');
               console.log(diasElegidos);
            }

            for(var i = 0; i < diasElegidos.length; i++){

                if(diasElegidos[i] == 0){
                    document.getElementById(diasElegidos[i]).style.display = "none";
                }else{
                    document.getElementById(diasElegidos[i]).style.display = "block";
                }

            }

        }

//==========================================================================================================
//==========================================================================================================
      /**
      * @Funcion Validar campos
      *la funcion mostrar dias nos permie identificar los dias
      *par cuando se seleccione el boleto a comprar este despleglara los dias
      * que sera valido esta comprar.
      *@Autor: Sebastian Ramirez Leyva
      *
      **/

        function validarCampos(){
            //validando campos
            if(this.value == ''){
               errorDiv.style.display = 'block';
               errorDiv.innerHTML = 'Campo Obligatorio';
               this.style.border ='1px solid #fe4819';
               errorDiv.style.border = '1px solid #fe4819';

            }else{
                errorDiv.style.display = 'none';
                this.style.border = '1px solid #33BBFF';

            }
        }
//==========================================================================================================
//==========================================================================================================
              /**
              * @Funcion Validar Email
              *la funcion mostrar dias nos permie identificar los dias
              *par cuando se seleccione el boleto a comprar este despleglara los dias
              * que sera valido esta comprar.
              *@Autor: Sebastian Ramirez Leyva
              *
              **/

        function validarEmail(){

            if(this.value.indexOf("@") > -1){
                errorDiv.style.display = 'none';
                this.style.border = '1px solid #33BBFF';
            }else{

               errorDiv.style.display = 'block';
               errorDiv.innerHTML = 'El correo electronico debe tener un @';
               this.style.border ='1px solid #fe4819';
               errorDiv.style.border = '1px solid #fe4819';
            }

        }



    });//DOM CONTENT LOADED
})();//función unico


 // CREANDO DOCUMENT READY CON JQUERY

$(function(){

  //==========================================================================================
    //creando un evento de filtros con query -> evento pago no pago
    $('#filtros > a').on('click', function(){
      $('#filtros a').removeClass('activo'); //quitarselo a todos los enlaces 
      $(this).addClass('activo');
      $('.registrados tbody tr').hide();

      if($(this).attr('id') == 'pagados'){
        $('.registrados tbody tr.pagado').show();
      }else{
        $('.registrados tbody tr.no_pagado').show();
      }

      return false;
    });


  //==========================================================================================




    //PROGRAMA DE CONFERENCIAS ===================================================================================================================

    //OCULTAR
    //$('div.ocultar').hide();

    $('.programa-evento .info-curso:first').show();
     $('.menu-evento a:first').addClass('activo');
    //TRABAJANDO MENU PROGRAMA EVENTO
    $('.menu-evento a').on('click', mostrarMenu);


    function mostrarMenu(){
        //cuando se da click se elimina la clase activo
        $('.menu-evento a').removeClass('activo');
        //
        $(this).addClass('activo');

        var enlace = $(this).attr('href');
        $('.ocultar').hide();//oculta la anterior
        $(enlace).fadeIn(1000); //mostrar documentación, en un segundo

        return false;
    }

    //============================================================================================================================================


    //UTILIZANDO PLUGIN PARA LA SECCION DE CONTEO NÚMEROS=================================================================================================



     $('.resumen-evento li:nth-child(1) p').animateNumber({number:6},2500);
     $('.resumen-evento li:nth-child(2) p').animateNumber({number:15},2500);
     $('.resumen-evento li:nth-child(3) p').animateNumber({number:3},2500);
     $('.resumen-evento li:nth-child(4) p').animateNumber({number:9},2500);


    //============================================================================================================================================


    //SECCION CUENTA REGRESIVA==========================================================================================================================
    $('.cuenta-regresiva').countdown('2017/11/10 09:00:00', function(event){
       //selecionamos los elementos que contiene la caja

        $('#dias').html(event.strftime('%D'));
        $('#horas').html(event.strftime('%H'));
        $('#minutos').html(event.strftime('%M'));
        $('#segundos').html(event.strftime('%S'));

    });
    //===================================================================================================================================================

    //Editando  texto con Jquery y plugin lettering==================================================================================================
    $('.nombre-sitio').lettering();
    //===============================================================================================================================================

    //CREANDO ANIMACION PARA NAVEGADOR ESTATICO DEPEDIENDO DEL SCROOL QUE SE HAGA====================================================================

    //Metodo para medir la altura de la ventana
    var windowHeight = $(window).height();
    //Medicion barra
    var barraHeigth = $('.barra').innerHeight();


    //Crenado metodo scrooll con pixelado de pantall o window,escucha mediante los scroll que se esten dando en la ventana
    $(window).scroll(function(){
        //scrolltop nos ayuda a dectectar el escrolling
        var scroll = $(window).scrollTop(); //ayuda a dectectar el scroll pincipal
        if(scroll > windowHeight){
           $('.barra').addClass('fixed');
           $('body').css({'margin-top':barraHeigth});
        }else{
            $('.barra').removeClass('fixed');
            $('body').css({'margin-top':'0px'});
        }
    });



    //===============================================================================================================================================

    //MOSTRAR MENU RESPONSIVE MEDIANLA FUNCION CLIC==================================================================================================

    $('.menu-movil').on('click', function(){
       $('.navegacion-principal').slideToggle();
    });



    //===============================================================================================================================================
    //APLICANDO COLORBOX DENTRO DE ARCHIVO INVITADOS PARA REALIZAR EL MODAL==========================================================================
      $('.info-invitado').colorbox({inline:true, width:"50%"});
      $('.boton_newsletter').colorbox({inline:true, width:"50%"});
    //===============================================================================================================================================

    //Creando ubicacion o enlace donde se encuentra en la pagina

    $('body.conferencia  .navegacion-principal a:contains("Conferencia")').addClass('activo');
    $('body.calendario  .navegacion-principal a:contains("Calendario")').addClass('activo');
    $('body.invitado  .navegacion-principal a:contains("Invitado")').addClass('activo');

    //================================================================================================================================================




});
