<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'TC_Categoria';
    protected $fillable = 
    [
    'Id_Categoria',    
    'Id_Estado', 
    'Descripcion',
    'FechaRegistro',
    'FechaModifica'];
    protected $primaryKey = 'Id_Categoria';
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';
    
    public function CategoriasProducto()
    {
        return $this->hasMany(CategoriaProducto::class,'Id_Categoria','Id_Categoria');
    }
}
