<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CitaController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        
        // Asumiendo que has definido la relación 'citas' en Paciente.php
        $paciente = $user->paciente;

        $citas = $paciente->citas()
                         ->with('doctor') // Cargar la información del doctor
                         ->orderBy('fecha_hora', 'desc')
                         ->get();

        return view('paciente.citas.index', [
            'proximasCitas' => $citas->filter(fn($c) => $c->fecha_hora->isFuture() && $c->estado !== 'cancelada'),
            'citasPasadas' => $citas->filter(fn($c) => $c->fecha_hora->isPast() || $c->estado === 'atendida'),
        ]);
    }

    /**
     * Muestra el formulario para agendar una cita (selección de doctor y horario).
     */
    public function create(): View
    {
        // Obtener solo los usuarios con rol 'doctor'
        $doctores = User::where('rol', 'doctor')->get(['id', 'name', 'apellido']);
        
        // Aquí deberías cargar la lógica para obtener los HORARIOS DISPONIBLES.
        // Por simplicidad, solo pasamos los doctores por ahora.
        
        return view('paciente.citas.agendar', [
            'doctores' => $doctores,
        ]);
    }
    
    /**
     * Almacena una nueva cita en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'motivo' => 'required|string|max:255',
        ]);
        
        // Combina fecha y hora para el campo datetime
        $fecha_hora = $request->input('fecha') . ' ' . $request->input('hora') . ':00';
        
        // Obtener la instancia del paciente autenticado
        $paciente = Auth::user()->paciente;

        if (!$paciente) {
            return back()->withErrors(['error' => 'Tu perfil de paciente no está completo.']);
        }
        
        // 1. **VERIFICACIÓN DE DISPONIBILIDAD** (Lógica avanzada: Comparar con horarios y citas existentes)
        // Esta es la parte más crítica y faltaría la lógica de horarios reales aquí.
        // ... (Tu lógica para verificar si el doctor está realmente disponible en esa fecha/hora)

        Cita::create([
            'paciente_id' => $paciente->id,
            'doctor_id' => $request->doctor_id,
            'fecha_hora' => $fecha_hora,
            'motivo' => $request->motivo,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('paciente.citas.consultar')->with('status', 'cita-agendada');
    }
}