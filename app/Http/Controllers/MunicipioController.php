<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($departamentoid)
    {
        $municipio = Municipio::where('Id_Departamento','=',$departamentoid)->get();
        return response()->json($municipio,200);
    }

    public function indexActivo($departamentoid)
    {
        $municipio = Municipio::where('Id_Departamento','=',$departamentoid)->get();
        return response()->json($municipio,200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($departamentoid)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $municipio = new Municipio();
        $municipio->Id_Estado = config('global.Id_EstadoActivo');
        $municipio->Id_Departamento = $request->input('Id_Departamento');
        $municipio->Nombre = $request->input('Nombre');
        $municipio->Id_UsuarioCrea = $request->input('Id_UsuarioCrea');
        $municipio->FechaModifica = null;
        $municipio->Id_UsuarioModifica = null;
        $municipio->save();
        return response()->json($municipio,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Municipio  $municipio
     * @return \Illuminate\Http\Response
     */
    public function show($municipioid)
    {
        $municipio = Municipio::findOrFail($municipioid);
        return response()->json($municipio,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Municipio  $municipio
     * @return \Illuminate\Http\Response
     */
    public function edit(Municipio $municipio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Municipio  $municipio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $municipioid)
    {
        $municipio = Municipio::findOrFail($municipioid);
        $municipio->Nombre = $request->input('Nombre');
        $municipio->Id_UsuarioModifica = $request->input('Id_UsuarioModifica');
        $municipio->Id_Departamento = $request->input('Id_Departamento');
        $municipio->save();
        return response()->json($municipio,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Municipio  $municipio
     * @return \Illuminate\Http\Response
     */
    public function destroy($municipioid)
    {
        $municipio = Municipio::findOrFail($municipioid);
        if($municipio->delete()){
            return response()->json($municipio,200);
        }
    }
    public function restore($municipioid)
    {
        $municipio = Municipio::withTrashed()->findOrFail($municipioid);
        if($municipio->restore()){
            return response()->json($municipio,200);
        }
    }
}
