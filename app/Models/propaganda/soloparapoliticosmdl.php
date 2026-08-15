<?php

namespace app\Models\propaganda;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class soloparapoliticosmdl extends Model
{
    use HasFactory;
    public $fecha; 
    protected $table = 'propaganda.soloparapoliticos';
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [
    'id',
    'titulo',
    'descripcion',
    'ruta'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fecha = time(); // Establecer la fecha actual en formato timestamp
    }   
}
