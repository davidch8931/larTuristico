<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoAtraccion;

class TipoAtraccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoAtracciones = TipoAtraccion::all();
        return view('tipoAtraccion.index', compact('tipoAtracciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipoAtraccion.nuevo');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = [
            'nombre_at' => $request->nombre_at,
        ];
        
        TipoAtraccion::create($datos);
        return redirect()->route('tipoAtraccion.index')->with('message', 'Tipo de atracción creado exitosamente');
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
        $tipoAtraccion = TipoAtraccion::findOrFail($id);
        return view('tipoAtraccion.editar', compact('tipoAtraccion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tipoAtraccion = TipoAtraccion::findOrFail($id);
        $datos = [
            'nombre_at' => $request->nombre_at,
        ];
        
        $tipoAtraccion->update($datos);
        return redirect()->route('tipoAtraccion.index')->with('message', 'Tipo de atracción actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TipoAtraccion::destroy($id);
        return redirect()->route('tipoAtraccion.index')->with('message', 'Tipo de atracción eliminado correctamente');
    }
}