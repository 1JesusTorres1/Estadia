<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horarios = Horario::where('doctor_id', auth()->user()->id)
            ->orderBy('fechaHorario','asc')
            ->get();

        $ultimoHorario = $horarios->first();

        return view('doctor.horarios.index', compact('horarios', 'ultimoHorario'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fechaHorario' => 'required|date',
            'horaInicio' => 'required',
            'horaFin' => 'required|after:horaInicio'
        ]);

        $doctorId = auth()->user()->id;
        $fechaSeleccionada = $request->fechaHorario;

        $horarioExistente = Horario::where('doctor_id', $doctorId)
            ->where('fechaHorario', $fechaSeleccionada)
            ->first();

        if($horarioExistente){
            $rangoExistente = $horarioExistente->horaInicio . ' - ' . $horarioExistente->horaFin;
        
            return redirect()->back()->withErrors([
                'fechaHorario' => "Ya tienes un horario registrado para el día $fechaSeleccionada en el rango: $rangoExistente. 
                Por favoredita el existente o elige otra fecha."
            ])->withInput();
        }

        Horario::create([
            'doctor_id' => $doctorId,
            'fechaHorario' => $fechaSeleccionada,
            'horaInicio' => $request->horaInicio,
            'horaFin' => $request->horaFin,
        ]);

        return redirect()->route('doctor.pacientes.mediciones', $paciente_id)->with('success', 'Estudio médico registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horario $horario)
    {
        if($horario->doctor_id !== auth()->user()->id){
            abort(403);
        }
        return view('doctor.horarios.edit', compact('horario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Horario $horario)
    {
        if ($horario->doctor_id !== auth()->user()->id){
            return redirect()->back()->withErrors(['error' => 'No tienes permiso para actualizar este horario.']);
        }

        $request->validate([
            'fechaHorario' => 'required|date',
            'horaInicio' => 'required',
            'horaFin' => 'required|after:horaInicio'
        ]);

        $fechaSeleccionada = $request->fechaHorario;
        $doctorId = auth()->user()->id;

        $horarioExistente = Horario::where('doctor_id', $doctorId)
            ->where('fechaHorario', $fechaSeleccionada)
            ->where('id', '!=', $horario->id)
            ->first();
        
        if($horarioExistente){
            $rangoExistente = $horarioExistente->horaInicio . ' - ' . $horarioExistente->horaFin;
            return redirect()->back()->withErrors([
                'fechaHorario' => 'Ya existe otro horario registrado para el día $fechaSeleccionada en el reango: $rangoExistente.'
            ])->withInput();
        }

        $horario->update([
            'fechaHorario' => $request->fechaHorario,
            'horaInicio' => $request->horaInicio,
            'horaFin' => $request->horaFin,
        ]);

        return redirect()->back()->with('success', 'Horario actualizado correctamente.');        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horario $horario)
    {
        if ($horario->doctor_id !== auth()->user()->id) {
            return redirect()->back()->withErrors(['error' => 'No tienes permiso para eliminar este horario.']);
        }
        
        $horario->delete();

        return redirect()->route('doctor.horarios.index')->with('success', 'horario eliminado correctamente.');
    }
}
