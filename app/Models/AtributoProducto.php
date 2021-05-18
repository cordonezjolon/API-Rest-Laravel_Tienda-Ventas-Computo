<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AtributoProducto extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'TC_AtributoProducto';
    protected $fillable = 
    [
    'Id_AtributoProducto',         
    'Id_Estado', 
    'Id_Producto', 
    'Id_Atributo', 
    'ValorAtributo',
    'FechaRegistro', 
    'Id_UsuarioCrea', 
    'FechaModifica', 
    'Id_UsuarioModifica'];
    protected $primaryKey = 'Id_AtributoProducto';
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';
    public function Atributos()
    {
        return $this->hasOne(Atributo::class,'Id_Atributo','Id_Atributo');
    }
}
