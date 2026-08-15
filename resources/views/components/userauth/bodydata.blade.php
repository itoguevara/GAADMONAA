
<div>
  @php
    $routeName = request()->route()->getName();
    $id_solicitud = $attributes->get('id_solicitud') ?? 0;
    $id_llamada = $attributes->get('id_llamada') ?? 0;
    $opcionvar = $attributes->get('opcionvar') ?? 0;
   // dump('BodyData : '.$opcionvar);
    $MsgProcess = $attributes->get('MsgProcess') ?? '';
    
    $id_persona_user = app()->call('app\Http\Controllers\userauth\usuadatactrl@GetDataUser')->first()->id_persona ?? null;
    $recordsimpatizante = app()->call('app\Http\Controllers\userauth\simpatizantesctrl@GetDatasimpatizante', ['id_data_search' => $id_persona_user, 'id_opcion' => 1]);    
    $recordsolicitud = app()->call('app\Http\Controllers\userauth\simpatizantesctrl@GetDataSolicitud', ['id_data_search' => $id_solicitud, 'id_opcion' => 0]);    
    //dump($recordsolicitud);
    $nro_sol = $recordsolicitud[0]->nro_sol ?? 'S00000000';
    //dump($MsgProcess);
    
    //dump('BodyData Auth : ',$_SERVER['REQUEST_METHOD'],get_defined_vars());
@endphp
     
          
<!-- Dependiendo de la opcion que se elija en el menu, se mostrara un contenido diferente, 
    se evalua la variable $opcionvar y se muestra el contenido correspondiente a cada caso.   -->

    @auth <!--  Verificacion de la Autorizacion-->
        @switch($opcionvar)
            @case(0) <!--  En este caso se muestra el formulario deSolicitudes, el cual es un componente de blade que se encuentra en resources/views/components/userauth/tcsolicitud.blade.php -->
                <x-generic.pageini :opcionvar="$opcionvar ?? 0" :recordsimpatizante="$recordsimpatizante ?? null" :recordsimpatizantes="$recordsimpatizantes ?? null"></x-generic.pageini>
                @break
            @case(2) <!--  En este caso se muestra el formulario de edición de Simpatizantes -->
                <x-userauth.simpatizantes.simpatizantedataentry  :MsgProcess="$MsgProcess ?? ''" :nro_sol="$nro_sol ?? 'S0000000'" :id_solicitud="$id_solicitud ?? -1" :opcionvar="$opcionvar ?? 0" :recordsimpatizantes="$recordsimpatizantes ?? null" :id_simpatizante="-1" />        
                @break
            @case(3)  <!-- Pagina Generica de Objetivos Estrategicos-->
                <x-generic.quienessomos :opcionvar="$opcionvar ?? 0" :recordsimpatizante="$recordsimpatizante ?? null" :recordsimpatizantes="$recordsimpatizantes ?? null"></x-generic.quienessomos>
                @break
            @case(4) <!-- Pagina Generica de Objetivos Estrategicos-->
                <x-generic.objestra :opcionvar="$opcionvar ?? 0" :recordsimpatizante="$recordsimpatizante ?? null" :recordsimpatizantes="$recordsimpatizantes ?? null"></x-generic.objestra>
                @break
            @case(5) <!-- Se Grabo el Registro de Simpatizantes Satifactoriamente-->
                <x-userauth.createsimpa :opcionvar="$opcionvar ?? 0" :recordsimpatizantes="$recordsimpatizantes ?? null" :id_simpatizante="'-1'"/>        
                @break
            @case(6) <!-- Se Muestra el reporte de todas las solicitudes Pendientes para crear el Simpatizante-->
                <x-userauth.reportes.simpatizantes.solicitudrpt :opcionvar="$opcionvar ?? 0" :recordsolicitud="$recordsolicitud ?? null" :id_solicitud="'-1'" :MsgProcess="$MsgProcess ?? ''" />
                @break
            @case(7) <!-- Se Grabo el Registro Satifactoriamente-->
                <x-generic.propaganda.artispp :opcionvar="$opcionvar ?? 0" :recordsimpatizantes="$recordsimpatizantes ?? null" :id_simpatizante="'-1'" :dataentryrecord="$dataentryrecord ?? null" :msgprocess="$msgprocess ?? ''"></x-generic.propaganda.artispp>        
                @break

            @case(8) <!-- Activo el Formulario de Solicitudes -->
                <x-generic.solicitud.solicituddataentry :opcionvar="$opcionvar ?? 0" :recordsimpatizantes="$recordsimpatizantes ?? null" :id_simpatizante="'-1'" :dataentryrecord="$dataentryrecord ?? null" :msgprocess="$msgprocess ?? ''"></x-generic.solicitud.solicituddataentry>        
                @break
            @default
                <p>Acceso restringido.</p>
        @endswitch
    @endauth
</div>