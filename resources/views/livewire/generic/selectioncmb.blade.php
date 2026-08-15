@php
    //dump('Hola 04',get_defined_vars(),session('dataentryrecord') );
    $msgprocess = $attributes->get('msgprocess') ?? '';
    $dataentryrecord = $attributes->get('dataentryrecord') ?? null;
    $opcionvar = $attributes->get('opcionvar') ?? '-1';
    $recordsimpatizante = session('recordsimpatizante') ?? [];   
    $id_simpatizante = $recordsimpatizante[0]->id ?? '-1';
    // Verifico si es un registro nuevo
    if ($id_simpatizante != '-1') {
        $swi_solnew = false;
    } else {
        $swi_solnew = true;
    }
   // Verifico si viene de Quienes Somos
    if ($msgprocess == '-1') {
        $msgprocess = null;
    }
    // Como falta Datos la mando a seguir editndo
    if ($opcionvar == 14) {
        $opcionvar=2;
    }
@endphp
<div class="data-entry col-span-5 grid grid-cols-5 gap-1">
    <div class="col-span-6">
        <flux:heading size="xl">Direccion</flux:heading>
        <flux:text class="mt-2">Por favor, especifique los Datos de su Direccion de Residencia Principal</flux:text>
    </div>    
    <div class="col-span-1">
        <flux:label>Pais</flux:label>
        <flux:select readonly wire:model.live="selectedPais" placeholder="País." >
            @forelse ($paises  as $pais)
                <flux:select.option value="{{ $pais->id }}">{{ $pais->nombre }}</flux:select.option>
            @empty
            <!-- El valor específico que aparece automáticamente -->
               <flux:select.option disabled value={{ $id_defaultValue }}>{{ $defaultValue }}</flux:select.option>
            @endforelse
        </flux:select>
        <flux:error name="id_pais" />
    </div>
    
    <div class="col-span-1">
        <flux:label>Estado</flux:label>
        <flux:select readonly wire:model.live="selectedEstado" placeholder="Estado." >
            @forelse ($estados  as $estado)
                <flux:select.option value="{{ $estado->id }}">{{ $estado->nombre }}</flux:select.option>
            @empty
                <flux:select.option disabled>No hay estados disponibles</flux:select.option>
            @endforelse
        </flux:select>
        <flux:error name="id_estado" />
    </div>
    <div class="col-span-1">
        <flux:label>Municipio</flux:label>
        <flux:select readonly wire:model.live="selectedMunicipio" placeholder="Municipio." >
            @forelse ($municipios  as $municipio)
                <flux:select.option value="{{ $municipio->id }}">{{ $municipio->nombre }}</flux:select.option>
            @empty
                <flux:select.option disabled>No hay municipios disponibles</flux:select.option>
            @endforelse
        </flux:select>
        <flux:error name="id_municipio" />
    </div>
    <div class="col-span-1">
        <flux:label>Ciudad</flux:label>
        <flux:select readonly wire:model.live="selectedCiudad" placeholder="Ciudad." >
            @forelse ($ciudades  as $ciudad)
                <flux:select.option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</flux:select.option>
            @empty
                <flux:select.option disabled>No hay ciudades disponibles</flux:select.option>
            @endforelse
        </flux:select>
        <flux:error name="id_ciudad" />
    </div>
    <div class="col-span-1">
        <flux:label>Parroquia</flux:label>
        <flux:select readonly wire:model.live="selectedParroquia" placeholder="Parroquia." >
            @forelse ($parroquias  as $parroquia) 
                <flux:select.option value="{{ $parroquia->id }}">{{ $parroquia->nombre }}</flux:select.option>
            @empty
                <flux:select.option disabled>No hay parroquias disponibles</flux:select.option>
            @endforelse
        </flux:select>
        <flux:error name="id_parroquia" />
    </div>
    <div class="col-span-1">
        <flux:label>Sector</flux:label>
        <flux:select readonly wire:model.live="selectedSector" placeholder="Sector." >
            @forelse ($sectores  as $sector)
                <flux:select.option value="{{ $sector->id }}">{{ $sector->nombre }}</flux:select.option>
            @empty
                <flux:select.option disabled>No hay sectores disponibles</flux:select.option>
            @endforelse
        </flux:select>
        <flux:error name="id_sector" />
    </div>
    <div class="col-span-6">
        <flux:field>
            <flux:description>Especifique datos de su residencia</flux:description>
            <flux:input name="userdir" value="{{ $dataentryrecord['userdir'] ?? '' }}"/>
            <flux:error name="userdir" />
        </flux:field>
    </div>    
</div>
