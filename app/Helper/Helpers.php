<?php


use Illuminate\Support\Facades\DB;
// Modelos del schema de Datacenter
use app\Models\datacenter\paisesmdl;
use app\Models\datacenter\edocivilmdl;
use app\Models\datacenter\profesionmdl;
use app\Models\datacenter\ocupacionmdl;
use app\Models\datacenter\nacionalidadmdl;
use app\Models\datacenter\tipopersonamdl;
use app\Models\datacenter\sexomdl;
// Modelos del schema de Militantes
use app\Models\militantes\mediosinfomdl;
use app\Models\militantes\statusconfirmacionmdl;
use app\Models\militantes\statusmdl;
use app\Models\militantes\tipossimpamdl;
use app\Models\militantes\pensapolimdl;
use app\Models\militantes\tiposolicitudmdl;
use app\Models\militantes\simpatizantemdl;




class PublicFunctions
{
    /** Variables Publicas Generales */
    public $id_solicitud = -1;
    public $report_option = 0;
    public $id_persona = -1;
    public $id_simpatizante = -1;
    public $id_page_show =  0;
    public $swi_solnew = true;
    public $id_accion = 0;
    public $id_llamada = 0;
    public $nro_sol = 'SOL-0000';
    /** Variables Publicas de Registros de Tipos */
    public $recordverificadores = null; // Variable para almacenar registros de Verificadores de Solicitud
    public $recordsimpatizante = null;
    public $recordsimpatizantes = null;
    public $recordempresa = null; // Variable para almacenar los Datos de la Empresa
    public $recordtipopersona= null; // Variable para almacenar registros de Tipo de personas
    public $recordsolicitudes = null; // Variable para almacenar todos los registros de solicitudes
    public $recordartispp = null; // Variable para almacenar todos los registros de los Articulos de Solo Para Politicos

    public $selectedPais = null; // Variable para almacenar el país seleccionado
    public $selectedEstados = null; // Variable para almacenar el Estado seleccionado
    public $selectedMunicipios = null; // Variable para almacenar el Municipio seleccionado
    public $selectedCiudades = null; // Variable para almacenar la Ciudad seleccionada
    public $selectedSexos = null; // Variable para almacenar el Sexo seleccionado

    public function __construct()
    {
 
    }
    public static function CargaInicialDataRecord(){
        session(['dataentryrecord' => null]);
        session(['paises' => paisesmdl::all()]); //  Carga Todos Los Estados civiles
        session(['profesiones' => profesionmdl::all()]); //  Carga Todas Las profesiones
        session(['ocupaciones' => ocupacionmdl::all()]); //  Carga Todas las Ocupaciones
        session(['nacionalidades' => nacionalidadmdl::all()]); //  Carga Todas Las Nacionalidades
        session(['edociviles' => edocivilmdl::all()]); //  Carga Todos Los Estados civiles
        session(['tipospersona' => tipopersonamdl::all()->toArray()]); //  Carga Todos Los tipos de persona
        session(['sexos' => sexomdl::all()]); //  Carga Todos Los Sexos
        session(['tipossimpa' => tipossimpamdl::all()]); // Ejemplo de uso de sesión para almacenar Los Datos del Tipo de Simpatizante
        session(['statusconfirmacion' => statusconfirmacionmdl::all()]); // Ejemplo de uso de sesión para almacenar Los Datos del Status de Confirmación de las Solicitudes
        session(['mediosinfo' => mediosinfomdl::all()]); // Ejemplo de uso de sesión para almacenar Los Datos de los Medios de Informacion
        session(['status' => statusmdl::all()]); // Ejemplo de uso de sesión para almacenar Los Datos del Status General de  las Solicitudes
        session(['pensapoli' => pensapolimdl::all()]); // Ejemplo de uso de sesión para almacenar Los Datos de los Pensamientos Politicos
        session(['tiposolicitud' => tiposolicitudmdl::all()]); // Ejemplo de uso de sesión para almacenar Los Datos de tipos de solicitud
        session(['recordempresa' => PublicFunctions::GetDataObject(14,'',-1)]); // Ejemplo de uso de sesión para almacenar Los Datos de la Empresa
        session(['recordcliente' => PublicFunctions::GetDataObject(15,'',-1)]); // Ejemplo de uso de sesión para almacenar Los Datos del Cliente
        session(['id_persona_user' => $id_persona_user ?? -1]); // Ejemplo de uso de sesión para almacenar id de la Persona del usuario Activo
        session(['id_simpatizante' => $recordsimpatizante[0]->id ?? -1]); // Ejemplo de uso de sesión para almacenar Los Datos del Simpatizante
        session(['verificadores' => PublicFunctions::GetDataObject(28,'',-1)]); // Ejemplo de uso de sesión para almacenar Los Datos de los Verificadores
        session(['referencias' => PublicFunctions::GetDataObject(12,'',-1)]); // Ejemplo de uso de sesión para almacenar Los Datos de los Verificadores
        session(['selectedPais' => $selectedPais ?? null]); // Ejemplo de uso de sesión para almacenar el país seleccionado
        session(['selectedEstados' => $selectedEstados ?? null]); // Ejemplo de uso de sesión para almacenar el Estado seleccionado
        session(['selectedMunicipios' => $selectedMunicipios ?? null]); // Ejemplo de uso de sesión para almacenar el Municipio seleccionado
        session(['selectedCiudades' => $selectedCiudades ?? null]); // Ejemplo de uso de sesión para almacenar la Ciudad seleccionada
        session(['id_page_show' => $id_page_show ?? 0]); // Ejemplo de uso de sesión para almacenar id de la Pagina a mostrar
        session(['recordpersona' => PublicFunctions::GetDataObject(11,'',-1)]); // Ejemplo de uso de sesión para almacenar Los Datos de la Empresa
        }

