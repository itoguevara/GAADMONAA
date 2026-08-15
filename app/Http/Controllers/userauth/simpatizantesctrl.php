<?php


namespace app\Http\Controllers\userauth;
use app\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use PublicFunctions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// Tablas de Personas
use app\Models\datacenter\personasmdl;
use app\Models\datacenter\direccionmdl;
use app\Models\datacenter\emailmdl;
use app\Models\datacenter\telefonomdl;
use app\Models\datacenter\solicitudmdl;
// Tablas de Simpatizantes
use app\Models\militantes\simpatizantemdl;
class simpatizantesctrl extends Controller
      
{
 public $MsgProcess = 'Errores en Los Datos Introducidos : ';
 public $dataentryrecord = [];
 public $solicitudesdata = [];
 public $datasimpatizante =[];    
    /**
     * Display a listing of the resource.
     */

  public function show(int $opcionvar, int $id_llamada=2)
    {
        session()->put('opcionvar', $opcionvar);
       //('Hola 01',get_defined_vars(),$opcionvar,session(['id_page_show']));
      $message = 'Inicio Exitoso';
     return view('home', compact('opcionvar','id_llamada'))->with($opcionvar);
    }

    public function BuildMessaFieldsArray($arraydata)
    {
     $this->dataentryrecord = $arraydata;
     //$request->session()->put(['dataentryrecord', $arraydata]);

    $MsgProcess = 'Los siguientes campos son obligatorios: ';
    // dump($arraydata,empty($arraydata['userdoc']), empty($arraydata['username']), empty($arraydata['userape']));
    // dump('Existe : ', array_key_exists('userdoc',$arraydata));
    
        if (array_key_exists('id_tipoper',$arraydata)) {
            if (empty($arraydata['id_tipoper'])) {
                    $this->MsgProcess .= 'Tipo de Persona, ';
            } else {
                // Verifico si el Nro de Cedula Existe
                $simpatizantesdata['userdoc'] = $arraydata['userdoc'];
                }
            } else 
                {
                   $this->MsgProcess .= 'Seleccione el Tipo de persona : (Venezolano, Extranjero,...etc)) '; 
                }

  

        if (array_key_exists('userdoc',$arraydata)) {
            if (empty($arraydata['userdoc'])) {
                    $this->MsgProcess .= 'Cédula, ';
            } else {
               $existe=personasmdl::where('cedula', '=', $arraydata['userdoc'],false)->exists();
                if ($existe) {
                    // user found
                    $this->MsgProcess .= 'Cédula : '.$arraydata['userdoc'].' Existe.';
                } else {
                // Verifico si el Nro de Cedula Existe
                $simpatizantesdata['userdoc'] = $arraydata['userdoc'];
                }
            }
        } else 
                {
                   $this->MsgProcess .= 'Introduzca el nro de Cedula.'; 
                }

        if (array_key_exists('username',$arraydata)) {
            if (empty($arraydata['username'])) {
                    $this->MsgProcess .= 'Nombre, ';
            } else {
                $simpatizantesdata['username'] = $arraydata['username'];
            }
        } else 
                {
                   $this->MsgProcess .= 'Introduzca el Nombre.'; 
                }


        if (array_key_exists('userape',$arraydata)) {
            if (empty($arraydata['userape'])) {
                    $this->MsgProcess .= 'Apellido, ';
            } else {
                $simpatizantesdata['userape'] = $arraydata['userape'];
            }
        } else 
                {
                   $this->MsgProcess .= 'Introduzca el Apellido.'; 
                }
        if (array_key_exists('useremail',$arraydata)) {
            if (empty($arraydata['useremail'])) {
                    $this->MsgProcess .= 'Email, ';
            } else {
                $simpatizantesdata['useremail'] = $arraydata['useremail'];
            }
        }  else 
                {
                   $this->MsgProcess .= 'Introduzca el Email.'; 
                }

        if (array_key_exists('usertel',$arraydata)) {
            if (empty($arraydata['usertel'])) {
                    $this->MsgProcess .= 'Teléfono, ';
            } else {
                $simpatizantesdata['usertel'] = $arraydata['usertel'];
            }
        } else 
                {
                   $this->MsgProcess .= 'Introduzca el Telefono.'; 
                }
        if (array_key_exists('selectedPais',$arraydata)) {
            if (empty($arraydata['selectedPais'])) {
                    $this->MsgProcess .= 'País, ';
            } else {
                $simpatizantesdata['id_pais'] = $arraydata['selectedPais'];
            }
        } else { $this->MsgProcess .= 'País, ';}

        if (array_key_exists('selectedEstado',$arraydata)) {
            if (empty($arraydata['selectedEstado'])) {
                    $this->MsgProcess .= 'Estado, ';
            } else {
                $simpatizantesdata['id_estado'] = $arraydata['selectedEstado'];
            }
        } else { $this->MsgProcess .= 'Estado, ';}

        if (array_key_exists('selectedMunicipio',$arraydata)) {
            if (empty($arraydata['selectedMunicipio'])) {
                    $this->MsgProcess .= 'Municipio, ';
            } else {
                $simpatizantesdata['id_municipio'] = $arraydata['selectedMunicipio'];
            }
        } else { $this->MsgProcess .= 'Municipio, ';}

        if (array_key_exists('selectedCiudad',$arraydata)) {
            
            if (empty($arraydata['selectedCiudad'])) {
                    $this->MsgProcess .= 'Ciudad, ';
            } else {
                $simpatizantesdata['id_ciudad'] = $arraydata['selectedCiudad'];
            }   
        } else { $this->MsgProcess .= 'Ciudad, ';}

        if (array_key_exists('selectedParroquia',$arraydata)) {
            if (empty($arraydata['selectedParroquia'])) {
                    $this->MsgProcess .= 'Parroquia, ';
            } else {
                $simpatizantesdata['id_parroquia'] = $arraydata['selectedParroquia'];
            }   
        } else { $this->MsgProcess .= 'Parroquia, ';}

        if (array_key_exists('selectedSector',$arraydata)) {
            if (empty($arraydata['selectedSector'])) {
                    $this->MsgProcess .= 'Sector, ';
            } else {
                $simpatizantesdata['id_sector'] = $arraydata['selectedSector'];
            }   
        } else { $this->MsgProcess .= 'Sector, ';}

        if (array_key_exists('userdir',$arraydata)) {
            if (empty($arraydata['userdir'])) {
                    $this->MsgProcess .= 'Direccion, ';
            } else {
                $simpatizantesdata['userdir'] = $arraydata['userdir'];
            }   
        }  else 
                {
                   $this->MsgProcess .= 'Introduzca La Direccion.'; 
                }

        $this->MsgProcess = substr_replace(substr($this->MsgProcess, 0, -1),'.',-1);  
         if (mb_strlen($this->MsgProcess, 'UTF-8') <= 39){
            $this->MsgProcess = '';
        }
    }
/**
 * Verificacion de Datos de los impatizantes
 * 
 */
    public function BuildMessaFieldsSimpaArray(Request $request,$arraydata = null)
    {
        //dd($arraydata);
        if (array_key_exists('id_persona',$arraydata)) {
            if (empty($arraydata['id_persona'])) {
                    $this->MsgProcess .= 'Identificacion de Persona, ';
            } else {
                $id_persona = Crypt::decrypt($arraydata['id_persona'] ?? -1);
                $this->datasimpatizante['id_persona'] = $id_persona;
            }
        } else 
                {
                   $this->MsgProcess .= 'Verifique el Identificador de la Persona.'; 
                }
        if (array_key_exists('id_solicitud',$arraydata)) {
            if (empty($arraydata['id_solicitud'])) {
                    $this->MsgProcess .= 'Identificacion de la Solicitud, ';
            } else {
                $id_solicitud = Crypt::decrypt($arraydata['id_solicitud'] ?? -1);
                $this->datasimpatizante['id_solicitud'] = $id_solicitud;
            }
        } else 
                {
                   $this->MsgProcess .= 'Verifique el Identificador de la Solicitud.'; 
                }

        if (array_key_exists('selectedMedioinfo',$arraydata)) {
            if (empty($arraydata['selectedMedioinfo'])) {
                    $this->MsgProcess .= 'Medio de Informacion, ';
            } else {
                $this->datasimpatizante['id_medio_informacion'] = $arraydata['selectedMedioinfo'];
            }   
        } else { $this->MsgProcess .= 'Medio de Informacion, ';}

        if (array_key_exists('selectedReferencia',$arraydata)) {
            if (empty($arraydata['selectedReferencia'])) {
                    $this->MsgProcess .= 'Referencia, ';
            } else {
                $this->datasimpatizante['id_simpa_refe'] = $arraydata['selectedReferencia'];
            }   
        } else { $this->MsgProcess .= 'Referencia, ';}

        if (array_key_exists('selectedVerificador',$arraydata)) {
            if (empty($arraydata['selectedVerificador'])) {
                    $this->MsgProcess .= 'Verificador, ';
            } else {
                $this->datasimpatizante['id_verificador'] = $arraydata['selectedVerificador'];
            }   
        } else { $this->MsgProcess .= 'Verificador, ';}

        if (array_key_exists('selectedTiposimpa',$arraydata)) {
            if (empty($arraydata['selectedTiposimpa'])) {
                    $this->MsgProcess .= 'Tipo de Simpatizante, ';
            } else {
                $this->datasimpatizante['id_tipo_simpatizante'] = $arraydata['selectedTiposimpa'];
            }   
        } else { $this->MsgProcess .= 'Tipo de Simpatizante, ';}

        if (array_key_exists('selectedIdeologia',$arraydata)) {
            if (empty($arraydata['selectedIdeologia'])) {
                    $this->MsgProcess .= 'Ideologia Politica, ';
            } else {
                $this->datasimpatizante['id_pensa_politico'] = $arraydata['selectedIdeologia'];
            }   
        } else { $this->MsgProcess .= 'Ideologia Politica, ';}

        if (array_key_exists('selectedStatusconfirmacion',$arraydata)) {
            if (empty($arraydata['selectedStatusconfirmacion'])) {
                    $this->MsgProcess .= 'Status de Confirmacion, ';
            } else {
                $this->datasimpatizante['id_status_confirmacion'] = $arraydata['selectedStatusconfirmacion'];
            }   
        } else { $this->MsgProcess .= 'Status de Confirmacion, ';}


        if (array_key_exists('observ',$arraydata)) {
            if (empty($arraydata['observ'])) {
                    $this->MsgProcess .= 'Observacion, ';
            } else {
                $this->datasimpatizante['de_observ'] = $arraydata['observ'];
            }   
        }  else 
                {
                   $this->MsgProcess .= 'Introduzca Informacion Adicional del Simpatizante.'; 
                }      
        // Si todo esta Bien Limpio la Data de Control de Mensajes        
        if (strtoupper(trim($this->MsgProcess)) == strtoupper(trim('Errores en Los Datos Introducidos : ')))
            {
                $this->MsgProcess = '';
                //dd(auth()->id());
                $userId = $request->user()?->id;
  
                if (Auth::check()== true) {
                    $this->datasimpatizante['id_usercreate'] = $userId;
                }
                else {
                    $this->datasimpatizante['id_usercreate'] = -1;
                }
                $this->datasimpatizante['created_at'] = now();
                $this->datasimpatizante['update_at'] = now();
                $this->datasimpatizante['fe_usercreate'] = now();

                
            }
    }
     

     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,int $opcionvar)
    {
        $FunctionsPublic = new PublicFunctions();
        $datos = $request->all();
        
        
       
        //dump('revisa',$datos);
/*        
        $validatedData = $request->validate([
        'id_simpatizante' => 'nullable|numeric|max:18',
        'id_tipoper' =>'nullable|numeric|max:18',
        'userdoc' => 'required|string|max:15',
        'username' => 'required|string|max:100',
        'userape' => 'required|string|max:100',
        'fec_nac' => 'required|date|before_or_equal:-18 years',
        'useremail' => 'required|email|unique:users,email',
        'usertel' => 'nullable|string|max:15',
        'sexo' => 'required|string|max:1',
        'id_edocivil'  => 'nullable|numeric|max:18',
        'id_paisnaci'  => 'nullable|numeric|max:18',
        'id_nacionalidad'  => 'nullable|numeric|max:18',
        'id_profesion'  => 'nullable|numeric|max:18',
        'id_ocupacion' => 'nullable|numeric|max:18',
        'selectedPais' => 'nullable|numeric|max:18',
        'selectedEstado' => 'nullable|numeric|max:18',
        'selectedMunicipio' => 'nullable|numeric|max:18',
        'selectedCiudad' => 'nullable|numeric|max:18',
        'selectedParroquia' => 'nullable|numeric|max:18',
        'selectedSector' => 'nullable|numeric|max:18',
        'userdir' => 'required|string|max:15'
        ]);       
*/
        //dump('Después de Validar',$datos,get_defined_vars());
        //dd('revisa');
        //dd(isset($simpatizantesdata['save']),isset($simpatizantesdata['exit']), $simpatizantesdata, $opcionvar);
        

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
            $FunctionsPublic->id_solicitud = Crypt::decrypt($datos['id_solicitud'] ?? -1);
            $id_solicitud = Crypt::decrypt($datos['id_solicitud'] ?? -1);
            $FunctionsPublic->id_simpatizante = Crypt::decrypt($datos['id_simpatizante'] ?? -1);
            $id_simpatizante = Crypt::decrypt($datos['id_simpatizante'] ?? -1);
            $FunctionsPublic->id_persona = Crypt::decrypt($datos['id_persona'] ?? -1);
            $id_persona =$FunctionsPublic->id_persona;
            $FunctionsPublic->id_accion = $datos['id_accion'] ?? -1;    
            $FunctionsPublic->id_llamada = $datos['id_llamada'] ?? -1; 
            $id_llamada = $datos['id_llamada'] ?? -1; 
            if ($FunctionsPublic->id_llamada == 1 ) { // LLamada para verificar datos de la solicitud
                $this->BuildMessaFieldsArray($datos);
            } elseif ($FunctionsPublic->id_llamada == 2 ) // LLamada para verificar datos de los solicitantes
            {
                $this->BuildMessaFieldsSimpaArray($request,$datos);
            }
            //dd($_SERVER['REQUEST_METHOD'],$FunctionsPublic->id_llamada,$this->MsgProcess);   
           if (mb_strlen($this->MsgProcess, 'UTF-8') > 0){
                if (isset($_POST['save'])) {
                    $messageok = $this->MsgProcess;
                    //dd($messageok);
                    return redirect()->route('simpatizante.edit', ['id_persona' => Crypt::encrypt($id_persona),'id_solicitud' =>Crypt::encrypt($id_solicitud),'id_simpatizante' =>Crypt::encrypt($id_simpatizante),'id_accion' => '4','id_llamada' => $id_llamada, 'dataentryrecord' => $this->dataentryrecord ?? null, 'MsgProcess' => $this->MsgProcess ])->with('success', $messageok);

                } elseif (isset($_POST['exit' ])) {
                    $message = '';
                    return redirect()->route('generic.show', ['0'])->with('success', $message);
                }
            } elseif (mb_strlen($this->MsgProcess, 'UTF-8') == 0) {
                if (isset($_POST['save'])) {

                    if ($FunctionsPublic->id_llamada == 1 ) { // LLamada para grabar la solicitud
                        // Creo la nueva Persona //
                        $persona = personasmdl::create([
                                'cedula' => $this->dataentryrecord['userdoc'],
                                'nombre' => $this->dataentryrecord['username'],
                                'apellido' => $this->dataentryrecord['userape'],
                                'fec_nac' => $this->dataentryrecord['fec_nac'],
                                'id_edo_civil' => $this->dataentryrecord['id_edocivil'] ?? null,
                                'cant_hijo' => 0,
                                'id_ocupacion' =>  $this->dataentryrecord['id_ocupacion'] ?? null,
                                'id_profesion' =>  $this->dataentryrecord['id_profesion'] ?? null,
                                'codpostal' => '0000',
                                'id_banca' => '1',
                                'sexo' => $this->dataentryrecord['sexo'] ?? null,
                                'id_nacionalidad' =>   $this->dataentryrecord['id_nacionalidad'] ?? null,
                                'id_pais_nacimiento' =>   $this->dataentryrecord['id_paisnaci'] ?? null,
                                'id_tipopersona' =>   $this->dataentryrecord['id_tipoper'] ?? null,
                                'activo' => true
                            ]);
                            session()->put('recordpersona', $persona);
                        // Grabo la Direccion //
                        $direccion = direccionmdl::create([
                                'id_tipo_dire' => 1,
                                'direccion' => $this->dataentryrecord['userdir'],
                                'id_persona' => $persona->id,
                                'id_ciudad' => $this->dataentryrecord['selectedCiudad'] ?? null,
                                'id_parroquia' => $this->dataentryrecord['selectedParroquia'] ?? null,
                                'id_sector' => $this->dataentryrecord['selectedSector'] ?? null,
                                'id_estado' => $this->dataentryrecord['selectedEstado'] ?? null,
                                'id_pais' => $this->dataentryrecord['selectedPais'] ?? null
                            ]);
                        // Grabo el Telefono //
                        $telefono = telefonomdl::create([
                                'cod_internacional' => '+58',
                                'cod_area' => '0000',
                                'telefono' => $this->dataentryrecord['usertel'] ?? null,
                                'id_persona' => $persona->id,
                                'idtipo' => 1
                            ]);
                        // Grabo el Email //
                        $email = emailmdl::create([
                                'emails' => $this->dataentryrecord['useremail'] ?? null,
                                'id_persona' => $persona->id,
                                'idtipoemail' => 4,
                                'activa' => true
                            ]);
                        // Grabo la Solicitud //    
                        $nro_sol= DB::select('SELECT militantes.getnextnro(?)', [0]);  
                        $solicitud = solicitudmdl::create([
                                        'id_persona' => $persona->id,
                                        'nro_sol' => $nro_sol[0]->getnextnro,
                                        'observacion' => 'Solicitud Inicial de registro de simpatizante',
                                        'id_status' => 1,
                                        'fecha' => now(),
                                        'id_tipo_sol' => 1
                                        ]);
                        // Grabo el Simpatizante //
                        //$simpatizantesmdl = simpatizantemdl::create($validated);
                        $this->MsgProcess = '¡Hola, !'.$this->dataentryrecord['username'].', '.$this->dataentryrecord['userape'].'! Qué bueno que ya formas parte de nuestra comunidad en la plataforma. Ya estamos trabajando en lo que nos pediste'.' Nos pondremos en contacto contigo pronto para coordinar los siguientes pasos.';
   
                    return redirect()->route('simpatizante.edit', ['id_persona' =>Crypt::encrypt($persona->id),'id_solicitud' =>Crypt::encrypt($solicitud->id),'id_simpatizante' =>Crypt::encrypt(-1),'id_llamada' => '1','id_accion' => '4', 'MsgProcess' => $this->MsgProcess])->with('success', $this->MsgProcess);
                    }elseif ($FunctionsPublic->id_llamada == 2 ) { // LLamada para grabar el Solicitante
                        $simpatizante = simpatizantemdl::create([
                        'id_persona' => $this->datasimpatizante['id_persona'],
                        'id_tipo_simpatizante' => $this->datasimpatizante['id_tipo_simpatizante'],
                        'id_usercreate' => $this->datasimpatizante['id_usercreate'],
                        'fe_usercreate' => $this->datasimpatizante['fe_usercreate'],
                        'id_verificador' => $this->datasimpatizante['id_verificador'],
                        'id_status_confirmacion' => $this->datasimpatizante['id_status_confirmacion'],
                        'de_observ' => $this->datasimpatizante['de_observ'],
                        'id_pensa_politico' => $this->datasimpatizante['id_pensa_politico'],
                        'id_solicitud' => $this->datasimpatizante['id_solicitud'],
                        'created_at' => $this->datasimpatizante['created_at'],
                        'update_at' => $this->datasimpatizante['update_at']
                        ]);
                        $id_simpatizante = $simpatizante->id;
                        $id_persona = $this->datasimpatizante['id_persona'];
                        // Actualizo la Solicitud
                        solicitudmdl::where('id', $id_solicitud)->update(['id_status' => 3]); // Coloco la SOlicitud como Verificada
                        return redirect()->route('simpatizante.edit', ['id_solicitud' =>Crypt::encrypt($id_solicitud),'id_simpatizante' =>Crypt::encrypt($id_simpatizante),'id_persona' =>Crypt::encrypt($id_persona),'id_llamada' => '2','id_accion' => '4', 'MsgProcess' => $this->MsgProcess])->with('success', $this->MsgProcess);

                      //dd('Por Aqui',$this->datasimpatizante,$simpatizante,$_SERVER['REQUEST_METHOD'],$this->MsgProcess,isset($_POST['save']),$FunctionsPublic->id_llamada);
                    
                    }
               } elseif (isset($_POST['exit' ])) { 
                    $message = '';
                    return redirect()->route('generic.show', ['0'])->with('success', $message);
                }
           // dd(isset($_POST['save']),isset($_POST['exit']), $simpatizantesdata, $opcionvar);
            }
        }
    }
    /** Get Data de Solicitudes**/
        function GetDataSolicitud(int $id_data_search, int $id_opcion)   
        {
            $this->solicitudesdata = collect(); // Inicializar como colección vacía
            if ($id_opcion == -1) { // Buscar Todas Las Solcitudes
                $this->solicitudesdata = DB::table('militantes.vwsolicitudes')
                        ->distinct()
                        ->select(['id', 'id_persona', 'cedula', 'persona', 'fecha', 'id_tipo_sol', 'tipo_sol', 'nro_sol', 'observacion', 'id_status', 'status'])                     
                        ->orderBy('vwsolicitudes.id', 'asc')
                        ->paginate(5);
            } elseif ($id_opcion == 0) { // Buscar solicitud por ID
                $this->solicitudesdata = DB::table('militantes.vwsolicitudes')
                        ->distinct()
                        ->select(['id', 'id_persona', 'cedula', 'persona', 'fecha', 'id_tipo_sol', 'tipo_sol', 'nro_sol', 'observacion', 'id_status', 'status'])                     
                        ->where('vwsolicitudes.id', '=', $id_data_search)
                        ->get();
                    }
            return $this->solicitudesdata;    
     }
    /**
     * Display the specified resource.
     */
    function GetDatasimpatizante(int $id_data_search, int $id_opcion)   
        {
            if ($id_opcion == -1) { // Buscar simpatizante por ID
                $simpatizantesdata = DB::table('militantes.vwsimpatizantes')
                        ->distinct()
                        ->select(['vwsimpatizantes.id', 'vwsimpatizantes.cedula', 'vwsimpatizantes.nombre', 'vwsimpatizantes.apellido', 'vwsimpatizantes.fec_nac', 'vwsimpatizantes.direccion','vwsimpatizantes.telefono','vwsimpatizantes.emails','vwsimpatizantes.id_status'])                     
                        ->orderBy('vwsimpatizantes.id', 'asc')
                        ->paginate(5);
                    return $simpatizantesdata;    
            } elseif ($id_opcion == 0) { // Buscar simpatizante por ID
                $simpatizantesdata = DB::table('militantes.vwsimpatizantes')
                        ->distinct()
                        ->select(['vwsimpatizantes.id', 'vwsimpatizantes.cedula', 'vwsimpatizantes.nombre', 'vwsimpatizantes.apellido', 'vwsimpatizantes.fec_nac', 'vwsimpatizantes.direccion','vwsimpatizantes.telefono','vwsimpatizantes.emails'])                     
                        ->where('vwsimpatizantes.id', '=', $id_data_search)
                        ->get();
                    return $simpatizantesdata;    
                
            } elseif ($id_opcion == 1) { // Buscar simpatizante por id de Persona
            
                $simpatizantesdata = DB::table('militantes.vwsimpatizantes')
                        ->distinct()
                        ->select(['vwsimpatizantes.id', 'vwsimpatizantes.cedula', 'vwsimpatizantes.nombre', 'vwsimpatizantes.apellido', 'vwsimpatizantes.fec_nac', 'vwsimpatizantes.direccion','vwsimpatizantes.telefono','vwsimpatizantes.emails'])                     
                        ->where('vwsimpatizantes.id_persona', '=', $id_data_search)
                        ->get();
                    return $simpatizantesdata;

            } elseif ($id_opcion == 2) { // Buscar simpatizante por cédula
                    $simpatizantesdata = DB::table('militantes.vwsimpatizantes')
                        ->distinct()
                        ->select(['vwsimpatizantes.id', 'vwsimpatizantes.cedula', 'vwsimpatizantes.nombre', 'vwsimpatizantes.apellido', 'vwsimpatizantes.fec_nac', 'vwsimpatizantes.direccion','vwsimpatizantes.telefono','vwsimpatizantes.emails'])                     
                        ->where('vwsimpatizantes.cedula', '=', $id_data_search)
                        ->get();
                    return $simpatizantesdata;    
            } elseif ($id_opcion == 3) { // Buscar simpatizante por nombre
                $simpatizantesdata = DB::table('militantes.vwsimpatizantes')
                        ->distinct()
                        ->select(['vwsimpatizantes.id', 'vwsimpatizantes.cedula', 'vwsimpatizantes.nombre', 'vwsimpatizantes.apellido', 'vwsimpatizantes.fec_nac', 'vwsimpatizantes.direccion','vwsimpatizantes.telefono','vwsimpatizantes.emails'])                     
                        ->where('vwsimpatizantes.nombre', 'like', "%$id_data_search%"       )
                        ->get();
                    return $simpatizantesdata;    

            } elseif ($id_opcion == 4) { // Buscar simpatizante por apellido
                $simpatizantesdata = DB::table('militantes.vwsimpatizantes')
                        ->distinct()
                        ->select(['vwsimpatizantes.id', 'vwsimpatizantes.cedula', 'vwsimpatizantes.nombre', 'vwsimpatizantes.apellido', 'vwsimpatizantes.fec_nac', 'vwsimpatizantes.direccion','vwsimpatizantes.telefono','vwsimpatizantes.emails'])                     
                        ->where('vwsimpatizantes.apellido', 'like', "%$id_data_search%")
                        ->get();
                    return $simpatizantesdata;
                
            } else {
                return collect(); // Retorna una colección vacía si el tipo de módulo no es válido
            }
        }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(simpatizantemdl $simpatizantesmdl, Request $request)
   {
    // Verificar si el Usuario esta Autenticado
    
     $FunctionsPublic = new PublicFunctions();
     $datos = $request->all();
    $FunctionsPublic->id_solicitud = Crypt::decrypt($datos['id_solicitud'] ?? -1);
    $FunctionsPublic->id_persona = Crypt::decrypt($datos['id_persona'] ?? -1);
    $recordpersona = personasmdl::where('id', '=', $FunctionsPublic->id_persona,false)->get();
    session()->put('recordpersona', $recordpersona);
    $FunctionsPublic->id_simpatizante = Crypt::decrypt($datos['id_simpatizante'] ?? -1);
    $FunctionsPublic->id_accion = $datos['id_accion'] ?? -1;    
    $FunctionsPublic->id_llamada = $datos['id_llamada'] ?? -1;
    $opcionvar = $datos['opcionvar'] ?? 0;
    $MsgProcess = $datos['MsgProcess'] ?? -1;
    
    // dd($datos);
   

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_simpatizante = $datos['id_simpatizante'] ?? -1;
            $simpatizantesmdl = simpatizantemdl::find($id_simpatizante);
            if (!$simpatizantesmdl) {
                return redirect()->back()->with('error', 'Simpatizante no encontrado.');
            }
            $simpatizantesmdl->fill($datos);
            $simpatizantesmdl->save();  
            return redirect()->back()->with('success', 'Simpatizante actualizado exitosamente.');
         } elseif ($_SERVER['REQUEST_METHOD'] === 'GET'){ 
             //dump('Hola 01',get_defined_vars());
            $id_llamada =  $FunctionsPublic->id_llamada;

            //dump('Antes : '.$opcionvar,$FunctionsPublic->id_accion,$_SERVER['REQUEST_METHOD']);

            $message = '';
            if ($FunctionsPublic->id_llamada == 1 ) { // LLamada desde el reporte de Solicitud y despues de grabar la solicitud
                $id_simpatizante = $FunctionsPublic->id_simpatizante;
                $recordsolicitud = solicitudmdl::where('id', '=', $FunctionsPublic->id_solicitud,false)->get();
                session()->put('recordsolicitud', $recordsolicitud,false);
                //dump($FunctionsPublic->id_accion);
                if ($FunctionsPublic->id_accion == 1) { // Edicion de la Solicitud
                    //dump(Auth::check());
                    if (Auth::check() == true) { // Establecer opción para edición en Usuarios Autorizados
                        $opcionvar = 8; //  Para Enviar al reporte de Solicitudes
                    } else {
                        $opcionvar = 2; //  Para Mostrar Mensaje del registro de Solicitud en el Data Entry de Solicitud                        } 
                    }   

                    ;
                } elseif ($FunctionsPublic->id_accion == 2) { // Impresion de la Solicitud
                    $opcionvar = 2; // Establecer opción para edición por Venir de 
                } elseif ($FunctionsPublic->id_accion == 3) { // Eliminar de la Solicitud
                    $opcionvar = 3; // Establecer opción para edición por Venir de 
                } elseif ($FunctionsPublic->id_accion == 4) { // Se Grabo el Registro de Solicitud 
                        if (Auth::check() == true) { // Establecer opción para edición en Usuarios Autorizados
                            $opcionvar = 6; //  Para Enviar al reporte de Solicitudes
                        } else {
                            $opcionvar = 5; //  Para Mostrar Mensaje del registro de Solicitud en el Data Entry de Solicitud                        } 
                        }   
                    }
                else {
                    $message = 'Accion no permitida para Actualizacion de Solicitudes.';
                }
                //dump('Controlador : '.$opcionvar);
                $dataentryrecord = $datos['dataentryrecord'] ?? Null;
                return view('home', compact(['dataentryrecord','opcionvar','id_llamada','MsgProcess']));   
                //return redirect()->route('home', ['opcionvar'=> $opcionvar,'dataentryrecord' => $this->dataentryrecord ?? null, 'MsgProcess' => $this->MsgProcess ])->with('success', $messageok);

                                                                   
            } elseif ($FunctionsPublic->id_llamada == 2) { // LLamada desde el reporte de Solicitudes Para Crear los Simpatizantes
                //dd('Antes : '.$opcionvar,$FunctionsPublic->id_accion,$FunctionsPublic->id_llamada);
                $id_simpatizante = -1;
                $id_llamada = $FunctionsPublic->id_llamada;
                $id_solicitud = $FunctionsPublic->id_solicitud;
                $recordsolicitud = solicitudmdl::where('id', '=', $id_solicitud,false)->get();
                //dd($recordsolicitud,$id_solicitud,$FunctionsPublic->id_solicitud);
                if ($recordsolicitud){
                    $id_persona = solicitudmdl::where('id', '=',$id_solicitud,false)->value('id_persona');
                }
                $recordpersona = PublicFunctions::GetDataObject(11,'',$id_persona); // Ejemplo de uso de sesión para almacenar Los Datos de los Verificadores
                session()->put('recordpersona', $recordpersona,false);

                if ($FunctionsPublic->id_accion == 1) { // Edicion de la Verificacion de la Solicitud y crear al Simpatizante
                    $opcionvar = 2; // Establecer opción para edición
                } elseif ($FunctionsPublic->id_accion == 2) { // Impresion de los Datos del Simpatizante
                    $opcionvar = 2; // Establecer opción para edición por Venir de 
                } elseif ($FunctionsPublic->id_accion == 3) { // Eliminar Datos del Simpatizante
                    $opcionvar = 6; // Establecer opción para Reportes de Solicitudes
                    $eliminado = solicitudmdl::where('id', '=',$id_solicitud)->delete();
                    if ($eliminado) {
                        $MsgProcess = "Registro Eliminado exitosamente.";
                    } else {$MsgProcess = "Error Eliminando el Registro de la Solicitud.";}

                } elseif ($FunctionsPublic->id_accion == 4) { // Se Grabo el Registro del Simpatizante
                    //dd(Auth::check());
                    if (Auth::check()== true) {
                        $opcionvar = 6; //  Lo envio al reporte de solicitudes cargadas.
                    }
                    else {
                        $opcionvar = 2; //  Para Mostrar Mensaje del registro de Simpatizante en el Data Entry de Simpatizantes
                    }                
                }   
                else {
                    $message = 'Accion no permitida para Actualizacion de Solicitudes.';
                }
                $id_persona =  $FunctionsPublic->id_persona;
                $dataentryrecord = $recordpersona ?? Null;
                //dump('Despues : '.$opcionvar,$id_solicitud);
                //dump('Despues 00: '.$MsgProcess);
                return view('home', compact(['dataentryrecord','opcionvar','id_llamada','id_solicitud','id_persona','MsgProcess']));
                //return redirect()->route('home', ['opcionvar'=> $opcionvar,'dataentryrecord' => $this->dataentryrecord ?? null, 'MsgProcess' => $this->MsgProcess ])->with('success', $this->MsgProcess);


            }   
        }
    }                       
     //
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, simpatizantemdl $simpatizantesmdl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(simpatizantemdl $simpatizantesmdl)
    {
        //
    }
}
