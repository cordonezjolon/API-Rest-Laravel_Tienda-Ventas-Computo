<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pantalla extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'TC_Pantalla';
    protected $fillable = 
    ['Id_Pantalla', 
    'Id_Estado', 
    'Ruta', 
    'StateFront', 
    'Descripcion', 
    'FechaRegistro', 
    'Id_UsuarioCrea', 
    'FechaModifica', 
    'Id_UsuarioModifica'];
    protected $primaryKey = 'Id_Pantalla';
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';
}
