<?php

namespace App\Http\Controllers;

use App\Models\Atributo;
use Illuminate\Http\Request;

class AtributoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atributos = Atributo::withTrashed()->get()->all();
        return response()->json($atributos,200);
    }
    public function indexActivo()
    {
        $atributos = Atributo::get()->all();
        return response()->json($atributos,200);
    }

    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        $atributo = new Atributo();
        $atributo->Id_Estado = config('global.Id_EstadoActivo');
        $atributo->Descripcion = $request->input('Descripcion');
        $atributo->Id_UsuarioCrea = $request->input('Id_UsuarioCrea');
        $atributo->FechaModifica = null;
        $atributo->Id_UsuarioModifica = null;
        $atributo->save();
        return response()->json($atributo,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Atributo  $atributo
     * @return \Illuminate\Http\Response
     */
    public function show($atributoid)
    {
        $atributo = Atributo::findOrFail($atributoid);
        return response()->json($atributo,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Atributo  $atributo
     * @return \Illuminate\Http\Response
     */
    public function edit(Atributo $atributo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Atributo  $atributo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $atributoid)
    {
        $atributo = Atributo::findOrFail($atributoid);
        $atributo->Descripcion = $request->input('Descripcion');
        $atributo->Id_UsuarioModifica = $request->input('Id_UsuarioModifica');
        $atributo->save();
        return response()->json($atributo,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Atributo  $atributo
     * @return \Illuminate\Http\Response
     */
    public function destroy( $atributoid)
    {
        $atributo = Atributo::findOrFail($atributoid);
        if($atributo->delete()){
            return response()->json($atributo,200);
        }
    }
    public function restore($atributoid)
    {
        $atributo = Atributo::withTrashed()->findOrFail($atributoid);
        if($atributo->restore()){
            return response()->json($atributo,200);
        }
    }
}
