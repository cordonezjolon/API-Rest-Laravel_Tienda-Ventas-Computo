<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoProducto extends Model
{
    use HasFactory;
    protected $table = 'TC_FotografiaProducto';
    protected $fillable = 
    ['Id_FotoProducto',
    'Id_Producto',
    'Id_Estado',
    'Descripcion',
    'Url',
    'Base64String',
    'FechaRegistro',
    'Id_UsuarioCrea',
    'FechaModifica',
    'Id_UsuarioModifica'];
    protected $primaryKey = 'Id_FotoProducto';
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';
}
