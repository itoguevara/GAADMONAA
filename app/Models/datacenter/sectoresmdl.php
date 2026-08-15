<?php

namespace app\Models\datacenter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class sectoresmdl extends Model
{
    use HasFactory;
protected $table = 'datacenter.sectores';
    protected $primaryKey = 'id';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = [
        'id',
        'nombre',
        'id_parroquia',
        'created_at',
        'updated_at'        
        ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fecha = time(); // Establecer la fecha actual en formato timestamp
    }  //

}
