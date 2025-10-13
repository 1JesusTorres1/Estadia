<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Paciente extends Model
{
    protected $table = 'pacientes';

    protected $fillable = [
        'user_id',
        'fechaRegistro',
        'tipoDiabetes',
        'sexo',
        'fecha_nacimiento', // Importante: usa el nombre exacto de la columna de la migración
    ];

    protected $casts = [
        'fechaRegistro' => 'date',
        'fecha_nacimiento' => 'date',
    ];

    

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function historialMedico(): HasOne
    {
        return $this->hasOne(HistorialMedico::class, 'patient_id');
    }

    public function mediciones(): HasMany
    {
        return $this->hasMany(Medicion::class, 'patient_id');
    }

    public function seguimientosMedicos(): HasMany
    {
        return $this->hasMany(SeguimientoMedico::class, 'patient_id');
    }

    public function prescripciones(): HasMany 
    {
        return $this->hasMany(Prescripcion::class, 'paciente_id'); 
    }


}
