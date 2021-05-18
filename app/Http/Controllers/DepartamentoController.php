<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\JsonResponseTienda as DepartamentoResource;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamentos = Departamento::withTrashed()->get()->all();
        return response()->json($departamentos,200);
    }

    public function indexActivo()
    {
          $departamentos = Departamento::all();
          return response()->json($departamentos,200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departamento = new Departamento();
        $departamento->Id_Estado = config('global.Id_EstadoActivo');
        $departamento->Nombre = $request->input('Nombre');
        $departamento->Id_UsuarioCrea = $request->input('Id_UsuarioCrea');
        $departamento->FechaModifica = null;
        $departamento->Id_UsuarioModifica = null;
        $departamento->save();
        return response()->json($departamento,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show( $departamentoid)
    {
        $departamento = Departamento::where('Id_Departamento','=',$departamentoid)->with('Municipios')->get();
        return response()->json($departamento,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $departamentoid)
    {
        $departamento = Departamento::findOrFail($departamentoid);
        $departamento->Nombre = $request->input('Nombre');
        $departamento->Id_UsuarioModifica = $request->input('Id_UsuarioModifica');
        $departamento->save();
        return response()->json($departamento,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy($departamentoid)
    {
        $departamento = Departamento::findOrFail($departamentoid);
        if($departamento->delete()){
            return response()->json($departamento,200);
        }
    }
    public function restore($departamentoid)
    {
        $departamento = Departamento::withTrashed()->findOrFail($departamentoid);
        if($departamento->restore()){
            return response()->json($departamento,200);
        }
    }
}
