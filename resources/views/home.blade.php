@php
    $opcionvar = $opcionvar ?? 0;
    //dump('Home : '.$opcionvar);
    $id_llamada = $id_llamada ?? 0;
    $id_solicitud = $id_solicitud ?? -1;
    $recordsimpatizante = $recordsimpatizante ?? null;
    $recordsimpatizantes = $recordsimpatizantes ?? null;
    $dataentryrecord = $dataentryrecord ?? null;
    $MsgProcess = $MsgProcess ?? null;

   
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
 
    <body >
        <div class ="Container div-img-info-principal">
           <x-layouts::app :title="__('Guayana en Positivo')" :opcionvar="0 ?? 0" :solicituduser="$solicituduser ?? null" >
            <x-generic.header :opcionvar="$opcionvar ?? 0"/> 
            @auth <!--  Verificacion de la Autorizacion-->
                <x-userauth.bodydata  :id_llamada="$id_llamada ?? -1" :opcionvar="$opcionvar ?? 0" :recordsimpatizante="$recordsimpatizante ?? null" :recordsimpatizantes="$recordsimpatizantes ?? null" :dataentryrecord="$dataentryrecord ?? null" :MsgProcess="$MsgProcess ?? ''" :id_solicitud="$id_solicitud ?? -1"></x-userauth.bodydata>
            @else
                <x-generic.bodydata :id_llamada="$id_llamada ?? -1" :opcionvar="$opcionvar ?? 0" :recordsimpatizantes="$recordsimpatizantes ?? null" :dataentryrecord="$dataentryrecord ?? null" :msgprocess="$MsgProcess ?? ''"></x-generic.bodydata> 
            @endauth
            <x-generic.footer />

            </x-layouts::app>
        </div>                
  
       <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script> 
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../../../Back/respon/lib/easing/easing.min.js"></script>
    <script src="../../../Back/respon/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="../../../Back/respon/mail/jqBootstrapValidation.min.js"></script>
    <script src="../../../Back/respon/mail/contact.js"></script>

    <!-- Template Javascript -->
     
    <script src="../../../Back/respon/js/app.js "></script> 
    <script src="../../../Back/respon/js/main.js"></script>      
    @livewireScripts
    </body>
    
</html>        
