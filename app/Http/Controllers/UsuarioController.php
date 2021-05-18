<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Resources\JsonResponseTienda as ResourceResponse;

class UsuarioController extends Controller
{

    public function index()
    {
        $usuarios = Usuario::get()->all();
        return response()->json($usuarios,200);
    }

    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $UsuarioUp = new Usuario();
        $UsuarioUp->Id_Municipio = $request->input('Id_Municipio');
        $UsuarioUp->PrimerNombre = $request->input('PrimerNombre');
        $UsuarioUp->SegundoNombre = $request->input('SegundoNombre');
        $UsuarioUp->PrimerApellido = $request->input('PrimerApellido');
        $UsuarioUp->SegundoApellido = $request->input('SegundoApellido');
        $UsuarioUp->Direccion = $request->input('Direccion');
        $UsuarioUp->Id_TipoUsuario = 2;
        $UsuarioUp->Telefono = $request->input('Telefono');
        $UsuarioUp->NIT = $request->input('NIT');
        $UsuarioUp->DireccionEntrega = $request->input('DireccionEntrega');
        $UsuarioUp->NombreFacturacion = $request->input('NombreFacturacion');
        $UsuarioUp->DireccionFactura = $request->input('DireccionFactura');
        $UsuarioUp->Id_Estado = config('global.Id_EstadoActivo');
        $UsuarioUp->Id_UsuarioCrea = $request->input('Id_UsuarioCrea');
        $UsuarioUp->Fotografia = $request->input('Fotografia');
        $UsuarioUp->password = Hash::make('Ord51252236');
        $UsuarioUp->Id_RolUsuario = 1;
        $UsuarioUp->FechaModifica = null;
        $UsuarioUp->Id_UsuarioModifica = null;
        $UsuarioUp->save();
        return response()->json($UsuarioUp);
    }

    public function show($usuario)
    {
        $Usuario =  Usuario::findOrFail($usuario);
        return response()->json($Usuario);
    }
    public function showbyemail($email)
    {
        $Usuario =  Usuario::where('email','=',$email)->get();
        return response()->json($Usuario);
    }


    public function edit(Usuario $usuario)
    {
        //
    }

 
    public function update(Request $request, $usuario)
    {
        $UsuarioUp =  Usuario::findOrFail($usuario);
        $UsuarioUp->Id_Municipio = $request->input('Id_Municipio');
        $UsuarioUp->PrimerNombre = $request->input('PrimerNombre');
        $UsuarioUp->SegundoNombre = $request->input('SegundoNombre');
        $UsuarioUp->PrimerApellido = $request->input('PrimerApellido');
        $UsuarioUp->SegundoApellido = $request->input('SegundoApellido');
        $UsuarioUp->Direccion = $request->input('Direccion');
        $UsuarioUp->Telefono = $request->input('Telefono');
        $UsuarioUp->NIT = $request->input('NIT');
        $UsuarioUp->DireccionEntrega = $request->input('DireccionEntrega');
        $UsuarioUp->NombreFacturacion = $request->input('NombreFacturacion');
        $UsuarioUp->DireccionFactura = $request->input('DireccionFactura');
        $UsuarioUp->Fotografia = $request->input('Fotografia');
        $UsuarioUp->save();
        return response()->json($UsuarioUp);
    }

    public function destroy( $usuario)
    {
        $usuario = Usuario::findOrFail($usuario);
        if($usuario->delete()){
            return response()->json($usuario,200);
        }
    }

 
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
      
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciales invalidas'  ], 200);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se logro generar autorizacion'], 500);
        }
        return response()->json(compact('token'));
    }
    public function getAuthenticatedUser()
    {
        try {
            if (!$usuario = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
            }
            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                    return response()->json(['token_expired'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                    return response()->json(['token_invalid'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                    return response()->json(['token_absent'], $e->getStatusCode());
            }
            return response()->json(compact('usuario'));
    }
    public function register(Request $request)
        {
                $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:6',
            ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }

            $usuario = Usuario::create([
                'username' => $request->get('username'),
                'email' => $request->get('email'),
                'Id_TipoUsuario' => config('global.Id_TipoUsuario'),
                'Id_Estado' => config('global.Id_EstadoActivo'),
                'CuentaValidada' => false,
                'Id_RolUsuario' => config('global.Id_RolUsuarioCliente'),
                'password' => Hash::make($request->get('password')),
            ]);

            $token = JWTAuth::fromUser($usuario);

            return response()->json(compact('usuario','token'),201);
        }
        public function verify($user_id, Request $request) {
            if (!$request->hasValidSignature()) {
                return response()->json(["msg" => "El vinculo ha expirado."], 401);
            }
        
            $user = User::findOrFail($user_id);
        
            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
            }
        
            return response()->json(["msg" => "Usuario validado correctamente."], 201);
        }
        
        public function resend() {
            if (auth()->user()->hasVerifiedEmail()) {
                return response()->json(["msg" => "Correo electronico ya fue validado."], 400);
            }
        
            auth()->user()->sendEmailVerificationNotification();
        
            return response()->json(["msg" => "Correo electronico enviado a su bandeja."],200);
        }
}
