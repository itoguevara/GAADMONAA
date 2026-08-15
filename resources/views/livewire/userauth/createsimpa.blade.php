@php
    $id_defaultValue =-1;
    $defaultValue = 'NO ESPECIFICADO';

     // Para Los Combos de Verificacion
    $verificadores  = session('verificadores') ?? [];
    $mediosinfo  = session('mediosinfo') ?? [];
    $simpatizantes  = session('simpatizantes') ?? [];
    $tipossimpa  = session('tipossimpa') ?? [];
    $pensapoli  = session('pensapoli') ?? [];
    $statusconfirmacion = session('statusconfirmacion') ?? [];
    $referencias = session('referencias') ?? [];

   //dd('Hola 04',get_defined_vars(),session('dataentryrecord') );    
@endphp
<div class="data-entry col-span-6 grid grid-cols-6 gap-1">
    <div class="col-span-7">
        <flux:heading class="text-titulo size-text-head-parrafos text-align-left">Verificacion de la Solicitud</flux:heading>
        <flux:text class="mt-2">Por favor, especifique los Datos para Verificar y Clasificar al Simpatizante</flux:text>
    </div>    
    <div class="col-span-1">
        <flux:label>Como se Entero ? </flux:label>
        <flux:select readonly wire:model.live="selectedMedioinfo" placeholder="Medio de Informacion." >
            @forelse ($mediosinfo  as $medioinfo)
                <flux:select.option value="{{ $medioinfo['id'] }}">{{ $medioinfo['nombre'] }}</flux:select.option>
            @empty
            <!-- El valor específico que aparece automáticamente -->
                <flux:select.option disabled value={{ $id_defaultValue }}>{{ $defaultValue }}</flux:select.option>
            @endforelse
        </flux:select>
        <flux:error name="id_medioinfo" />
    </div>
    
    <div class="col-span-1">
        <flux:label>Referido Por</flux:label>
        <flux:select readonly wire:model.live="selectedReferencia" placeholder="Referencia." >
            @forelse ($referencias  as $referencia)
                <flux:select.option value="{{ $referencia['id'] }}">{{ $referencia['simpatizante'] }}</flux:select.option>
            @empty
                <flux:select.option disabled>No hay simpatizantes Para No disponibles</flux:select.option>
            @endforelse
        </flux:select>
        <flux:error name="id_estado" />
    </div>
    <div class="col-span-1">
        <flux:label>Verificador</flux:label>
        <flux:select readonly wire:model.live="selectedVerificador" placeholder="Verificador." >
            @forelse ($verificadores  as $verificador)
                <flux:select.option value="{{ $verificador['id'] }}">{{ $verificador['simpatizante'] }}</flux:select.option>
            @empty
                <flux:select.option disabled>No hay Verificadores disponibles</flux:select.option>
            @endforelse
        </flux:select>
        <flux:error name="id_estado" />
    </div>
    <div class="col-span-1">
        <flux:label>Tipo de Simpatizante</flux:label>
        <flux:select readonly wire:model.live="selectedTiposimpa" placeholder="Tipo." >
            @forelse ($tipossimpa  as $tiposimpatizante)
                <flux:select.option value="{{ $tiposimpatizante['id'] }}">{{ $tiposimpatizante['descripcion'] }}</flux:select.option>
            @empty
                <flux:select.option disabled>No hay Tipos de SImpatizantes Disponibles</flux:select.option>
            @endforelse
        </flux:select>
        <flux:error name="id_estado" />
    </div>
    <div class="col-span-1">
        <flux:label>Pensamiento Politico</flux:label>
        <flux:select readonly wire:model.live="selectedIdeologia" placeholder="Ideologia Politica." >
            @forelse ($pensapoli  as $ideologia)
                <flux:select.option value="{{ $ideologia['id'] }}">{{ $ideologia['descripcion'] }}</flux:select.option>
            @empty
                <flux:select.option disabled>No hay Tipos de SImpatizantes Disponibles</flux:select.option>
            @endforelse
        </flux:select>
        <flux:error name="id_estado" />
    </div>
    <div class="col-span-1">
        <flux:label>Status</flux:label>
        <flux:select readonly wire:model.live="selectedStatusconfirmacion" placeholder="Status." >
            @forelse ($statusconfirmacion  as $status)
                <flux:select.option value="{{ $status['id'] }}">{{ $status['descripcion'] }}</flux:select.option>
            @empty
                <flux:select.option disabled>No hay Status Disponibles</flux:select.option>
            @endforelse
        </flux:select>
        <flux:error name="id_estado" />
    </div>
    <div class="col-span-6">
        <flux:field>
            <flux:label>Observacion</flux:label>
            <flux:description>Informacion Adicional de Interes</flux:description>
            <flux:input name="observ" value="{{ $dataentryrecord['observ'] ?? '' }}"/>
            <flux:error name="observ" />
        </flux:field>
    </div>    
</div>
