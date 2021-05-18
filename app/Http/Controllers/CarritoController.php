<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\JsonResponseTienda as ResourceResponse;
class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($usuarioid)
    {
        $carrito = DB::table('TT_Carrito as C')
        ->join('TC_Producto as P', 'C.Id_Producto', '=', 'P.Id_Producto')
        ->join('TC_Descuento as D', 'D.Id_Descuento', '=', 'P.Id_Descuento')
        ->where('C.Id_UsuarioCrea', '=', $usuarioid)
        ->whereRaw('"C"."deleted_at" is NULL')
        ->select('P.Id_Producto', 'P.Nombre', 'P.Precio','C.Id_Carrito','C.cantidad','P.Fotografia'
        ,DB::raw('"P"."Precio" - ("P"."Precio" * "D"."Porcentaje") as "Precio", "D"."PorcentajeMuestra" , "D"."Porcentaje",("P"."Precio" - ("P"."Precio" * "D"."Porcentaje")) * "C"."cantidad" as "subtotal"'))
        ->get();
        return  response()->json(new ResourceResponse($carrito),200);
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
        if(Carrito::where([['Id_Producto','=',  $request->input('Id_Producto')],['Id_UsuarioCrea','=',$request->input('Id_UsuarioCrea')]])->exists())
        {
            Carrito::where([['Id_Producto','=',  $request->input('Id_Producto')],['Id_UsuarioCrea','=',$request->input('Id_UsuarioCrea')]])->update(['cantidad' => DB::raw('cantidad + 1')]);
            $carrito = Carrito::where([['Id_Producto','=',  $request->input('Id_Producto')],['Id_UsuarioCrea','=',$request->input('Id_UsuarioCrea')]])->first();
            $carrito->Id_UsuarioModifica = $request->input('Id_UsuarioModifica');
            $carrito->save();
            return response()->json($carrito,201);
        }
        else
        {
            $carrito = new Carrito();
            $carrito->Id_Producto = $request->input('Id_Producto');
            $carrito->cantidad = $request->input('cantidad');
            $carrito->Id_UsuarioCrea = $request->input('Id_UsuarioCrea');
            $carrito->FechaModifica = null;
            $carrito->Id_UsuarioModifica = null;
            $carrito->save();
            return response()->json($carrito,201);
        }
       // $carrito = Carrito::where([['Id_Producto','=',  $request->input('Id_Producto')],['Id_UsuarioCrea','=',$request->input('Id_UsuarioCrea')]])->get();
           
        return response()->json($carrito,201); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function show( $carritoid)
    {
        $carrito = Carrito::findOrFail($carritoid);
        return response()->json($carrito,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function edit( $carritoid)
    {
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $carritoid)
    {
        $carrito = Carrito::findOrFail($carritoid);
        $carrito->Cantidad = $request->input('Cantidad');
        $carrito->Id_UsuarioModifica = $request->input('Id_UsuarioModifica');
        $carrito->save();
        return response()->json($carrito,201);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function destroy( $carritoid)
    {
        $carrito = Carrito::findOrFail($carritoid);
        if($carrito->delete()){
            return response()->json($carrito,200);
        }
    }
}
