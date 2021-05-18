<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
class Usuario  extends Authenticatable implements JWTSubject
{
    use HasFactory,Notifiable,SoftDeletes;
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
    'username',
    'Id_RolUsuario',
    'Fotografia'];
    protected $primaryKey = 'Id_Usuario';
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';
    protected $dates = ['deleted_at'];
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
        Añadiremos estos dos métodos
    */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
