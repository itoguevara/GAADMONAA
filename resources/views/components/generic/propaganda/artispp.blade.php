@php
    use app\Models\propaganda\soloparapoliticosmdl;
    $recordartispp = soloparapoliticosmdl::all();
    $opcionvar = $attributes->get('opcionvar') ?? 0;
   // dd(get_defined_vars());    
    
    //dd('Hola 01',$recordartispp);
@endphp
<div x-data="{ imagenActiva: null, mostrar: false, modal: false }" class="p-6" style="align-items: left;">            
    <div class="grid auto-rows-min gap-2 md:grid-cols-2  color-bg-img dark:bg-zinc-900 p-6 rounded-lg border border-zinc-200 dark:border-zinc-700" size-full>
        <div class="card-text-general" style="justify-content: right;">
            <flux:heading level="5" class="text-titulo size-text-head-parrafos text-align-center">Articulos Publicados</flux:heading>
            <flux:spacer />
            <flux:separator />
            <flux:spacer />      
                @foreach($recordartispp as $image)
                    @if($image->titulo)
                        <flux:separator />
                        <div class="flex justify-between" >
                            <flux:heading>{{$image->titulo}}</flux:heading>
                            <flux:button size="sm" class="button-artispp" variant="ghost" inset @click="imagenActiva = '{{ $image->ruta  }}'"/>
                        </div>                        
                    @endif
                @endforeach
        </div>
        <div x-show="imagenActiva" class="card-text-general max-w-4xl max-h-full" @click="modal = true, imagenActiva" >
           <img :src="imagenActiva" class="max-w-full max-h-[85vh] rounded shadow-2xl">
        </div>
    </div>
<!-- 3. Ventana Flotante (Modal de Zoom) -->
    <div x-show="modal" 
         x-transition.opacity
         @keydown.escape.window="modal = false"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4"
         style="display: none;">
        
        <!-- Botón para cerrar el modal -->
        <button @click="modal = false" 
                class="absolute top-4 right-4 text-white text-3xl font-bold hover:text-gray-300 focus:outline-none">
            &times;
        </button>

        <!-- Imagen dentro del modal -->
        <div class="max-w-4xl max-h-[85vh] overflow-auto rounded-lg">
            <img :src="imagenActiva" 
                 alt="Imagen ampliada" 
                 class="max-w-full h-auto object-contain shadow-2xl" />
        </div>
    </div>
</div>