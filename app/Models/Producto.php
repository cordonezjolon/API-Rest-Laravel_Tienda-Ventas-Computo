<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    
    use HasFactory,SoftDeletes;
    protected $table = 'TC_Producto';
    protected $fillable = 
    ['Id_Producto'
    ,'Id_Descuento'
    ,'Id_Estado'
    ,'Nombre'
    ,'Descripcion'
    ,'Precio'
    ,'DescripcionDetalle'
    ,'DisponibleBajoPedido'
    ,'FechaRegistro'
    ,'Id_UsuarioCrea'
    ,'FechaModifica'
    ,'Id_UsuarioModifica'
    ,'Fotografia'
    ,'deleted_at'];
    protected $primaryKey = 'Id_Producto';
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';
    public function Fotos()
    {
        return $this->hasMany(FotoProducto::class,'Id_Producto','Id_Producto');
    }
    public function CategoriasProducto()
    {
        return $this->hasMany(CategoriaProducto::class,'Id_Producto','Id_Producto');
    }
    
}
