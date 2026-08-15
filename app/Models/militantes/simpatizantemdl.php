<?php

namespace app\Models\militantes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class simpatizantemdl extends Model
{
    public $timestamps = false;
    use HasFactory;
    public $fecha; 
    
    protected $table = 'militantes.simpatizantes';
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [
    'id',
    'id_persona',
    'id_tipo_simpatizante',
    'id_usercreate',
    'fe_usercreate',
    'id_confirmante',
    'id_verificador',
    'id_status_confirmacion',
    'de_observ',
    'id_pensa_politico',
    'id_solicitud',
    'created_at',
    'updated_at'    
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fecha = time(); // Establecer la fecha actual en formato timestamp
    }   



}
