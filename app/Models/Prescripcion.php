<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescripcion extends Model
{
    protected $table = 'prescripciones'; 

    protected $casts = [
        'fecha_prescripcion' => 'date', 
        'fecha_fin_consumo' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'paciente_id',
        'doctor_id',
        'medicamento_id', 
        'dosis',
        'indicaciones',
        'fecha_prescripcion',
        'fecha_fin_consumo'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'medicamento_id');
    }
}
