@php
    $opcionvar = $attributes->get('opcionvar') ?? 0;
    $recordsolicitud = $attributes->get('recordsolicitud') ?? null;
    $recordsolicitudes = PublicFunctions::GetDataObject(9,'',-1); // Ejemplo de uso de sesión para almacenar Los Datos de las SOlicitudes
    $recordsimpatizantes = $attributes->get('recordsimpatizantes') ?? null;
    $MsgProcess = $attributes->get('MsgProcess') ?? '';
@endphp
 
<flux:text class="text-titulo size-text-titulo text-align-center">
    “GUAYANA  ES  EL GRAN POLO DE DESARROLLO DE VENEZUELA” 
</flux:text>

<div class="grid auto-rows-min gap-4 md:grid-cols-1  color-bg-img dark:bg-zinc-900 p-6 rounded-lg border border-zinc-200 dark:border-zinc-700" size full>
  <x-generic.searchrecord :opcionvar="$opcionvar ?? 1" :recordsolicitudes="$recordsolicitudes ?? Null" :recordsimpatizantes="$recordsimpatizantes  ?? null" :clientesdata="$clientesdata ?? null"/>

    <flux:heading class="text-titulo size-text-head-parrafos text-align-left">Relacion de Solicitudes</flux:heading>
    <flux:card class="space-y-1">
        <div class="relative flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            {{$recordsolicitudes->links()}}
            <form method="get" action="{{ route('simpatizante.edit',['opcionvar' => $opcionvar ?? 0]) }}" class="flex flex-col gap-6">
            @csrf
            <div class="overflow-hidden w-full overflow-x-auto rounded-radius border border-outline dark:border-outline-dark">
                <table class="w-full text-left text-sm text-on-surface dark:text-on-surface-dark">
                    <thead class="border-b border-outline bg-surface-alt text-sm text-on-surface-strong dark:border-outline-dark dark:text-on-surface-dark-strong" style="background-color:darkgray">
                        <tr>
                            <th scope="col" class="p-1">Nro.</th>
                            <th scope="col" class="p-1">Fecha</th>
                            <th scope="col" class="p-1">Cedula</th>
                            <th scope="col" class="p-1">Solicitante</th>
                            <th scope="col" class="p-1">Tipo</th>
                            <th scope="col" class="p-1">Observacion</th>
                            <th scope="col" class="p-1 align-middle text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline dark:divide-outline-dark">
                        @foreach ($recordsolicitudes as $solicitud )
                            @if ($solicitud->id_status == 2) 
                                <tr class="bg-red-100 dark:bg-red-900/20">
                            @elseif($solicitud->id_status == 3)
                                <tr class="bg-blue-100 dark:bg-red-900/20">
                            @else 
                                <tr class="bg-green-100 dark:bg-green-900/20">
                            @endif
                                <td class="p-1">{{ $solicitud->nro_sol}}</td>
                                <td class="p-1">{{ $solicitud->fecha}}</td>
                                <td class="p-1">{{ $solicitud->cedula }}</td>
                                <td class="p-1">{{ $solicitud->persona }}</td>
                                <td class="p-1">{{ $solicitud->tipo_sol }}</td>
                                <td class="p-1">{{ $solicitud->observacion }}</td>
                                <td class="p-1" >
                                    <div class="div-group-buttons-Horizontal">
                                        <flux:menu.radio.group>
                                            <flux:menu.item
                                                as="button"
                                                href="{{ route('simpatizante.edit', ['opcionvar' => $opcionvar ?? 0,'id_simpatizante'=> Crypt::encrypt(-1),'id_solicitud' =>Crypt::encrypt($solicitud->id),'id_persona' =>Crypt::encrypt($solicitud->id_persona),'id_llamada' => '2','id_accion' => '1']) }}"
                                                type="submit"
                                                name="edit"
                                                value="{{ $solicitud->id }}"
                                                icon=""
                                                class="button-accion-sol button-accion-edit"
                                                data-test="edit-button"
                                            >
                                            </flux:menu.item>
                                        </flux:menu.radio.group>
                                        <flux:menu.radio.group>
                                            <flux:menu.item
                                                as="button"
                                                type="submit"
                                                name="printer"
                                                href="{{ route('simpatizante.edit', ['opcionvar' => $opcionvar ?? 0,'id_simpatizante'=> Crypt::encrypt(-1),'id_solicitud' =>Crypt::encrypt($solicitud->id),'id_persona' =>Crypt::encrypt($solicitud->id_persona),'id_llamada' => '1','id_accion' => '2']) }}"
                                                value="{{ $solicitud->id }}"
                                                icon=""
                                                class="button-accion-sol button-accion-printer"
                                                data-test="printer-button"
                                                >
                                            </flux:menu.item>
                                        </flux:menu.radio.group>
                                        <flux:menu.radio.group>
                                            <flux:menu.item
                                                as="button"
                                                type="submit"
                                                href="{{ route('simpatizante.edit', ['opcionvar' => 2 ?? 0,'id_simpatizante'=> Crypt::encrypt(-1),'id_solicitud' =>Crypt::encrypt($solicitud->id),'id_persona' =>Crypt::encrypt($solicitud->id_persona),'id_llamada' => '2','id_accion' => '3']) }}"
                                                name="delete"
                                                value="{{ $solicitud->id }}"
                                                icon=""
                                                class="button-accion-sol button-accion-delete"
                                                data-test="delete-button"
                                            >
                                            </flux:menu.item>
                                        </flux:menu.radio.group>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </form>
        </div>
    </flux:card>
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

       <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
</div>