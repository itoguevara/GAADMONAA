<?php

use Livewire\Component;
// Tablas de Combos
use app\Models\datacenter\ciudadesmdl;
use app\Models\datacenter\municipiosmdl;
use app\Models\datacenter\paisesmdl;
use app\Models\datacenter\estadosmdl;
use app\Models\datacenter\sectoresmdl;
use app\Models\datacenter\parroquiasmdl;



new class extends Component
{
    // Propiedades públicas para almacenar los IDs seleccionados
    public $selectedPais = null;
    public $selectedEstado = null;
    public $selectedMunicipio = null;
    public $selectedCiudad = null;
    public $selectedSector = null;
    public $selectedParroquia = null;


    public $id_defaultValue = -1;
    public $defaultValue = '';
    

    // Colecciones para llenar los combos
    public $paises = [];
    public $estados = [];
    public $municipios = [];
    public $ciudades = [];
    public $sectores = [];
    public $parroquias = [];
    // Variables Para Registros de NO ESPECIFICADO en los Combos 
    public $pais = [];
    public $estado = [];
    public $municipio = [];
    public $ciudad = [];
    public $parroquia = [];
    public $sector = [];
    public $tipopersona = [];
    // Se ejecuta una sola vez al cargar el componente

    public function mount()
    {
        //dd($this->estado[0]->nombre);
        /* Estados Por defecto*/
        $this->paises = paisesmdl::all();
        $this->pais =  paisesmdl::where('nombre', 'NO ESPECIFICADO')->get(); 

        $this->estado =  estadosmdl::where('id_pais', $this->pais[0]->id)->where('nombre', 'NO ESPECIFICADO')->get(); 
        $this->selectedEstado = $this->estado[0]->id;
        /* Municipio Por defecto*/
        $this->municipio = municipiosmdl::where('id_estado', $this->estado[0]->id)->where('nombre', 'NO ESPECIFICADO')->get(); 
        $this->selectedMunicipio =  $this->municipio[0]->id;
        /*Ciudad Por defecto*/
        $this->ciudad = ciudadesmdl::where('id_municipio', $this->municipio[0]->id)->where('nombre', 'NO ESPECIFICADO')->get(); 
        $this->selectedCiudad = $this->ciudad[0]->id;
        /*Parroquia Por defecto*/
        $this->parroquia = parroquiasmdl::where('id_ciudad', $this->ciudad[0]->id)->where('nombre', 'NO ESPECIFICADO')->get(); 
        $this->selectedParroquia = $this->parroquia[0]->id;
        /*Sector Por defecto*/
        $this->sector = sectoresmdl::where('id_parroquia', $this->parroquia[0]->id)->where('nombre', 'NO ESPECIFICADO')->get(); 
        $this->id_defaultValue = $this->sector[0]->id;
        $this->selectedSector = $this->id_defaultValue;        

        $this->estados =$this->estado; // Inicializar como colección vacía
        $this->municipios = $this->municipio; // Inicializar como colección vacía
        $this->ciudades = $this->ciudad; // Inicializar como colección vacía
        $this->sectores = $this->sector; // Inicializar como colección vacía
        $this->parroquias = $this->parroquia; // Inicializar como colección vacía
        
    }

    // Método hook: se ejecuta automáticamente cuando cambia $selectedPais
    public function updatedselectedPais($paisId)
    {
      
          if (!empty($paisId)) {
            $this->estados = estadosmdl::where('id_pais', $paisId)->get();
            //->having('reviews_avg_rating', '>=', $value)
            $this->estado = estadosmdl::where('id_pais', $paisId)->where('nombre', 'NO ESPECIFICADO')->get(); 
            
            //dd($this->estado[0]->nombre);
            $this->id_defaultValue = $this->estado[0]->id;
            $this->defaultValue = $this->estado[0]->nombre;
        } else {
            $this->valorEspecifico = '';
            $this->estados= collect();
            $this->municipios = collect(); // Inicializar como colección vacía
            $this->ciudades = collect(); // Inicializar como colección vacía
            $this->sectores = collect(); // Inicializar como colección vacía
            $this->parroquias = collect(); // Inicializar como colección vacía
        }
        // Resetear el valor del segundo combo si cambia el primero
        $this->selectedEstado = $this->id_defaultValue;
        $this->selectedMunicipio = null;
        $this->selectedCiudad = null;
        $this->selectedSector = null;
        $this->selectedParroquia = null;
    }   


    // Método hook: se ejecuta automáticamente cuando cambia $selectedEstado
    public function updatedselectedEstado($estadoId)
    {
        
        if (!empty($estadoId)) {
            $this->municipios = municipiosmdl::where('id_estado', $estadoId)->get();
            $this->municipio = municipiosmdl::where('id_estado', $estadoId)->where('nombre', 'NO ESPECIFICADO')->get(); 
            //dd($estadoId,$this->municipios);
            //dd($this->estado[0]->nombre);
            $this->id_defaultValue = $this->municipio[0]->id;
            $this->defaultValue = $this->municipio[0]->nombre;            
        } else {
            $this->municipios = collect(); // Inicializar como colección vacía
            $this->ciudades = collect(); // Inicializar como colección vacía
            $this->sectores = collect(); // Inicializar como colección vacía
            $this->parroquias = collect(); // Inicializar como colección vacía
        }
        // Resetear el valor del segundo combo si cambia el primero
        $this->selectedMunicipio = $this->id_defaultValue;
        $this->selectedCiudad = null;
        $this->selectedSector = null;
        $this->selectedParroquia = null;
       
    }

    // Método hook: se ejecuta automáticamente cuando cambia $selectedMunicipio
    public function updatedselectedMunicipio($municipioId)
    {
  
        if (!empty($municipioId)) {
            $this->ciudades = ciudadesmdl::where('id_municipio', $municipioId)->get();
            $this->ciudad = ciudadesmdl::where('id_municipio', $municipioId)->where('nombre', 'NO ESPECIFICADO')->get() ?? null;
            $this->id_defaultValue = $this->ciudad[0]->id;
            $this->defaultValue = $this->ciudad[0]->nombre;  
                // Se ejecuta porque es null
        } else {
            $this->ciudades = collect();
            $this->sectores = collect(); // Inicializar como colección vacía
            $this->parroquias = collect(); // Inicializar como colección vacía
        }
        
        // Resetear el valor del segundo combo si cambia el primero
        $this->selectedCiudad = $this->defaultValue;
        $this->selectedSector = null;
        $this->selectedParroquia = null;
    }

    // Método hook: se ejecuta automáticamente cuando cambia $selectedMunicipio
    public function updatedselectedCiudad($ciudadId)
    {
        if (!empty($ciudadId)) {
            $this->parroquias = parroquiasmdl::where('id_ciudad', $ciudadId)->get();
            $this->parroquia = parroquiasmdl::where('id_ciudad', $ciudadId)->where('nombre', 'NO ESPECIFICADO')->get(); 
            $this->id_defaultValue = $this->parroquia[0]->id;
            $this->defaultValue = $this->parroquia[0]->nombre;            
        } else {
            $this->sectores = collect(); // Inicializar como colección vacía
            $this->parroquias = collect(); // Inicializar como colección vacía
        }
        
        // Resetear el valor del segundo combo si cambia el primero
         $this->selectedParroquia = $this->id_defaultValue;
         $this->selectedSector = null;
    }
    // Método hook: se ejecuta automáticamente cuando cambia $selectedMunicipio
    public function updatedselectedParroquia($parroquiaId)
    {
        if (!empty($parroquiaId)) {
            $this->sectores = sectoresmdl::where('id_parroquia', $parroquiaId)->get();
            $this->sector = sectoresmdl::where('id_parroquia', $parroquiaId)->where('nombre', 'NO ESPECIFICADO')->get(); 
            $this->id_defaultValue = $this->sector[0]->id;
            $this->defaultValue = $this->sector[0]->nombre;            
        } else {
            $this->sectores = collect(); // Inicializar como colección vacía
        }
        $this->selectedSector = $this->id_defaultValue;
    }
    public function render()
    {
        return view('livewire.generic.selectioncmb');
    }

};
?>

