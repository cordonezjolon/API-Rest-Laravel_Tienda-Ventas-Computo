<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPago extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'TT_TipoPago';
    protected $fillable = 
    [
        'Id_TipoPago', 
        'Id_Estado', 
        'Descripcion', 
        'RequiereAutorizacion', 
        'FechaRegistro', 
        'Id_UsuarioCrea', 
        'FechaModifica', 
        'Id_UsuarioModifica'];
    protected $primaryKey = 'Id_TipoPago';
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';
}
