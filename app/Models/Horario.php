<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'doctor_id',
        'fechaHorario',
        'horaInicio',
        'horaFin',
    ];

    protected $casts = [
        'fechaHorario' => 'date',
        'horaInicio' => 'datetime', 
        'horaFin' => 'datetime', 
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
