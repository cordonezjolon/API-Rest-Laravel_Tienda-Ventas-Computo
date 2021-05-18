<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $categorias = Categoria::withTrashed()->get()->all();
          return response()->json($categorias,200);
    }

    public function indexActivo()
    {
          $categorias = Categoria::get()->all();
          return response()->json($categorias,200);
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
        $categoria = new Categoria();
        $categoria->Id_Estado = config('global.Id_EstadoActivo');
        $categoria->Descripcion = $request->input('Descripcion');
        $categoria->Id_UsuarioCrea = $request->input('Id_UsuarioCrea');
        $categoria->FechaModifica = null;
        $categoria->Id_UsuarioModifica = null;
        $categoria->save();
        return response()->json($categoria,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show($categoriaid)
    {
            $categoria = Categoria::findOrFail($categoriaid);
            return response()->json($categoria,200);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($categoriaid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoriaid)
    {
        $categoria = Categoria::findOrFail($categoriaid);
        $categoria->Descripcion = $request->input('Descripcion');
        $categoria->Id_UsuarioModifica = $request->input('Id_UsuarioModifica');
        $categoria->save();
        return response()->json($categoria,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($categoriaid)
    {
        $categoria = Categoria::findOrFail($categoriaid);
        if($categoria->delete()){
            return response()->json($categoria,200);
        }
    }
    public function restore($categoriaid)
    {
        $categoria = Categoria::withTrashed()->findOrFail($categoriaid);
        if($categoria->restore()){
            return response()->json($categoria,200);
        }
    }
}
