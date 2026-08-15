<?php

namespace app\Models\militantes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class statusmdl extends Model
{
        use HasFactory;
    public $fecha; 
    protected $table = 'configuracion.tblstatus';
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [
    'id',
    'descripcion'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fecha = time(); // Establecer la fecha actual en formato timestamp
    }   
}
