<?php

namespace App\Http\Controllers;

use App\Models\CategoriaProducto;
use Illuminate\Http\Request;

class CategoriaProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
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
        $categoriaproducto = new CategoriaProducto();
        $categoriaproducto->Id_Estado = config('global.Id_EstadoActivo');
        $categoriaproducto->Id_Producto = $request->input('Id_Producto');
        $categoriaproducto->Id_Atributo = $request->input('Id_Categoria');
        $categoriaproducto->Id_UsuarioCrea = $request->input('Id_UsuarioCrea');
        $categoriaproducto->FechaModifica = null;
        $categoriaproducto->Id_UsuarioModifica = null;
        $categoriaproducto->save();
        return response()->json($categoriaproducto,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoriaProducto  $categoriaProducto
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriaProducto $categoriaProducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoriaProducto  $categoriaProducto
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaProducto $categoriaProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoriaProducto  $categoriaProducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriaProducto $categoriaProducto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoriaProducto  $categoriaProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy( $categoriaproductoid)
    {
        $categoriaproducto = CategoriaProducto::findOrFail($categoriaproductoid);
        if($categoriaproducto->delete()){
            return response()->json($categoriaproducto,200);
        }
    }
}
