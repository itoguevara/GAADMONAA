<?php

namespace app\View\Components\generic\propaganda;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use app\Models\propaganda\soloparapoliticosmdl;
use Illuminate\Http\Request;

class artispp extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(Request $request)
    {
        
        
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Obtenemos solo el array de las rutas (paths) de las imágenes
        $images = soloparapoliticosmdl::pluck('ruta')->toArray();

        // Si usas el sistema de almacenamiento local (Storage), puedes mapear las URLs mapeando el array:
        //$images = Image::pluck('ruta')->map(fn($ruta) => asset('public/' . $ruta))->toArray();
        $recordartispp = soloparapoliticosmdl::all();
        return view('components.generic.propaganda.artispp', compact(['images','recordartispp']));

    }
}
