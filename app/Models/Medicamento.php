<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicamento extends Model
{
    use HasFactory;
    protected $primaryKey = 'idmedicamentos';

    
    protected $fillable = [
        'nombre',
        'descripcion',
        'stock',
        'viaAdministracion',
    ];

    public function getRouteKeyName()
    {
        return 'idmedicamentos';
    }
}