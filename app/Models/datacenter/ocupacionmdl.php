<?php

namespace app\Models\datacenter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ocupacionmdl extends Model
{
    use HasFactory;
    protected $table = 'datacenter.ocupacion';
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';
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
