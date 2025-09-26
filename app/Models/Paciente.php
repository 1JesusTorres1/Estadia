<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
