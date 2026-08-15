<?php

namespace app\Models\datacenter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personasmdl extends Model
{
    /** @use HasFactory<\Database\Factories\Datacenter\personasmdlFactory> */
    use HasFactory;
     public $fecha; 
   
    protected $table = 'datacenter.persona';
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['cedula',
                            'nombre',
                            'apellido',
                            'fec_nac',
                            'id',
                            'id_edo_civil',
                            'cant_hijo',
                            'id_ocupacion',
                            'id_profesion',
                            'codpostal',
                            'id_banca',
                            'sexo',
                            'id_nacionalidad',
                            'id_pais_nacimiento',
                            'id_tipopersona',
                            'activo'
                          ];
    public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
            $this->fecha = time(); // Establecer la fecha actual en formato timestamp
        }    //
}
