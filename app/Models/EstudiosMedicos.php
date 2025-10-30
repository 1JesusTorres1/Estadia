<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudiosMedicos extends Model
{
    use HasFactory;

    protected $table = 'estudios_medicos';

    protected $fillable = [
        'paciente_id',
        'doctor_id',
        'tipo_estudio',
        'descripcion',
        'fecha_estudio',
        'resultado',
        'estatus',
        'observaciones_doctor',
    ];

    protected $casts = [
        'fecha_estudio' => 'date',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
