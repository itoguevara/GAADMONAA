@php

    $opcionvar = $attributes->get('opcionvar') ?? 0;
    $recordsimpatizantes = $attributes->get('recordsimpatizantes') ?? null;
    $msgprocess  = $attributes->get('msgprocess') ?? null;
    $FunctionsPublic = new PublicFunctions();
    $FunctionsPublic->CargaInicialDataRecord();
    // dump('BodyData No Auth : '.$opcionvar);
    
@endphp
<div class="grid auto-rows-min gap-4 md:grid-cols-1  color-bg-img dark:bg-zinc-900 p-6 rounded-lg border border-zinc-200 dark:border-zinc-700" size-full>

    @auth <!--  Verificacion de la Autorizacion-->
    @else
        @switch($opcionvar)
            @case(0) <!-- Pagina Generica de la Portada-->
                <x-generic.pageini :opcionvar="$opcionvar ?? 0" :recordsimpatizante="$recordsimpatizante ?? null" :recordsimpatizantes="$recordsimpatizantes ?? null"></x-generic.pageini>
                @break
            @case(2) <!-- Pagina Generica del Data Entry Inicial de solicitud-->
                <x-generic.solicitud.solicituddataentry :opcionvar="$opcionvar ?? 0" :recordsimpatizantes="$recordsimpatizantes ?? null" :id_simpatizante="'-1'" :dataentryrecord="$dataentryrecord ?? null" :msgprocess="$msgprocess ?? ''"></x-generic.solicitud.solicituddataentry>        
                @break

            @case(3)  <!-- Pagina Generica de Objetivos Estrategicos-->
                <x-generic.quienessomos :opcionvar="$opcionvar ?? 0" :recordsimpatizante="$recordsimpatizante ?? null" :recordsimpatizantes="$recordsimpatizantes ?? null"></x-generic.quienessomos>
                @break
            @case(4) <!-- Pagina Generica de Objetivos Estrategicos-->
                <x-generic.objestra :opcionvar="$opcionvar ?? 0" :recordsimpatizante="$recordsimpatizante ?? null" :recordsimpatizantes="$recordsimpatizantes ?? null"></x-generic.objestra>
                @break

            @case(5) <!-- Se Grabo el Registro Satifactoriamente-->
                <x-generic.solicitud.solicituddataentry :opcionvar="$opcionvar ?? 0" :recordsimpatizantes="$recordsimpatizantes ?? null" :id_simpatizante="'-1'" :dataentryrecord="$dataentryrecord ?? null" :msgprocess="$msgprocess ?? ''"></x-generic.solicitud.solicituddataentry>        
                @break

            @case(7) <!-- Se Grabo el Registro Satifactoriamente-->
                <x-generic.propaganda.artispp :opcionvar="$opcionvar ?? 0" :recordsimpatizantes="$recordsimpatizantes ?? null" :id_simpatizante="'-1'" :dataentryrecord="$dataentryrecord ?? null" :msgprocess="$msgprocess ?? ''"></x-generic.propaganda.artispp>        
                @break
            @default
                <p>Acceso restringido.</p>
        @endswitch
    @endauth
</div>