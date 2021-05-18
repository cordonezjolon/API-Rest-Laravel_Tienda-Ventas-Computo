<?php

namespace App\Http\Controllers;

use App\Models\Pantalla;
use Illuminate\Http\Request;

class PantallaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pantallas = Pantalla::withTrashed()->get()->all();
        return response()->json($pantallas,200);
  }

  public function indexActivo()
  {
        $pantallas = Pantalla::get()->all();
        return response()->json($pantallas,200);
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
        $pantalla = new Pantalla();
        $pantalla->Id_Estado = config('global.Id_EstadoActivo');
        $pantalla->Ruta = $request->input('Ruta');
        $pantalla->StateFront = $request->input('StateFront');
        $pantalla->Descripcion = $request->input('Descripcion');
        $pantalla->Id_UsuarioCrea = $request->input('Id_UsuarioCrea');
        $pantalla->FechaModifica = null;
        $pantalla->Id_UsuarioModifica = null;
        $pantalla->save();
        return response()->json($pantalla,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pantalla  $pantalla
     * @return \Illuminate\Http\Response
     */
    public function show( $pantallaid)
    {
        $pantalla = Pantalla::findOrFail($pantallaid);
        return response()->json($pantalla,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pantalla  $pantalla
     * @return \Illuminate\Http\Response
     */
    public function edit(Pantalla $pantalla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pantalla  $pantalla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $pantallaid)
    {
        $pantalla = Pantalla::findOrFail($pantallaid);
        $pantalla->Ruta = $request->input('Ruta');
        $pantalla->StateFront = $request->input('StateFront');
        $pantalla->Descripcion = $request->input('Descripcion');
        $pantalla->Id_UsuarioModifica = $request->input('Id_UsuarioModifica');
        $pantalla->save();
        return response()->json($pantalla,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pantalla  $pantalla
     * @return \Illuminate\Http\Response
     */
    public function destroy( $pantallaid)
    {
        $pantalla = Pantalla::findOrFail($pantallaid);
        if($pantalla->delete()){
            return response()->json($pantalla,200);
        }
    }
    public function restore($pantallaid)
    {
        $pantalla = Categoria::withTrashed()->findOrFail($pantallaid);
        if($pantalla->restore()){
            return response()->json($pantalla,200);
        }
    }
}
