<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RolUsuario extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'TC_RolUsuario';
    protected $fillable = 
    [
        'Id_RolUsuario'
        , 'Id_Sistema'
        , 'Id_Estado'
        , 'Descripcion'
        , 'FechaRegistro'
        , 'Id_UsuarioCrea'
        , 'FechaModifica'
        , 'Id_UsuarioModifica'];
    protected $primaryKey = 'Id_Categoria';
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';
}
