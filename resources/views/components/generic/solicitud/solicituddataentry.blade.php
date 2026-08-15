@php
    //dump('Hola 04',get_defined_vars(),session('dataentryrecord') );
    $msgprocess = $attributes->get('msgprocess') ?? '';
    $dataentryrecord = $attributes->get('dataentryrecord') ?? null;
    $paises  = session('paises') ?? [];
    $sexos  = session('sexos') ?? [];
    $profesiones  = session('profesiones') ?? [];
    $ocupaciones  = session('ocupaciones') ?? [];
    $nacionalidades  = session('nacionalidades') ?? [];
    $sessiontipospersona  = session('tipospersona') ?? [];
    //dd($sessiontipospersona,session('tipospersona'));
    $edociviles  = session('edociviles') ?? [];
    $opcionvar = $attributes->get('opcionvar') ?? '-1';
    $tiposolicitud  = session('tiposolicitud') ?? [];
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
    // Como falta Datos la mando a seguir editando
    if ($opcionvar == 14) {
        $opcionvar=2;
    }
    
@endphp
<flux:text class="text-titulo size-text-titulo text-align-center">
    “GUAYANA  ES  EL GRAN POLO DE DESARROLLO DE VENEZUELA” 
</flux:text>

<div class="grid auto-rows-min gap-4 md:grid-cols-1  color-bg-img dark:bg-zinc-900 p-6 rounded-lg border border-zinc-200 dark:border-zinc-700 size-full">
        <form method="POST" action="{{ route('simpatizante.store',['opcionvar' => $opcionvar,'id_persona' =>Crypt::encrypt(-1),'id_solicitud' =>Crypt::encrypt(-1),'id_simpatizante' =>Crypt::encrypt($id_simpatizante),'id_llamada' => 1]) }}" class="flex flex-col gap-6">
            <flux:card class="card-general">
                @csrf
                <div>
                    <flux:heading size="xl">Ingreso de Solicitud de Informacion</flux:heading>
                    <flux:text class="mt-2">Por favor, llene el formulario de Datos Para procesar su solicitud</flux:text>
                </div>
                <div><flux:heading size="lg">Datos del Solicitante</flux:heading></div>
                <input type="hidden" name="id_simpatizante" value="{{ Crypt::encrypt($id_simpatizante) }}">
                <div class="data-entry">
                    <div class="col-span-1">
                        <flux:label>Documento de Identidad</flux:label>
                        <flux:description>Tipos de Documentos de Identidad</flux:description>
                        <flux:select  readonly wire:model="id_tipoper" placeholder="Tipo de Documentos." >
                            @forelse ($sessiontipospersona as $tipopersona)
                                <flux:select.option value="{{ $tipopersona['id'] }}">
                                    {{ $tipopersona['descripcion'] }}
                                </flux:select.option>
                            @empty
                                <flux:select.option disabled>
                                    No hay tipos de documentos disponibles
                                </flux:select.option>
                            @endforelse

                        </flux:select>
                        <flux:error name="id_tipoper" />
                    </div>
                    <div class="col-span-1">
                        <flux:field >
                            <flux:label>Documento de Identidad</flux:label>
                            <flux:description>Nro. CI/DNI Usuario Solicitante</flux:description>
                            <flux:input name="userdoc" value="{{ $dataentryrecord['userdoc'] ?? '' }}"/>
                            <flux:error name="userdoc" />
                        </flux:field>
                    </div>
                    <div class="col-span-1">
                        <flux:field >
                            <flux:label>Nombre</flux:label>
                            <flux:description>Nombre del Usuario Solicitante</flux:description>
                            <flux:input name="username" value="{{ $dataentryrecord['userdoc'] ?? '' }}"/>
                            <flux:error name="username" />
                        </flux:field>
                    </div>    
                    <div class="col-span-1">
                        <flux:field>
                            <flux:label>Apellidos</flux:label>
                            <flux:description>Apellidos del Usuario Solicitante</flux:description>
                            <flux:input name="userape" value="{{ $dataentryrecord['userape'] ?? '' }} "/>
                            <flux:error name="userape" />
                        </flux:field>
                    </div>
                    <div class="col-span-1">
                        <flux:field >
                            <flux:label>Fecha de Nacimiento</flux:label>
                            <flux:description>Fecha de Nacimiento del Solicitante</flux:description>
                            <flux:input type="date" name="fec_nac"/>
                            <flux:error name="fec_nac" />
                        </flux:field>
                    </div>                
                    <div class="col-span-1">
                        <flux:field>
                            <flux:label>Correo Electronico</flux:label>
                            <flux:description>Usuario Solicitante</flux:description>
                            <flux:input type="email" name="useremail" value="{{ $dataentryrecord['useremail'] ?? '' }}"/>
                            <flux:error name="useremail" />
                        </flux:field>
                    </div>   
                    <div class="col-span-1">
                        <flux:field>
                            <flux:label>Telefono</flux:label>
                            <flux:description>Telefono del Usuario Solicitante</flux:description>
                            <flux:input type="phone" placeholder="(555) 555-5555" mask="(999) 999-9999" name="usertel" value="{{ $recordsimpatizante[0]->telefono ?? '' }}"/>
                            <flux:error name="usertel" />
                        </flux:field>
                    </div>
                    <div class="col-span-1">
                        <flux:label>Sexo</flux:label>
                        <flux:description>Sexo del Solicitante</flux:description>
                        <flux:select readonly wire:model.live="sexo" placeholder="Sexo" >
                            @forelse ($sexos  as $sexo)
                                <flux:select.option value="{{ $sexo['letra'] }}">{{ $sexo['nombre']}}</flux:select.option>
                            @empty
                            <!-- El valor específico que aparece automáticamente -->
                            <flux:select.option disabled value={{ $id_defaultValue }}>{{ $defaultValue }}</flux:select.option>
                            @endforelse
                        </flux:select>
                        <flux:error name="sexo" />
                    </div>

                    <div class="col-span-1">
                        <flux:label>Estado Civil</flux:label>
                        <flux:description>Estado Civil del Solicitante</flux:description>
                        <flux:select readonly wire:model.live="id_edocivil" placeholder="Estado Civil" >
                            @forelse ($edociviles  as $edocivil)
                                <flux:select.option value="{{ $edocivil['id'] }}">{{ $edocivil['nombre'] }}</flux:select.option>
                            @empty
                            <!-- El valor específico que aparece automáticamente -->
                            <flux:select.option disabled value={{ $id_defaultValue }}>{{ $defaultValue }}</flux:select.option>
                            @endforelse
                        </flux:select>
                        <flux:error name="id_edocivil" />
                    </div>
                    <div class="col-span-1">
                        <flux:label>Pais de Nacimiento</flux:label>
                        <flux:description>Pais de Nacimiento del Solicitante</flux:description>
                        <flux:select readonly wire:model.live="id_paisnaci" placeholder="Donde Nacio ?" >
                            @forelse ($paises  as $pais)
                                <flux:select.option value="{{ $pais['id'] }}">{{ $pais['nombre'] }}</flux:select.option>
                            @empty
                            <!-- El valor específico que aparece automáticamente -->
                            <flux:select.option disabled value={{ $id_defaultValue }}>{{ $defaultValue }}</flux:select.option>
                            @endforelse
                        </flux:select>
                        <flux:error name="id_paisnaci" />
                    </div>
                    <div class="col-span-1">
                        <flux:label>Nacionalidad</flux:label>
                        <flux:description>Nacionalidad del Solicitante</flux:description>
                        <flux:select readonly wire:model.live="id_nacionalidad" placeholder="Nacionalidad" >
                            @forelse ($nacionalidades  as $nacionalidad)
                                <flux:select.option value="{{ $nacionalidad['id'] }}">{{ $nacionalidad['nombre'] }}</flux:select.option>
                            @empty
                            <!-- El valor específico que aparece automáticamente -->
                            <flux:select.option disabled value={{ $id_defaultValue }}>{{ $defaultValue }}</flux:select.option>
                            @endforelse
                        </flux:select>
                        <flux:error name="id_nacionalidad" />
                    </div>    
                    <div class="col-span-1">
                        <flux:label>Profesion</flux:label>
                        <flux:description>Profesion del Solicitante</flux:description>
                        <flux:select readonly wire:model.live="id_profesion" placeholder="Profesion" >
                            @forelse ($profesiones  as $profesion)
                                <flux:select.option value="{{ $profesion['id'] }}">{{ $profesion['nombre'] }}</flux:select.option>
                            @empty
                            <!-- El valor específico que aparece automáticamente -->
                            <flux:select.option disabled value={{ $id_defaultValue }}>{{ $defaultValue }}</flux:select.option>
                            @endforelse
                        </flux:select>
                        <flux:error name="id_profesion" />
                    </div>
                    <div class="col-span-1">
                        <flux:label>Ocupacion</flux:label>
                        <flux:description>Ocupacion del Solicitante</flux:description>
                        <flux:select readonly wire:model.live="id_ocupacion" placeholder="Ocupacion" >
                            @forelse ($ocupaciones  as $ocupacion)
                                <flux:select.option value="{{ $ocupacion['id'] }}">{{ $ocupacion['descripcion'] }}</flux:select.option>
                            @empty
                            <!-- El valor específico que aparece automáticamente -->
                            <flux:select.option disabled value={{ $id_defaultValue }}>{{ $defaultValue }}</flux:select.option>
                            @endforelse
                        </flux:select>
                        <flux:error name="id_ocupacion" />
                    </div>
                    <livewire:generic.selection-cmb :opcionvar="$opcionvar ?? 0" :recordpaises="$recordpaises ?? null" :recordestados="$recordestados ?? null" :recordmunicipios="$recordmunicipios ?? null" :recordciudades="$recordciudades ?? null" :id_pais="$recordsimpatizante[0]->id_pais ?? '0'" :id_estado="$recordsimpatizante[0]->id_estado ?? '0'" :id_municipio="$recordsimpatizante[0]->id_municipio ?? '0'" :id_ciudad="$recordsimpatizante[0]->id_ciudad ?? '0'" />
                </div>
                <flux:spacer></flux:spacer>
            </flux:card>                
                    <div class="div-group-buttons">
                        <flux:menu.radio.group>
                            <flux:menu.item
                                as="button"
                                type="submit"
                                name="save"
                                value="save"
                                icon=""
                                class="button-accion button-accion-save button-Large"
                                data-test="save-button"
                            >
                            </flux:menu.item>

                            <flux:menu.item
                                as="button"
                                type="submit"
                                name="exit"
                                value="exit"
                                icon=""
                                class="button-accion button-accion-exit button-Large"                    
                                data-test="exit-button"     
                            >
                            </flux:menu.item>
                        </flux:menu.radio.group>
                    </div>
                    @isset($msgprocess)
                        @empty($msgprocess)
                        @else
                            @if (Str::contains($msgprocess, 'Error'))
                                <div style="padding: 15px; background-color: #d80d0d; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px;">
                                    <flux:heading level="3" class="text-left text-lg text-gray-800 dark:text-gray-400">Resultados de Operacion :</flux:heading>
                                    <flux:spacer />
                                    <flux:separator />
                                    <flux:spacer />
                                    <flux:text class="mt-2 text-mauve-50">{{ $msgprocess ?? '' }}</flux:text>
                                    <flux:spacer />
                                </div>
                            @else
                                <div style="padding: 15px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px;">
                                    <flux:heading level="3" class="text-left text-lg text-gray-800 dark:text-gray-400">Resultados de Operacion :</flux:heading>
                                    <flux:spacer />
                                    <flux:separator />
                                    <flux:spacer />
                                    <flux:text class="mt-2">{{ $msgprocess ?? '' }}</flux:text>
                                    <flux:spacer />
                                </div>
                            @endif
                        @endempty
                    @endisset


         </form>        
</div>   
    <div class="col-span-full">
        <flux:separator></flux:separator>
        <flux:spacer></flux:spacer>
        <flux:heading level="2"  class="text-center text-xl text-gray-800 dark:text-gray-400">📌El verdadero reto, el más humano y urgente, y radica en visualizar y accionar de manera concreta para incidir en la reducción de la pobreza y el bajo poder adquisitivo de la clase trabajadora pública y privada en nuestra región.</flux:heading>
        <flux:separator></flux:separator>
   </div> 

    

