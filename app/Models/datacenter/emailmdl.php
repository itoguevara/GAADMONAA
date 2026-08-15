<?php

namespace app\Models\datacenter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class emailmdl extends Model
{
    use HasFactory;
    public $fecha; 
    protected $table = 'datacenter.email';
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [
    'id',
    'emails',
    'id_persona',
    'idtipoemail',
    'activa'
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fecha = time(); // Establecer la fecha actual en formato timestamp
    }   
}
