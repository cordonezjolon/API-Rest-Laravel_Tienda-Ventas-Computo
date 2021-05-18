<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
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
    public function existenciaProducto($productoid)
    {
        $existencia = DB::table('TC_Tienda as T')
        ->join('TT_Inventario as I', 'T.Id_Tienda', '=', 'I.Id_Tienda')
        ->where('Id_Producto', '=', $productoid)
        ->select('T.Id_Tienda', 'T.Direccion', 'I.Existencia')
        ->get();
   
    return  response()->json($existencia,200);
    }
    public function existenciaTienda($tiendaid)
    {
        $existencia = DB::table('TC_Tienda as T')
        ->join('TT_Inventario as I', 'T.Id_Tienda', '=', 'I.Id_Tienda')
        ->where('T.Id_Tienda', '=', $tiendaid)
        ->select('T.Id_Tienda', 'T.Direccion', 'I.Existencia')
        ->get();
   
    return  response()->json($existencia,200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inventario = new Inventario();
        $inventario->Id_Estado = config('global.Id_EstadoActivo');
        $inventario->Id_Producto = $request->input('Id_Producto');
        $inventario->Id_Tienda = $request->input('Id_Tienda');
        $inventario->Existencia = $request->input('Existencia');
        $inventario->MinimoExistencia = $request->input('MinimoExistencia');
        $inventario->FechaUltimaVenta = now();
        $inventario->Id_UsuarioCrea = $request->input('Id_UsuarioCrea');
        $inventario->FechaModifica = null;
        $inventario->Id_UsuarioModifica = null;
        $inventario->save();
        return response()->json($inventario,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(Inventario $inventario)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventario $inventario)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $inventarioid)
    {
        $inventario = Inventario::findOrFail($inventarioid);
        $inventario->Existencia = $request->input('Existencia');
        $inventario->MinimoExistencia = $request->input('MinimoExistencia');
        $inventario->Id_UsuarioModifica = $request->input('Id_UsuarioModifica');
        $inventario->save();
        return response()->json($inventario,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventario $inventario)
    {
        //
    }
}
