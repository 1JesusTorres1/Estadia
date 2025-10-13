<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeguimientoMedico extends Model
{
    use HasFactory;

    /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'seguimientos_medicos';

    /*
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'patient_id',
        'fecha_seguimiento',
        'motivo_consulta',
        'observaciones_doctor',
        'estudios_solicitados',
        'plan_tratamiento',
        'proxima_cita',
    ];

    /*
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_seguimiento' => 'datetime',
        'proxima_cita' => 'date',
    ];

    /*
     * Get the patient that owns the medical follow-up.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

}
