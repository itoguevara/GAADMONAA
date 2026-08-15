<?php

namespace app\Models\datacenter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class telefonomdl extends Model
{
    //
    public $fecha; 
    use HasFactory;
    protected $table = 'datacenter.telefono';
    protected $primaryKey = 'id';
    protected $dateFormat = 'd-m-Y H:i:s';
    protected $fillable = [
        'id',
        'cod_internacional',
        'cod_area',
        'telefono',
        'id_persona',
        'idtipo'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fecha = time(); // Establecer la fecha actual en formato timestamp
    }   
}
