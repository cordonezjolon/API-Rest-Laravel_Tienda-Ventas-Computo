<?php

namespace App\Http\Controllers;

use App\Models\FotoProducto;
use Illuminate\Http\Request;
use App\Models\FotoProducto;
use App\Http\Resources\JsonResponseTienda as ResourceResponse;

class FotoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fotos = FotoProducto::all();
        return new ResourceResponse($fotos);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FotoProducto  $fotoProducto
     * @return \Illuminate\Http\Response
     */
    public function show(FotoProducto $fotoProducto)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FotoProducto  $fotoProducto
     * @return \Illuminate\Http\Response
     */
    public function edit(FotoProducto $fotoProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FotoProducto  $fotoProducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FotoProducto $fotoProducto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FotoProducto  $fotoProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy(FotoProducto $fotoProducto)
    {
        //
    }
}
