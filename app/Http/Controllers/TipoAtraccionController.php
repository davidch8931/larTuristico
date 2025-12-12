<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoAtraccion;
use Illuminate\Support\Facades\Validator;

class TipoAtraccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
        $validator = Validator::make($request->all(), [
            'nombre_at' => 'required|unique:tipo_atraccion,nombre_at'
        ], [
            'nombre_at.required' => 'Por favor ingrese el nombre del tipo de atracción',
            'nombre_at.unique' => 'El nombre del tipo de atracción ya existe'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
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
        
        $validator = Validator::make($request->all(), [
            'nombre_at' => 'required|unique:tipo_atraccion,nombre_at,' . $id . ',id_atraccion'
        ], [
            'nombre_at.required' => 'Por favor ingrese el nombre del tipo de atracción',
            'nombre_at.unique' => 'El nombre del tipo de atracción ya existe'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
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
        $tipoAtraccion = TipoAtraccion::findOrFail($id);

        if ($tipoAtraccion->lugaresTuristicos()->count() > 0) {
            return redirect()->route('tipoAtraccion.index')
                ->with('error', 'No se puede eliminar el tipo de atracción porque tiene lugares turísticos registrados.');
        }

        TipoAtraccion::destroy($id);
        return redirect()->route('tipoAtraccion.index')->with('message', 'Tipo de atracción eliminado correctamente');
    }
}