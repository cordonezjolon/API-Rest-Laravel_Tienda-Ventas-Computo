<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tienda extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'TC_Tienda';
    protected $fillable = 
    [
        'Id_Tienda', 
        'Id_Estado', 
        'Id_Municipio', 
        'Direccion', 
        'HoraApertura', 
        'HoraCierre', 
        'Telefono', 
        'Email', 
        'FechaRegistro', 
        'Id_UsuarioCrea', 
        'FechaModifica', 
        'Id_UsuarioModifica'];
    protected $primaryKey = 'Id_Tienda';
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';
}
