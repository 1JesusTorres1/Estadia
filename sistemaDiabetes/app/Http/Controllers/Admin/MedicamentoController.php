<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicamentos = Medicamento::paginate(10);
        return view('admin.medicamentos.index', compact('medicamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.medicamentos.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'stock' => 'nullable|integer',
            'viaAdministracion' => 'required|string|max:45',
        ]);

        Medicamento::create($request->all());

        // La redirección debe ser a la lista de medicamentos
        return redirect()->route('admin.medicamentos.index')->with('success', 'Medicamento creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicamento $medicamento)
    {
        return view('admin.medicamentos.edit', compact('medicamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicamento $medicamento)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'stock' => 'nullable|integer',
            'viaAdministracion' => 'required|string|max:45',
        ]);

        $medicamento->update($request->all());

        return redirect()->route('admin.medicamentos.index')->with('success', 'Medicamento actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicamento $medicamento)
    {
        $medicamento->delete();

        return redirect()->route('admin.medicamentos.index')->with('success', 'Medicamento eliminado correctamente.');
    }

}
