<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CategoriaProducto extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'TC_CategoriaProducto';
    protected $fillable = 
    [
    'Id_CategoriaProducto',    
    'Id_Estado', 
    'Id_Producto', 
    'Id_Categoria', 
    'FechaRegistro', 
    'Id_UsuarioCrea', 
    'FechaModifica', 
    'Id_UsuarioModifica'];
    protected $primaryKey = 'Id_CategoriaProducto';
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';
    public function Categorias()
    {
        return $this->hasOne(Categoria::class,'Id_Categoria','Id_Categoria');
    }
    public function Productos()
    {
        return $this->belongsTo(Producto::class,'Id_Producto','Id_Producto');
    }
}
