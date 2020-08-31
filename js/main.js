(function() {
    "use strict";

    var regalo = document.getElementById('regalo')

    document.addEventListener('DOMContentLoaded', function(){
        //console.log("Papas")

        //Campos Datos Usuario
        var nombre = document.getElementById('nombre');
        var apellido = document.getElementById('apellido');
        var email = document.getElementById('email');

        //Campos pases
        var pase_dia = document.getElementById('pase_dia');
        var pase_completo = document.getElementById('pase_completo');
        var pase_dosdias = document.getElementById('pase_dosdias');

        //Botones y divs
        var calcular = document.getElementById('calcular');
        var errorDiv = document.getElementById('error');
        var botonRegistro = document.getElementById('btnRegistro');
        var lista_productos = document.getElementById('lista-productos');
        var suma = document.getElementById('suma-total')

        //Extras
        var camisas = document.getElementById('camisa_evento');
        var etiquetas = document.getElementById('etiquetas')

        /*================================================================ */
        //Solución error
        if(document.getElementById('calcular')){

        calcular.addEventListener('click', calcularMontos);

        pase_dia.addEventListener('blur', mostrarDias)
        pase_dosdias.addEventListener('blur', mostrarDias)
        pase_completo.addEventListener('blur', mostrarDias)

        /*================================================================ *///Validación de información

        nombre.addEventListener('blur', validarCampos);
        apellido.addEventListener('blur', validarCampos);
        email.addEventListener('blur', validarCampos);
        email.addEventListener('blur', validarMail);

        function validarCampos(){
            if(this.value==''){
                errorDiv.style.display = 'block';
                errorDiv.innerHTML = "*Este campo es obligatorio";
                this.style.border = '1px solid red';
                errorDiv.style.border = '1px solid red';
            }else {
                errorDiv.style.display = 'none';
                this.style.border = '1px solid #cccccc'
            }
        }

        function validarMail(){
            if(this.value.indexOf('@')>-1 && this.value.indexOf('.com')>-1){
                errorDiv.style.display = 'none';
                this.style.border = '1px solid #cccccc'
            }else {
                errorDiv.style.display = 'block';
                errorDiv.innerHTML = "*Este correo no es valido";
                this.style.border = '1px solid red';
                errorDiv.style.border = '1px solid red';
            }
        }

        /*================================================================ */

        function calcularMontos (event){
            event.preventDefault();
            //console.log('Papas')
            if (regalo.value === '') {
                alert ("Debes Elegir un Regalo");
                regalo.focus();
            } else {
                    var boletosDia     = parseInt(pase_dia.value, 10) || 0,
                        boletos2Dias   = parseInt(pase_dosdias.value, 10) || 0,
                        boletoCompleto = parseInt(pase_completo.value, 10) || 0,
                        cantCamisas    = parseInt(camisas.value, 10) || 0,
                        cantEtiquetas  = parseInt(etiquetas.value, 10) || 0;
                    var totalPagar = (boletosDia * 30) + (boletos2Dias * 45) + (boletoCompleto * 50) + ((cantCamisas * 10) * .93) + (cantEtiquetas * 2);
                    console.log(totalPagar)

                    var listadoProductos = [];

                    if (boletosDia >= 2){
                        listadoProductos.push(boletosDia + ' Pases por día');
                    }else if (boletosDia >= 1){
                        listadoProductos.push(boletosDia + ' Pase por día');
                    }
                    if (boletos2Dias >= 2){
                        listadoProductos.push(boletos2Dias + ' Pases por dos días');
                    }else if (boletos2Dias >= 1){
                        listadoProductos.push(boletos2Dias + ' Pase por dos dias');
                    }
                    if (boletoCompleto >= 2){
                        listadoProductos.push(boletoCompleto + ' Pases por tres días');
                    }else if (boletoCompleto >= 1){
                        listadoProductos.push(boletoCompleto + ' Pase por tres dias');
                    }
                    if (cantCamisas >= 2){
                        listadoProductos.push(cantCamisas + ' camisas');
                    }else if (cantCamisas >= 1){
                        listadoProductos.push(cantCamisas + ' camisa');
                    }
                    if (cantEtiquetas >= 2){
                        listadoProductos.push(cantEtiquetas + ' stikers');
                    }else if (cantEtiquetas >= 1){
                        listadoProductos.push(cantEtiquetas + ' stiker');
                    }

                    lista_productos.style.display = "block";

                    lista_productos.innerHTML = '';
                    for (var i = 0; i<listadoProductos.length; i++){
                        lista_productos.innerHTML += listadoProductos[i]+ '<br/>';
                    }
                    suma.innerHTML = "$ " + totalPagar.toFixed(2);
            }
        }

        function mostrarDias(){
            var boletosDia     = parseInt(pase_dia.value, 10) || 0,
                boletos2Dias   = parseInt(pase_dosdias.value, 10) || 0,
                boletoCompleto = parseInt(pase_completo.value, 10) || 0;

            var diasElegidos = [];

            if(boletosDia>0){
                diasElegidos.push('viernes');
            }
            if(boletos2Dias>0){
                diasElegidos.push('viernes', 'sabado')
            }
            if(boletoCompleto>0){
                diasElegidos.push('viernes', 'sabado', 'domingo')
            }
            for (var i =0;i<diasElegidos.length;i++){
                document.getElementById(diasElegidos[i]).style.display = 'block';
            }
        }
    }
    }); //DOM CONTENT LOADED

})();


$(function(){

    //Lettering
    $('.nombre-sitio').lettering()

    //Menu Fijo
    var windowHeigt =$(window).height();
    var barraAltura =$('.barra').innerHeight();

    //console.log(windowHeigt);
    //console.log(barraAltura)

    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if (scroll>windowHeigt){
            $('.barra').addClass('fixed');
            $('body').css({'margin-top':barraAltura+'px'});
        } else {
            $('.barra').removeClass('fixed')
            $('body').css({'margin-top':'0px'});
        }
    })

    //Menu Responsive

    $('.menu-movil').on('click', function() {
        $('.navegacion-principal').slideToggle();
    });

    //Programa de conferencia
    $('.programa-evento .info-curso:first').show();
    $('.menu-programa a:first').addClass('activo');

    $('.menu-programa a').on('click', function(){
        $('.menu-programa a').removeClass('activo')
        $(this).addClass('activo')
        $('.ocultar').hide();
        var enlace  = $(this).attr('href');
        $(enlace).fadeIn(1000);

        return false;
    });
    //animaciones para los numeros cuarta sección

    $('.resumen-evento li:nth-child(1) p').animateNumber({number:6},1200);
    $('.resumen-evento li:nth-child(2) p').animateNumber({number:15},1200);
    $('.resumen-evento li:nth-child(3) p').animateNumber({number:3},1200);
    $('.resumen-evento li:nth-child(4) p').animateNumber({number:9},1200);

    //Cuenta regresiva

    $('.cuenta-regresiva').countdown('2100/12/10 09:00:00', function(event){
        $('#dias').html(event.strftime('%D'));
        $('#horas').html(event.strftime('%H'));
        $('#minutos').html(event.strftime('%M'));
        $('#segundos').html(event.strftime('%S'));
    });


});

$(function(){
//JS del mapa Recomendacion dejar este pluggin por fuera de los otros o genera error
var map = L.map('mapa').setView([4.734228, -74.050888], 18);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.marker([4.734228, -74.050888]).addTo(map)
    .bindPopup('GDL WEB CAM<br> Oficina')
    .openPopup();

});



























