<?php

namespace App\Http\Controllers;

use App\Models\AtributoProducto;
use Illuminate\Http\Request;

class AtributoProductoController extends Controller
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
        $atributoproducto = new AtributoProducto();
        $atributoproducto->Id_Estado = config('global.Id_EstadoActivo');
        $atributoproducto->ValorAtributo = $request->input('ValorAtributo');
        $atributoproducto->Id_Producto = $request->input('Id_Producto');
        $atributoproducto->Id_Atributo = $request->input('Id_Atributo');
        $atributoproducto->Id_UsuarioCrea = $request->input('Id_UsuarioCrea');
        $atributoproducto->FechaModifica = null;
        $atributoproducto->Id_UsuarioModifica = null;
        $atributoproducto->save();
        return response()->json($atributoproducto,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AtributoProducto  $atributoProducto
     * @return \Illuminate\Http\Response
     */
    public function show(AtributoProducto $atributoProducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AtributoProducto  $atributoProducto
     * @return \Illuminate\Http\Response
     */
    public function edit(AtributoProducto $atributoProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AtributoProducto  $atributoProducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AtributoProducto $atributoProducto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AtributoProducto  $atributoProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy($atributoProductoid)
    {
        $atributoProducto = Categoria::findOrFail($atributoProductoid);
        if($atributoProducto->delete()){
            return response()->json($atributoProducto,200);
        }
    }
}
