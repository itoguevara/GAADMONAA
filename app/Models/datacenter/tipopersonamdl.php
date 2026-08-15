<?php

namespace app\Models\datacenter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipopersonamdl extends Model
{
    use HasFactory;
    protected $table = 'datacenter.tipo_persona';
    protected $primaryKey = 'id';
    protected $dateFormat = 'd-m-Y H:i:s';
    protected $fillable = [
        'id',
        'descripcion',
        'created_at',
        'updated_at'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fecha = time(); // Establecer la fecha actual en formato timestamp
    }   
}
