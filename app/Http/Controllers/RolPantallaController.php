<?php

namespace App\Http\Controllers;

use App\Models\RolPantalla;
use Illuminate\Http\Request;

class RolPantallaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $rolpantalla = new RolPantalla();
        $rolpantalla->Id_RolUsuario = $request->input('Id_RolUsuario');
        $rolpantalla->Id_Estado = config('global.Id_EstadoActivo');
        $rolpantalla->Id_Pantalla = $request->input('Id_Pantalla');
        $rolpantalla->Id_UsuarioCrea = $request->input('Id_UsuarioCrea');
        $rolpantalla->FechaModifica = null;
        $rolpantalla->Id_UsuarioModifica = null;
        $rolpantalla->save();
        return response()->json($rolpantalla,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RolPantalla  $rolPantalla
     * @return \Illuminate\Http\Response
     */
    public function show(RolPantalla $rolPantalla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RolPantalla  $rolPantalla
     * @return \Illuminate\Http\Response
     */
    public function edit(RolPantalla $rolPantalla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RolPantalla  $rolPantalla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RolPantalla $rolPantalla)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RolPantalla  $rolPantalla
     * @return \Illuminate\Http\Response
     */
    public function destroy( $rolpantallaid)
    {
        $rolpantalla = RolPantalla::findOrFail($rolpantallaid);
        if($rolpantalla->delete()){
            return response()->json($rolpantalla,200);
        }
    }
}
