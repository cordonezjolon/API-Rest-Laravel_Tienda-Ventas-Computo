<?php

namespace App\Http\Controllers;

use App\Models\TipoPago;
use Illuminate\Http\Request;

class TipoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipopago = TipoPago::withTrashed()->get()->all();
        return response()->json($tiendas,200);
    }

    public function indexActivo()
    {
          $tipopago = TipoPago::get()->all();
          return response()->json($tipopago,200);
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
        $tipopago = new TipoPago();
        $tipopago->Id_Estado = config('global.Id_EstadoActivo');
        $tipopago->Descripcion = $request->input('Descripcion');
        $tipopago->Id_UsuarioCrea = $request->input('Id_UsuarioCrea');
        $tipopago->FechaModifica = null;
        $tipopago->Id_UsuarioModifica = null;
        $tipopago->save();
        return response()->json($tienda,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoPago  $tipoPago
     * @return \Illuminate\Http\Response
     */
    public function show( $tipopagoid)
    {
        $tipopago = Tienda::findOrFail($tipopagoid);
        return response()->json($tipopago,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoPago  $tipoPago
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoPago $tipoPago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoPago  $tipoPago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $tipopagoid)
    {
        $tipopago = TipoPago::findOrFail($tipopagoid);
        $tipopago->Descripcion = $request->input('Descripcion');
        $tipopago->Id_UsuarioModifica = $request->input('Id_UsuarioModifica');
        $tipopago->save();
        return response()->json($tipopago,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoPago  $tipoPago
     * @return \Illuminate\Http\Response
     */
    public function destroy( $tipopagoid)
    {
        $tipopago = TipoPago::findOrFail($tipopagoid);
        if($tipopago->delete()){
            return response()->json($tipopago,200);
        }
    }
    public function restore($tipopagoid)
    {
        $tipopago = TipoPago::withTrashed()->findOrFail($tipopagoid);
        if($tipopago->restore()){
            return response()->json($tipopago,200);
        }
    }
}
