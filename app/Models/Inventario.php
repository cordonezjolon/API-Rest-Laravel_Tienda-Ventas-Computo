<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventario extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'TT_Inventario';
    protected $fillable = 
    [
    'Id_Inventario', 
    'Id_Producto', 
    'Id_Tienda', 
    'Id_Estado', 
    'Existencia', 
    'MinimoExistencia', 
    'FechaUltimaVenta', 
    'FechaRegistro', 
    'Id_UsuarioCrea', 
    'FechaModifica', 
    'Id_UsuarioModifica'];
    protected $primaryKey = 'Id_Inventario';
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';
}
