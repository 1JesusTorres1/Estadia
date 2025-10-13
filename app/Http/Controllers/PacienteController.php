<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Medicamento;
use App\Models\Prescripcion;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    /**
     * Muestra la página de detalles de un paciente específico, incluyendo su historial.
     */
    public function show(User $user): View
    {
        // Cargar las relaciones para tener acceso a los datos del paciente y su historial
        $user->load('paciente.historialMedico');

        return view('doctor.pacientes.historialMedico', [
            'user' => $user,
        ]);
    }

    /**
     * Actualiza el historial médico de un paciente.
     */
    public function updateHistorial(Request $request, User $user): RedirectResponse
    {
        // Validar los datos que vienen del formulario
        $validated = $request->validate([
            'antecedentesFamiliares' => 'nullable|string',
            'alergias' => 'nullable|string',
            'enfermedades' => 'nullable|string',
            'notasMedicas' => 'nullable|string',
        ]);

        // Asegurarse de que el historial médico exista y actualizarlo
        if ($user->paciente && $user->paciente->historialMedico) {
            $user->paciente->historialMedico->update($validated);
        }

        // Redirigir de vuelta a la página de detalles con un mensaje de éxito
        return redirect()->route('doctor.pacientes.historialMedico', $user)->with('status', 'historial-actualizado');
    }

    public function createHistorial(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'antecedentesFamiliares' => 'nullable|string',
            'alergias' => 'nullable|string',
            'enfermedades' => 'nullable|string',
            'notasMedicas' => 'nullable|string',
        ]);
        if ($user->paciente && !$user->paciente->historialMedico) {
            $user->paciente->historialMedico()->create($validated);
        }
        return redirect()->route('doctor.pacientes.historialMedico', $user)->with('status', 'historial-creado');
    }

    public function miHistorial(): View
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Cargar las relaciones para tener acceso a los datos de forma eficiente
        $user->load('paciente.historialMedico');

        // Devolver una nueva vista de solo lectura
        return view('paciente.historialMedico', [
            'user' => $user,
        ]);
    }

    public function verMediciones(User $user): View
    {
        $user->load(['paciente.mediciones']); 

        return view('doctor.pacientes.mediciones', [
            'user' => $user,
        ]);
    }

    public function misMediciones(): View
    {
        $user = Auth::user();
        $user->load('paciente.mediciones');

        return view('paciente.mediciones', [
            'user' => $user,
        ]);
    }

    public function CreateMedicion(Request $request, User $user): RedirectResponse
    {
        // Validar los datos que vienen del formulario
        $validated = $request->validate([
            'fecha' => 'required|date',
            'glucosa' => 'required|numeric',
            'presionSistolica' => 'nullable|string',
            'presionDiastolica' => 'nullable|string',
            'peso' => 'nullable|numeric',
            'altura' => 'nullable|numeric',
            'notas' => 'nullable|string',
        ]);

        // Crear una nueva medición asociada al paciente
        if ($user->paciente) {
            $user->paciente->mediciones()->create($validated);
        }

        // Redirigir de vuelta a la página de mediciones con un mensaje de éxito
        return redirect()->route('doctor.pacientes.mediciones', $user)->with('status', 'medicion-agregada');
    }

    public function verPrescripciones(User $user): View
    {
        $user->load(['paciente.prescripciones.medicamento']); 

        $medicamentos = Medicamento::all();

        return view('doctor.pacientes.prescripcion', [
            'user' => $user,
            'medicamentos' => $medicamentos,
        ]);
    }
    
    public function CreatePrescripcion(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'medicamento_id' => 'required|exists:medicamentos,id', 
            'dosis' => 'required|string|max:255',
            'indicaciones' => 'nullable|string',
            'fecha_prescripcion' => 'required|date',
            'fecha_fin_consumo' => 'nullable|date|after_or_equal:fecha_prescripcion',
        ]);

        if ($user->paciente) {
            $user->paciente->prescripciones()->create([ 
                'medicamento_id' => $validated['medicamento_id'],
                'dosis' => $validated['dosis'],
                'indicaciones' => $validated['indicaciones'],
                'fecha_prescripcion' => $validated['fecha_prescripcion'],
                'fecha_fin_consumo' => $validated['fecha_fin_consumo'] ?? null,
                'doctor_id' => Auth::id(), 
            ]);
        }

        return redirect()->route('doctor.pacientes.prescripcion.ver', $user)->with('status', 'prescripcion-agregada');    
    }

    public function misPrescripciones(): View
{
    $user = Auth::user();

    $user->load(['paciente.prescripciones.medicamento', 'paciente.prescripciones.doctor']);

    return view('paciente.prescripciones', [
        'user' => $user,
    ]);
}
}
