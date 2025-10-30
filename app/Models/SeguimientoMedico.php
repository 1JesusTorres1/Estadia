<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeguimientoMedico extends Model
{
    use HasFactory;

    protected $table = 'seguimientos_medicos';

    protected $fillable = [
        'patient_id',
        'fecha_seguimiento',
        'motivo_consulta',
        'observaciones_doctor',
        'estudios_solicitados',
        'plan_tratamiento',
        'proxima_cita',
    ];

    protected $casts = [
        'fecha_seguimiento' => 'datetime',
        'proxima_cita' => 'date',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

}
