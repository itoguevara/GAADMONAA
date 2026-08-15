<?php

namespace app\Models\datacenter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class direccionmdl extends Model
{
public $fecha; 
use HasFactory;
protected $table = 'datacenter.direccion';
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [
    'id',
    'id_tipo_dire',
    'direccion',
    'id_persona',
    'id_ciudad',
    'id_parroquia',
    'id_sector',
    'id_estado',
    'id_pais'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fecha = time(); // Establecer la fecha actual en formato timestamp
    }   
}
