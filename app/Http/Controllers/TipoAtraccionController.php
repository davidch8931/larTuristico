<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LugarTuristico;
use App\Models\Provincia;
use App\Models\TipoAtraccion;
use Illuminate\Support\Facades\Validator;

class LugarTuristicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lugaresTuristicos = LugarTuristico::all();
        return view('lugarTuristico.index', compact('lugaresTuristicos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provincias = Provincia::all();
        $tipos = TipoAtraccion::all();
        return view('lugarTuristico.nuevo', compact('provincias', 'tipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:lugar_turistico,nombre'
        ], [
            'nombre.required' => 'Por favor ingrese el nombre del lugar turístico',
            'nombre.unique' => 'El nombre del lugar turístico ya existe'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $datos = [
            'nombre' => $request->nombre,
            'coordenadas' => $request->coordenadas,
            'descripcion' => $request->descripcion,
            'anio' => $request->anio,
            'accesibilidad' => $request->accesibilidad,
            'fk_id_provincia' => $request->fk_id_provincia,
            'fk_id_tipo' => $request->fk_id_tipo,
        ];
        
        LugarTuristico::create($datos);
        return redirect()->route('lugarTuristico.index')->with('message', 'Lugar turístico creado exitosamente');
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
        $lugarTuristico = LugarTuristico::findOrFail($id);
        $provincias = Provincia::all();
        $tipos = TipoAtraccion::all();
        return view('lugarTuristico.editar', compact('lugarTuristico', 'provincias', 'tipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lugarTuristico = LugarTuristico::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:lugar_turistico,nombre,' . $id
        ], [
            'nombre.required' => 'Por favor ingrese el nombre del lugar turístico',
            'nombre.unique' => 'El nombre del lugar turístico ya existe'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $datos = [
            'nombre' => $request->nombre,
            'coordenadas' => $request->coordenadas,
            'descripcion' => $request->descripcion,
            'anio' => $request->anio,
            'accesibilidad' => $request->accesibilidad,
            'fk_id_provincia' => $request->fk_id_provincia,
            'fk_id_tipo' => $request->fk_id_tipo,
        ];
        
        $lugarTuristico->update($datos);
        return redirect()->route('lugarTuristico.index')->with('message', 'Lugar turístico actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        LugarTuristico::destroy($id);
        return redirect()->route('lugarTuristico.index')->with('message', 'Lugar turístico eliminado correctamente');
    }
}