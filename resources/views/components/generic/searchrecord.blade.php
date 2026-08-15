@php
//    dd('Hola 04',get_defined_vars(),session('dataentryrecord') );    
    $status = session('statusconfirmacion') ?? [];
    $tiposimpatizante = session('tipossimpa') ?? [];
    $mediosinfo = session('mediosinfo') ?? [];
    $id_simpatizante = $attributes->get('id_simpatizante') ?? '-1';
    //dd($status, $tiposimpatizante, $mediosinfo);
    
@endphp

     <flux:card class="card-data-search">
        <flux:heading level="5" class="text-titulo size-text-head-parrafos text-align-center">Busqueda de Simpatizantes</flux:heading>
        <flux:spacer />
        <flux:separator />
        <flux:spacer />        
        <flux:text class="mt-0">
                “Busqueda de Simpatizantes por Nombres, Apellidos, Fecha, Tipo y Status de Tramite” 
        </flux:text>
        <form method="get" action="{{ route('simpatizante.search',['opcionvar' => $opcionvar ?? 0]) }}" class="flex flex-col gap-6">
            @csrf
            <div class="div-data-search">
                <div class="item-data-search div-ancho-item-data-search">
                    <flux:radio.group wire:model="search_field" variant="segmented" size="sm" label=""  name="search_field">
                        <flux:radio value="0" label="Nombres" icon="wrench" checked />
                        <flux:radio value="1" label="Apellidos" icon="document-text" />
                        <flux:radio value="2" label="Fecha" icon="calendar" />
                        <flux:radio value="3" label="Tipo" icon="tag" />
                        <flux:radio value="4" label="Medios de Informacion" icon="check-circle" />
                        <flux:radio value="5" label="Status" icon="check-circle" />
                    </flux:radio.group>

                </div>    

              <div class="div-group-buttons-vertical  div-alto-item-data-search">
                    <flux:label></flux:label>
                    <flux:menu.radio.group>
                        <flux:menu.item
                            as="button"
                            type="submit"
                            name="search"
                            value="search"
                            icon=""
                            class="button-search button-accion-search"
                            data-test="search-button"
                        >
                        </flux:menu.item>
                    <flux:menu.radio.group>
                        <flux:menu.item
                            as="button"
                            type="submit"
                            name="printer"
                            value="printer"
                            icon=""
                            class="button-search button-accion-printer"
                            data-test="printer-button"
                        >
                        </flux:menu.item>
                    </flux:menu.radio.group>
                </div>   

                <div class="item-opcion-search">
                    <flux:label>Tipo de Simpatizantes</flux:label>
                    <flux:select name="id_tipo_simpatizante" wire:model="id_tipo_simpatizante" placeholder="Tipo de Simpatizante." >
                        @forelse ($tiposimpatizante as $tiposimpat)
                            <flux:select.option value="{{ $tiposimpat['id'] }}">{{ $tiposimpat['descripcion'] }}</flux:select.option>
                        @empty
                            <flux:select.option value="">No hay tipos de id_tipo_simpatizante disponibles</flux:select.option>
                        @endforelse
                    </flux:select>
                    <flux:error name="id_tipo_simpatizante" />                            
                </div>    
                <div class="item-opcion-search">
                    <flux:label>Status</flux:label>
                    <flux:select name="id_status" wire:model="id_status" placeholder="Status." >
                        @forelse ($status as $statusdoc)
                            <flux:select.option value="{{ $statusdoc['id']}}">{{ $statusdoc['descripcion'] }}</flux:select.option>
                        @empty
                            <flux:select.option value="">No hay status disponibles</flux:select.option>
                        @endforelse
                    </flux:select>
                    <flux:error name="id_status" />                            
                </div>    
                <div class="item-opcion-search">
                        <flux:field  required >
                            <flux:label>Fecha Desde :</flux:label>
                            <flux:input type="date" name="fecha_desde"/>
                            <flux:error name="fecha_desde" />
                        </flux:field>  
                </div>    
                <div class="item-opcion-search">
                        <flux:field  required >
                            <flux:label>Fecha Hasta :</flux:label>
                            <flux:input type="date" name="fecha_hasta"/>
                            <flux:error name="fecha_hasta" />
                        </flux:field>  
                </div>
                <div class="item-opcion-search">
                    <flux:label>Data a Buscar</flux:label>
                    <flux:field required >
                        <flux:input name="data_search" placeholder="" />
                        <flux:error name="data_search" />
                    </flux:field>
                </div>
            </div>
            <div><input type="hidden" name="id_simpatizante" value="{{$id_simpatizante}}"></div >
        </form>  
 </flux:card>          
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @elseif (session('success'))    
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
   



