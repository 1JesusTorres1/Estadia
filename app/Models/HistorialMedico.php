<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistorialMedico extends Model
{
    use HasFactory;

    protected $table = 'historial_medicos';

    protected $fillable = [
        'patient_id',
        'alergias',
        'antecedentesFamiliares',
        'enfermedades',
        'notasMedicas',
    ];

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class, 'patient_id');
    }
}