    public static function GetNextNroSol()
    {
        $lastNroSol = DB::table('militantes.solicitud')
            ->select('nro_sol')
            ->orderByDesc('id')
            ->first();

        if ($lastNroSol && preg_match('/SO-(\d{5})/', $lastNroSol->nro_sol, $matches)) {
            $nextNumber = (int)$matches[1] + 1;
            return 'SO-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
        } else {
            return 'SO-00001'; // Valor inicial si no hay registros
        }
    }   

// Función para obtener un objeto de datos según el ID de opción proporcionado

public static function GetDataObject(int $id_opcion_search, string $search_term = '', int $id_search = -1)
    {
        
    switch ($id_opcion_search) {
        case -1:  // Buscar Status
            $recorddataobject = DB::table('configuracion.tblstatus')
                            ->distinct()
                            ->select(['tblstatus.id', 'tblstatus.descripcion'])
                            ->whereNotNull('tblstatus.id')
                            ->where('tblstatus.id', '>', 0)
                            ->orderBy('tblstatus.descripcion')
                            ->get();
                            
            break;
        
        case 0:  // Buscar Status
            $recorddataobject = DB::table('militantes.status_confirmacion')
                            ->distinct()
                            ->select(['status_confirmacion.id', 'status_confirmacion.descripcion'])
                            ->whereNotNull('status_confirmacion.id')
                            ->where('status_confirmacion.id', '>', 0)
                            ->orderBy('status_confirmacion.descripcion')
                            ->get();  
            break;
        case 1:  // Buscar Tipos de Personas
            $recorddataobject = DB::table('datacenter.tipo_persona')
                            ->distinct()
                            ->select(['tipo_persona.id', 'tipo_persona.descripcion'])
                            ->whereNotNull('tipo_persona.id')
                            ->where('tipo_persona.id', '>', 0)
                            ->orderBy('tipo_persona.descripcion')
                            ->get();  
            break;
        case 2: // Buscar tipos de direcciones/Emails/Telefonos
            $recorddataobject = DB::table('datacenter.tipo_dir_telf_email')
                            ->distinct()
                            ->select(['tipo_dir_telf_email.id', 'tipo_dir_telf_email.nombre'])
                            ->whereNotNull('tipo_dir_telf_email.id')
                            ->where('tipo_dir_telf_email.id', '>', 0)
                            ->orderBy('tipo_dir_telf_email  .nombre')
                            ->get();
            break;
        case 3: // Buscar profesiones
            $recorddataobject = DB::table('datacenter.profesion')
                            ->distinct()
                            ->select(['profesion.id', 'profesion.nombre'])
                            ->whereNotNull('profesion.id')
                            ->where('profesion.id', '>', 0)
                            ->orderBy('profesion.nombre')
                            ->get();
            break;
        case 4: // Buscar Ocupaciones
            $recorddataobject = DB::table('datacenter.ocupacion')
                            ->distinct()
                            ->select(['ocupacion.id', 'ocupacion.descripcion'])
                            ->whereNotNull('ocupacion.id')
                            ->where('ocupacion.id', '>', 0)
                            ->orderBy('ocupacion.descripcion')
                            ->get();
            break;
        case 5: // Buscar nacionalidades
            $recorddataobject = DB::table('datacenter.nacionalidad')
                            ->distinct()
                            ->select(['nacionalidad.id', 'nacionalidad.nombre'])
                            ->whereNotNull('nacionalidad.id')
                            ->where('nacionalidad.id', '>', 0)
                            ->orderBy('nacionalidad.nombre')
                            ->get();
            break;
        case 6: // Buscar Paises
            $recorddataobject = DB::table('datacenter.pais')
                            ->distinct()
                            ->select(['pais.id', 'pais.nombre', 'pais.codigo_telefonico', 'pais.gentilicio'])
                            ->whereNotNull('pais.id')
                            ->where('pais.id', '>', 0)
                            ->orderBy('pais.nombre')
                            ->get();
            break;
        case 6: // Buscar estados
            $recorddataobject = DB::table('datacenter.estado')
                            ->distinct()
                            ->select(['estado.id', 'estado.nombre', 'estado.codigo_iso', 'estado.id_pais'])
                            ->whereNotNull('estado.id')
                            ->where('estado.id', '>', 0)
                            ->orderBy('estado.nombre')
                            ->get();
            break;                    
        case 7: // Buscar Municipios
            $recorddataobject = DB::table('datacenter.municipio')
                            ->distinct()
                            ->select(['municipio.id', 'municipio.nombre', 'municipio.id_estado'])
                            ->whereNotNull('municipio.id')
                            ->where('municipio.id', '>', 0)
                            ->orderBy('municipio.nombre')
                            ->get();
            break;
        case 8: // Buscar Ciudades
            $recorddataobject = DB::table('datacenter.ciudad')
                            ->distinct()
                            ->select(['ciudad.id', 'ciudad.nombre', 'ciudad.id_municipio'])
                            ->whereNotNull('ciudad.id')
                            ->where('ciudad.id', '>', 0)
                            ->orderBy('ciudad.nombre')
                            ->get();
            break; 
        case 9: // Todas las SOlicitudes    
            $recorddataobject = DB::table('militantes.vwsolicitudes')
                            ->distinct()
                            ->select(['id', 'id_persona', 'cedula', 'persona', 'fecha', 'id_tipo_sol', 'tipo_sol', 'nro_sol', 'observacion', 'id_status', 'status'])
                            ->whereNotNull('vwsolicitudes.id')
                            ->where('vwsolicitudes.id', '>', 0)
                            ->orderBy('vwsolicitudes.fecha')
                            ->paginate(20);
            break;  
        case 10: // Solicitud por ID    
            $recorddataobject = DB::table('militantes.vwsolicitudes')
                            ->distinct()
                            ->select(['id', 'id_persona', 'cedula', 'persona', 'fecha', 'id_tipo_sol', 'tipo_sol', 'nro_sol', 'observacion', 'id_status', 'status'])
                            ->whereNotNull('vwsolicitudes.id')
                            ->where('vwsolicitudes.id', '=', $id_search)
                            ->orderBy('vwsolicitudes.fecha')
                            ->get();
            break;                                     
        case 11: // Personas por ID    
            $recorddataobject = DB::table('datacenter.vwpersonas')
                            ->distinct()
                            ->select(['id','cedula', 'nombre', 'apellido', 'fec_nac', 'sexo', 'edocivil', 'paisnacimiento', 'ocupacion', 'profesion', 'direccion', 'telefono', 'emails','idtipo', 'tipo',])
                            ->whereNotNull('vwpersonas.id')
                            ->where('vwpersonas.id', '=', $id_search)
                            ->orderBy('vwpersonas.apellido')
                            ->get();
            break;                                     
        case 12: // Datos de Simpatizantes
                $recorddataobject = DB::table('militantes.vwsimpatizantes')
                                ->distinct()
                                ->select(['id', 'simpatizante'])
                                ->whereNotNull('vwsimpatizantes.id_persona')
                                ->where('vwsimpatizantes.id', '>', 0)
                                ->orderBy('vwsimpatizantes.simpatizante')
                                ->get();
                break;              

        case 13: // Tidpo Documentos
            $recorddataobject = DB::table('militantes.tipo_documentos')
                            ->distinct()
                            ->select(['tipo_documentos.id', 'tipo_documentos.descripcion'])
                            ->whereNotNull('tipo_documentos.id')
                            ->where('tipo_documentos.id', '>', 0)
                            ->orderBy('tipo_documentos.descripcion')
                            ->paginate(20);
            break;              
        case 14: // Datos de la Empresa
            $recorddataobject = DB::table('configuracion.vwempresa')
                            ->distinct()
                            ->select(['id_empresa', 'razonsocial', 'docfiscal', 'representante', 'direccionfiscal', 'emails', 'telefono'])
                            ->whereNotNull('vwempresa.id_empresa')
                            ->where('vwempresa.id_empresa', '>', 0)
                            ->orderBy('vwempresa.id_empresa')
                            ->get();
            break;              
        case 15: // Datos del Simpatizante
            $recorddataobject = DB::table('militantes.vwsimpatizantes')
                            ->distinct()
                            ->select(['id', 'id_persona', 'cedula','nombre', 'apellido', 'direccion', 'telefono', 'emails'])
                            ->whereNotNull('vwsimpatizantes.id_persona')
                            ->where('vwsimpatizantes.id', '>', 0)
                            ->where('vwsimpatizantes.id', '=', session('id_simpatizante'))
                            ->orderBy('vwsimpatizantes.id')
                            ->get();
            break;              
        case 16:  // Buscar Tipos de Parentescos entre Personas
            $recorddataobject = DB::table('datacenter.tipo_parentesco')
                            ->distinct()
                            ->select(['tipo_parentesco.id', 'tipo_parentesco.descripcion', 'tipo_parentesco.letra'])
                            ->whereNotNull('tipo_parentesco.id')
                            ->where('tipo_parentesco.id', '>', 0)
                            ->orderBy('tipo_parentesco.descripcion')
                            ->get();  
            break;
        case 17:  // Buscar Tipos de Profesiones
            $recorddataobject = DB::table('datacenter.profesion')
                            ->distinct()
                            ->select(['profesion.id', 'profesion.nombre'])
                            ->whereNotNull('profesion.id')
                            ->where('profesion.id', '>', 0)
                            ->orderBy('profesion.nombre')
                            ->get();  
            break;
        case 18:  // Buscar Tipos de Ocupaciones
            $recorddataobject = DB::table('datacenter.ocupacion')
                            ->distinct()
                            ->select(['ocupacion.id', 'ocupacion.descripcion'])
                            ->whereNotNull('ocupacion.id')
                            ->where('ocupacion.id', '>', 0)
                            ->orderBy('ocupacion.descripcion')
                            ->get();  
            break;
        case 19:  // Buscar Tipos de Grados de Instruccion
            $recorddataobject = DB::table('datacenter.tipo_gradoinstruccion')
                            ->distinct()
                            ->select(['tipo_gradoinstruccion.id', 'tipo_gradoinstruccion.descripcion', 'tipo_gradoinstruccion.letra'])
                            ->whereNotNull('tipo_gradoinstruccion.id')
                            ->where('tipo_gradoinstruccion.id', '>', 0)
                            ->orderBy('tipo_gradoinstruccion.id')
                            ->get();  
            break;
        case 20: // Parentesco por id
            $recorddataobject = DB::table('datacenter.tipo_parentesco')
                            ->distinct()
                            ->select(['tipo_parentesco.id', 'tipo_parentesco.descripcion', 'tipo_parentesco.letra'])
                            ->whereNotNull('tipo_parentesco.id')
                            ->where('tipo_parentesco.id', '=', $id_search)
                            ->orderBy('tipo_parentesco.descripcion')
                            ->get();  
            break;            
        case 21: // Grado de Instruccion por id
            $recorddataobject = DB::table('datacenter.tipo_gradoinstruccion')
                            ->distinct()
                            ->select(['tipo_gradoinstruccion.id', 'tipo_gradoinstruccion.descripcion', 'tipo_gradoinstruccion.letra'])
                            ->whereNotNull('tipo_gradoinstruccion.id')
                            ->where('tipo_gradoinstruccion.id', '=', $id_search)
                            ->orderBy('tipo_gradoinstruccion.id')
                            ->get();  
            break;            
        case 22: // Tipo de Simpatizantes       
            $recorddataobject = DB::table('militantes.tipo_simpatizante')
                            ->distinct()
                            ->select(['tipo_simpatizante.id', 'tipo_simpatizante.descripcion'])
                            ->whereNotNull('tipo_simpatizante.id')
                            ->where('tipo_simpatizante.id', '>', 0)
                            ->orderBy('tipo_simpatizante.descripcion')
                            ->get();
                        break;                         
            case 23:  // Buscar Paises
                $recorddataobject = DB::table('datacenter.pais')
                            ->distinct()
                            ->select(['pais.id', 'pais.nombre'])
                            ->whereNotNull('pais.id')
                            ->where('pais.id', '>', 0)
                            ->orderBy('pais.nombre')
                            ->get();  
                            break;
            case 24:  // Buscar Estados
                $recorddataobject = DB::table('datacenter.estado')
                            ->distinct()
                            ->select(['estado.id', 'estado.nombre'])
                            ->whereNotNull('estado.id')
                            ->where('estado.id', '>', 0)
                            ->orderBy('estado.nombre')
                            ->get();  
                            break;
            case 25:  // Buscar municipios
                $recorddataobject = DB::table('datacenter.municipio')
                            ->distinct()
                            ->select(['municipio.id', 'municipio.nombre'])
                            ->whereNotNull('municipio.id')
                            ->where('municipio.id', '>', 0)
                            ->orderBy('municipio.nombre')
                            ->get();  
                            break;
            case 26:  // Buscar Ciudades
                $recorddataobject = DB::table('datacenter.ciudad')
                            ->distinct()
                            ->select(['ciudad.id', 'ciudad.nombre'])
                            ->whereNotNull('ciudad.id')
                            ->where('ciudad.id', '>', 0)
                            ->orderBy('ciudad.nombre')
                            ->get();  
                            break;
            case 27:  // Medios de Informacion
                $recorddataobject = DB::table('militantes.medios_info')
                            ->distinct()
                            ->select(['medios_info.id', 'medios_info.nombre', 'medios_info.letra'])
                            ->whereNotNull('medios_info.id')
                            ->where('medios_info.id', '>', 0)
                            ->orderBy('medios_info.nombre')
                            ->get();  
                            break;
            case 28: // Datos de Verificadores
                $recorddataobject = DB::table('militantes.vwsimpatizantes')
                                ->distinct()
                                ->select(['id', 'simpatizante'])
                                ->whereNotNull('vwsimpatizantes.id_persona')
                                ->where('vwsimpatizantes.id_tipo', '=', 3)
                                ->orderBy('vwsimpatizantes.simpatizante')
                                ->get();
                break;              


        default:
            $recorddataobject = null; // O manejar el caso de opción no válida
    }
    return $recorddataobject;
    }      


// Función para obtener un modelo específico según el ID proporcionado
    public static function GetDataModel($id)
    {
        $dataModel = null;
        switch ($id) {
            case 1:
                $dataModel = new \app\Models\datacenter\personasmdl();
                break;
            case 2:
                $dataModel = new \app\Models\userauth\solicitudmdl();
                break;
            case 3:
                $dataModel   = new \app\Models\userauth\usuadatamdl();
                break;
            default:
                // Manejar el caso en que el ID no coincide con ningún modelo
                throw new \InvalidArgumentException("ID de modelo no válido: " . $id);
        }
        return $dataModel;
    }
}