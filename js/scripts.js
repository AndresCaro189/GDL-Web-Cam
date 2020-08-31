
// Ajax

$(function(){
    'use strict';
    //Interactividad de menu nav
        $('.nuestro-servicio div:first').show();
        $('.servicios nav a:first').addClass('activo');

        $('.servicios nav a').on('click', mostrarTabs);

        function mostrarTabs() {
            $('.servicios nav a').removeClass('activo');
            $(this).addClass('Activo')
            var enlace = $(this).attr('href');
            $('.nuestro-servicio div').fadeOut();
            $(enlace).fadeIn();

            return false;
        }
});