<?php



namespace app\Models\datacenter;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Attributes\Table;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ciudadesmdl extends Model

{

protected $table = 'datacenter.ciudad';

    use HasFactory;

    protected $primaryKey = 'id';

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $fillable = [

    'id',

    'nombre',

    'id_municipio',

    'created_at',

    'updated_at'    

    ];

    public function __construct(array $attributes = [])

    {

        parent::__construct($attributes);

        $this->fecha = time(); // Establecer la fecha actual en formato timestamp

    }   

}