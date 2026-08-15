<?php

namespace app\Models\datacenter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class solicitudmdl extends Model
{
    public $fecha; 
    use HasFactory;
    protected $table = 'militantes.solicitud';
    protected $primaryKey = 'id';
    protected $dateFormat = 'd-m-Y H:i:s';
    protected $fillable = [
            'id',
            'id_persona',
            'nro_sol',
            'observacion',
            'id_status',
            'fecha',
            'id_tipo_sol',
            'created_at',
            'updated_at'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fecha = time(); // Establecer la fecha actual en formato timestamp
    }   
}
