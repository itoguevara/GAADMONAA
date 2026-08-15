<?php

namespace app\Models\datacenter;

use Illuminate\Database\Eloquent\Model;

class sexomdl extends Model
{
    //    use HasFactory;
    protected $table = 'datacenter.sexo';
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [
    'id',
    'nombre',
    'created_at',
    'updated_at'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fecha = time(); // Establecer la fecha actual en formato timestamp
    }   
}
