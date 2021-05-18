<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Atributo extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'TC_Atributo';
    protected $fillable = 
    [
    'Id_Atributo',     
    'Id_Estado', 
    'Descripcion',
    'FechaRegistro', 
    'Id_UsuarioCrea', 
    'FechaModifica', 
    'Id_UsuarioModifica'];
    protected $primaryKey = 'Id_Atributo';
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';
    public function AtributosProducto()
    {
        return $this->hasMany(AtributoProducto::class,'Id_Atributo','Id_Atributo');
    }
}
