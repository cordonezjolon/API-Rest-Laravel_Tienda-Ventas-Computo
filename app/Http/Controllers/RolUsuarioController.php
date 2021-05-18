<?php

namespace App\Http\Controllers;

use App\Models\RolUsuario;
use Illuminate\Http\Request;

class RolUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rolusuario = RolUsuario::withTrashed()->get()->all();
        return response()->json($rolusuario,200);
    }
    public function indexActivo()
    {
          $rolusuario = RolUsuario::get()->all();
          return response()->json($rolusuario,200);
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
        $rolusuario = new RolUsuario();
        $rolusuario->Id_Estado = config('global.Id_EstadoActivo');
        $rolusuario->Id_Sistema = config('global.Id_Sistema');
        $rolusuario->Descripcion = $request->input('Descripcion');
        $rolusuario->Id_UsuarioCrea = $request->input('Id_UsuarioCrea');
        $rolusuario->FechaModifica = null;
        $rolusuario->Id_UsuarioModifica = null;
        $rolusuario->save();
        return response()->json($rolusuario,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RolUsuario  $rolUsuario
     * @return \Illuminate\Http\Response
     */
    public function show($rolusuarioid)
    {
        $rolusuario = RolUsuario::findOrFail($rolusuarioid);
        return response()->json($rolusuario,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RolUsuario  $rolUsuario
     * @return \Illuminate\Http\Response
     */
    public function edit(RolUsuario $rolUsuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RolUsuario  $rolUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rolusuarioid)
    {
        $rolusuario = RolUsuario::findOrFail($rolusuarioid);
        $rolusuario->Descripcion = $request->input('Descripcion');
        $rolusuario->Id_UsuarioModifica = $request->input('Id_UsuarioModifica');
        $rolusuario->save();
        return response()->json($rolusuario,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RolUsuario  $rolUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy( $rolusuarioid)
    {
        $rolusuario = RolUsuario::findOrFail($rolusuarioid);
        if($rolusuario->delete()){
            return response()->json($rolusuario,200);
        }
    }
    public function restore($rolusuarioid)
    {
        $rolusuario = RolUsuario::withTrashed()->findOrFail($rolusuarioid);
        if($rolusuario->restore()){
            return response()->json($rolusuario,200);
        }
    }
}
