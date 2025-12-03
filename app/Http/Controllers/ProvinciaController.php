<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;
use Illuminate\Support\Facades\Validator; // Agregar esto

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provincias = Provincia::all();
        return view('provincia.index', compact('provincias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('provincia.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre_prov' => 'required|unique:provincia,nombre_prov'
        ], [
            'nombre_prov.required' => 'Por favor ingrese el nombre de la provincia',
            'nombre_prov.unique' => 'El nombre de la provincia ya existe'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $datos = [
            'nombre_prov' => $request->nombre_prov,
        ];
        
        Provincia::create($datos);
        return redirect()->route('provincias.index')->with('message', 'Provincia creada exitosamente');
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
    public function edit(string $id)
    {
        $provincia = Provincia::findOrFail($id);
        return view('provincia.editar', compact('provincia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $provincia = Provincia::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'nombre_prov' => 'required|unique:provincia,nombre_prov,' . $id
        ], [
            'nombre_prov.required' => 'Por favor ingrese el nombre de la provincia',
            'nombre_prov.unique' => 'El nombre de la provincia ya existe'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $datos = [
            'nombre_prov' => $request->nombre_prov,
        ];
        
        $provincia->update($datos);
        return redirect()->route('provincias.index')->with('message', 'Provincia actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $provincia = Provincia::findOrFail($id);

        if ($provincia->lugaresTuristicos()->count() > 0) {
            return redirect()->route('provincias.index')
                ->with('error', 'No se puede eliminar la provincia porque tiene lugares turísticos registrados.');
        }

        Provincia::destroy($id);
        return redirect()->route('provincias.index')->with('message', 'Provincia eliminada correctamente');
    }
}