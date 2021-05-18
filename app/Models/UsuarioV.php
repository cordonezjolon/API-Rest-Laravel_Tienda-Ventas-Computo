<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Auth\MustVerifyEmail;

class UsuarioV extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    protected $table = 'TT_Usuario';
    protected $fillable = 
    ['Id_Usuario', 
    'Id_TipoUsuario', 
    'Id_Municipio', 
    'Id_Estado', 
    'Descripcion', 
    'PrimerNombre', 
    'SegundoNombre', 
    'PrimerApellido', 
    'SegundoApellido', 
    'Direccion', 
    'Telefono', 
    'NIT', 
    'DireccionEntrega', 
    'NombreFacturacion', 
    'DireccionFactura', 
    'password', 
    'Id_UsuarioCrea', 
    'FechaRegistro', 
    'FechaModifica', 
    'Id_UsuarioModifica',
    'email',
    'username'];
    protected $primaryKey = 'Id_Usuario';
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';

    protected $hidden = [
        'password', 'remember_token',
    ];
}
