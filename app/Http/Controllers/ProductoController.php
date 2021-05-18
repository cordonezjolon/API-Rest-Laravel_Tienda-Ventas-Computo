<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\CategoriaProducto;
use App\Models\AtributoProducto;
use Illuminate\Http\Request;
use App\Http\Resources\JsonResponseTienda as ResourceResponse;
use Illuminate\Support\Facades\DB;
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::with('Fotos')->get();
        return  response()->json(new ResourceResponse($productos),200);
    }
    public function indexCategoria($categoriaid)
    {
        $productos = DB::table('TC_Producto as p')
            ->join('TC_CategoriaProducto as cp', 'p.Id_Producto', '=', 'cp.Id_Producto')
            ->where('Id_Categoria', '=', $categoriaid)
            ->whereRaw('"p"."deleted_at" is NULL')
            ->select(
             'p.Id_Producto'
            ,'p.Id_Descuento'
            ,'p.Id_Estado'
            ,'p.Nombre'
            ,'p.Descripcion'
            ,'p.Precio'
            ,'p.DescripcionDetalle'
            ,'p.DisponibleBajoPedido'
            ,'p.FechaRegistro'
            ,'p.Id_UsuarioCrea'
            ,'p.FechaModifica'
            ,'p.Id_UsuarioModifica'
            ,'p.Fotografia'
            ,'p.deleted_at')
            ->get();
        //$categorias = CategoriaProducto::where('Id_Producto', '=', $productoId)->with('Categorias')->get();
        return  response()->json(new ResourceResponse($productos),200);
    }

    public function create()
    {
        //
    }
    public function CategoriasProducto($productoId)
    {
        $categorias = DB::table('TC_CategoriaProducto as cp')
            ->join('TC_Categoria as ca', 'ca.Id_Categoria', '=', 'cp.Id_Categoria')
            ->where('Id_Producto', '=', $productoId)
            ->whereRaw('"cp"."deleted_at" is NULL')
            ->select('Id_CategoriaProducto', 'Descripcion', 'ca.Id_Categoria','Id_Producto')
            ->get();
        //$categorias = CategoriaProducto::where('Id_Producto', '=', $productoId)->with('Categorias')->get();
        return  response()->json(new ResourceResponse($categorias),200);
    }
    public function AtributosProducto($productoId)
    {
        $atributos = DB::table('TC_AtributoProducto as ap')
            ->join('TC_Atributo as at', 'ap.Id_Atributo', '=', 'at.Id_Atributo')
            ->where('Id_Producto', '=', $productoId)
            ->whereRaw('"ap"."deleted_at" is NULL')
            ->select('Id_AtributoProducto', 'Descripcion', 'ap.Id_Atributo','Id_Producto','ValorAtributo')
            ->get();
        //$categorias = CategoriaProducto::where('Id_Producto', '=', $productoId)->with('Categorias')->get();
        return  response()->json(new ResourceResponse($atributos),200);
    }
    public function store(Request $request)
    {
         $productoN = new Producto();
         $productoN->Id_Descuento = $request->input('Id_Descuento');
         $productoN->Id_Estado = config('global.Id_EstadoActivo');
         $productoN->Nombre = $request->input('Nombre');
         $productoN->Descripcion = $request->input('Descripcion');
         $productoN->Fotografia = $request->input('Fotografia');
         $productoN->Precio = $request->input('Precio');
         $productoN->DescripcionDetalle = $request->input('DescripcionDetalle');
         $productoN->DisponibleBajoPedido = $request->input('DisponibleBajoPedido');
         $productoN->Id_UsuarioCrea = $request->input('Id_UsuarioCrea');
         $productoN->FechaModifica = null;
         $productoN->Id_UsuarioModifica = null;
         $productoN->save();
         return response()->json(new ResourceResponse($productoN),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show($productoid)
    {
        //$productos = Producto::findOrFail($productoid)->with('Fotos')->get()->all();
     try {
        $producto = Producto::where('Id_Producto','=', $productoid)->with('Fotos')->get();
        if($producto->isEmpty()){
            return response()->json(['error' => 'Producto no encontrado'  ],404);
        }
        else{
            return response()->json(new ResourceResponse($producto),200);

        }
     } catch (\Throwable $th) {
        return response()->json(new ResourceResponse($th),404);
     }
       
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $productoid)
    {
        $producto =  Producto::findOrFail($productoid);
        $producto->Id_Descuento = $request->input('Id_Descuento');
        $producto->Nombre = $request->input('Nombre');
        $producto->Descripcion = $request->input('Descripcion');
        $producto->Fotografia = $request->input('Fotografia');
        $producto->Precio = $request->input('Precio');
        $producto->DescripcionDetalle = $request->input('DescripcionDetalle');
        $producto->DisponibleBajoPedido = $request->input('DisponibleBajoPedido');
        $producto->Id_UsuarioModifica = $request->input('Id_UsuarioModifica');
        $producto->save();
        return response()->json(new ResourceResponse($producto),201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($productoid)
    {
        $producto = Producto::findorfail($productoid);
        if($producto->delete()){
            return new ResourceResponse($producto);
        }
        
    }
}
