@php
    $msgprocess = $attributes->get('msgprocess') ?? '';
    //('Al Cargar la Solicitud',get_defined_vars(),$_SERVER['REQUEST_METHOD']);
    //dump($_SERVER['REQUEST_METHOD']);    
    $datapersona = session('recordpersona')->first() ?? null;
    
    //$id_persona = $datapersona->id;
    //dd($datapersona,$id_persona);
    $opcionvar = $attributes->get('opcionvar') ?? '-1';
    $id_simpatizante = $recordsimpatizante[0]->id ?? '-1';
    $MsgProcess = $attributes->get('MsgProcess') ?? '';
    $opcionvar = $attributes->get('opcionvar') ?? '-1';
    $id_solicitud = $attributes->get('id_solicitud') ?? '-1';
    $nro_sol = $attributes->get('nro_sol') ?? '-1';
    
    //dd('Al Cargar la Solicitud',get_defined_vars(),$datapersona->id);


   // Verifico si es un registro nuevo
    if ($id_simpatizante != '-1') {
        $swi_solnew = false;
    } else {
        $swi_solnew = true;
    }
   
    
@endphp
<flux:text class="text-titulo size-text-titulo text-align-center">
    “GUAYANA  ES  EL GRAN POLO DE DESARROLLO DE VENEZUELA” 
</flux:text>

<div class="grid auto-rows-min gap-1 md:grid-cols-1  color-bg-img dark:bg-zinc-900 p-6 rounded-lg border border-zinc-200 dark:border-zinc-700 size-full">
        <form method="POST" action="{{ route('simpatizante.store',['opcionvar' => $opcionvar,'id_llamada' => 2]) }}" class="flex flex-col gap-6">
            <flux:card class="card-general">
                @csrf
                <div>
                    <flux:heading class="text-titulo size-text-head-parrafos text-align-center">Actualizacion de Datos de la Solicitud.</flux:heading>
                </div>
                <div><flux:heading size="lg"></flux:heading></div>
                <input type="hidden" name="id_simpatizante" value="{{ Crypt::encrypt($id_simpatizante) }}">
                <input type="hidden" name="id_solicitud" value="{{ Crypt::encrypt($id_solicitud) }}">
                <input type="hidden" name="id_persona" value="{{ Crypt::encrypt($datapersona->id) }}">
                <div class="data-entry col-span-6 grid grid-cols-3">
                    <div class="col-span-5">
                        <flux:heading class="text-titulo size-text-head-parrafos text-align-left">Datos del Simpatizante</flux:heading>
                        <flux:text class="mt-2">Datos Personales del Solicitante</flux:text>
                    </div>                     
                    <div class="col-span-1">
                        <flux:label>Codigo</flux:label>
                        <flux:description>Codigo de la Solicitud</flux:description>
                        <flux:input disabled readonly name="nro_sol" value="{{ strtoupper($nro_sol)  ?? 'S0000000' }}"/>
                        <flux:error name="id_tipoper" />
                    </div>                    
                    <div class="col-span-1">
                        <flux:field >
                            <flux:label>Documento de Identidad</flux:label>
                            <flux:description>Nro. CI/DNI </flux:description>
                            <flux:input disabledreadonly name="userdoc" value="{{ strtoupper($datapersona->cedula)  ?? '' }}"/>
                            <flux:error name="userdoc" />
                        </flux:field>
                    </div>
                    <div class="col-span-1">
                        <flux:field >
                            <flux:label>Nombre</flux:label>
                            <flux:description>Nombre del Solicitante</flux:description>
                            <flux:input disabled name="username" value="{{ strtoupper($datapersona->nombre)  ?? 'SIN ESPECIFICAR' }}"/>
                            <flux:error name="username" />
                        </flux:field>
                    </div>    
                    <div class="col-span-2">
                        <flux:field>
                            <flux:label>Apellidos</flux:label>
                            <flux:description>Apellidos del Solicitante</flux:description>
                            <flux:input disabled name="userape" value="{{ strtoupper($datapersona->apellido) ?? 'SIN ESPECIFICAR' }} "/>
                            <flux:error name="userape" />
                        </flux:field>
                    </div>
                    <div class="col-span-1">
                        <flux:field>
                            <flux:label>Fecha de Nacimiento</flux:label>
                            <flux:description>Solo Para Mayores de Edad</flux:description>
                            <flux:input 
                                disabled
                                type="date" 
                                name="fec_nac" 
                                value="{{ old('fec_nac', $datapersona->fec_nac) }}"
                                />
                           <flux:error name="fec_nac" />
                        </flux:field>
                    </div>                
                    <div class="col-span-1">
                        <flux:field>
                            <flux:label>Correo Electronico</flux:label>
                            <flux:description>Email del Solicitante</flux:description>
                            <flux:input disabled name="useremail" value="{{ strtoupper($datapersona->emails) ?? 'SIN ESPECIFICAR' }}"/>
                            <flux:error name="useremail" />
                        </flux:field>
                    </div>   
                    <div class="col-span-1">
                        <flux:field>
                            <flux:label>Telefono</flux:label>
                            <flux:description>Telefono del Solicitante</flux:description>
                            <flux:input disabled type="phone" placeholder="(555) 555-5555" mask="(999) 999-9999" name="usertel" value="{{ strtoupper($datapersona->telefono) ?? 'SIN ESPECIFICAR' }}"/>
                            <flux:error name="usertel" />
                        </flux:field>
                    </div>
                    <div class="col-span-5">
                        <flux:field>
                            <flux:label>Direccion</flux:label>
                            <flux:description>Direccion Actual</flux:description>
                            <flux:input disabled name="userdir" value="{{ strtoupper($datapersona->direccion) ?? 'SIN ESPECIFICAR' }}"/>
                            <flux:error name="userdir" />
                        </flux:field>
                    </div>                       
                    <livewire:userauth.simpatizantes.createsimpa :opcionvar="$opcionvar ?? 0"/>
                </div>
                <flux:spacer></flux:spacer>
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
            </flux:card>                
         </form>        
                    @isset($MsgProcess)
                        @empty($MsgProcess)
                        @else
                            @if (Str::contains($MsgProcess, 'Error'))
                                <div style="padding: 15px; background-color: #d80d0d; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px;">
                                    <flux:heading level="3" class="text-left text-lg text-gray-800 dark:text-gray-400">Resultados de Operacion :</flux:heading>
                                    <flux:spacer />
                                    <flux:separator />
                                    <flux:spacer />
                                    <flux:text class="mt-2 text-mauve-50">{{ $MsgProcess ?? '' }}</flux:text>
                                    <flux:spacer />
                                </div>
                            @else
                                <div style="padding: 15px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px;">
                                    <flux:heading level="3" class="text-left text-lg text-gray-800 dark:text-gray-400">Resultados de Operacion :</flux:heading>
                                    <flux:spacer />
                                    <flux:separator />
                                    <flux:spacer />
                                    <flux:text class="mt-2">{{ $MsgProcess ?? '' }}</flux:text>
                                    <flux:spacer />
                                </div>
                            @endif
                        @endempty
                    @endisset

</div>   
    <div class="col-span-full">
        <flux:separator></flux:separator>
        <flux:spacer></flux:spacer>
        <flux:heading level="2"  class="text-center text-xl text-gray-800 dark:text-gray-400">📌El verdadero reto, el más humano y urgente, y radica en visualizar y accionar de manera concreta para incidir en la reducción de la pobreza y el bajo poder adquisitivo de la clase trabajadora pública y privada en nuestra región.</flux:heading>
        <flux:separator></flux:separator>
   </div> 

    

