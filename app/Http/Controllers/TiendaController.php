<?php

namespace App\Http\Controllers;

use App\Models\Tienda;
use Illuminate\Http\Request;

class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiendas = Tienda::withTrashed()->get()->all();
        return response()->json($tiendas,200);
    }

    public function indexActivo()
    {
          $tiendas = Tienda::get()->all();
          return response()->json($tiendas,200);
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
        $tienda = new Tienda();
        $tienda->Id_Estado = config('global.Id_EstadoActivo');
        $tienda->Id_Municipio = $request->input('Id_Municipio');
        $tienda->Direccion = $request->input('Direccion');
        $tienda->HoraApertura = $request->input('HoraApertura');
        $tienda->HoraCierre = $request->input('HoraCierre');
        $tienda->Telefono = $request->input('Telefono');
        $tienda->Email = $request->input('Email');
        $tienda->Id_UsuarioCrea = $request->input('Id_UsuarioCrea');
        $tienda->FechaModifica = null;
        $tienda->Id_UsuarioModifica = null;
        $tienda->save();
        return response()->json($tienda,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function show($tiendaid)
    {
        $tienda = Tienda::findOrFail($tiendaid);
        return response()->json($tienda,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function edit(Tienda $tienda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tiendaid)
    {
        $tienda = Tienda::findOrFail($tiendaid);
        $tienda->Id_Municipio = $request->input('Id_Municipio');
        $tienda->Direccion = $request->input('Direccion');
        $tienda->HoraApertura = $request->input('HoraApertura');
        $tienda->HoraCierre = $request->input('HoraCierre');
        $tienda->Telefono = $request->input('Telefono');
        $tienda->Email = $request->input('Email');
        $tienda->Id_UsuarioModifica = $request->input('Id_UsuarioModifica');
        $tienda->save();
        return response()->json($tienda,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tienda  $tienda
     * @return \Illuminate\Http\Response
     */
    public function destroy($tiendaid)
    {
        $tienda = Tienda::findOrFail($tiendaid);
        if($tienda->delete()){
            return response()->json($tienda,200);
        }
    }
    public function restore($tiendaid)
    {
        $tienda = Tienda::withTrashed()->findOrFail($tiendaid);
        if($tienda->restore()){
            return response()->json($tienda,200);
        }
    }
}
