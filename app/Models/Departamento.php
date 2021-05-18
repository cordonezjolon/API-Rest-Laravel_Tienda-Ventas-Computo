<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'TC_Departamento';
    protected $fillable = 
    ['Id_Departamento'
    ,'Id_Estado'
    ,'Nombre'
    ,'FechaRegistro'
    ,'FechaModifica'
    ,'Id_UsuarioModifica'];
    protected $primaryKey = 'Id_Departamento';
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';
    public function Municipios()
    {
        return $this->hasMany(Municipio::class,'Id_Departamento','Id_Departamento');
    }
}
