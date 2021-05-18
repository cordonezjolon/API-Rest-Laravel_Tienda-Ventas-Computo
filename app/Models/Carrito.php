<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrito extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'TT_Carrito';
    protected $fillable = 
    [
    'Id_Carrito', 
    'Id_Producto', 
    'cantidad', 
    'FechaRegistro', 
    'Id_UsuarioCrea', 
    'FechaModifica', 
    'Id_UsuarioModifica'];
    protected $primaryKey = 'Id_Carrito';
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';
}
