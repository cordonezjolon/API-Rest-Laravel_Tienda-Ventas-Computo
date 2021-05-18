<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipio extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'TC_Municipio';
    protected $fillable = 
    ['Id_Municipio'
    ,'Id_Departamento'
    ,'Id_Estado'
    ,'Nombre'
    ,'FechaRegistro'
    ,'FechaModifica'
    ,'Id_UsuarioModifica'];
    protected $primaryKey = 'Id_Municipio';
    protected $dates = ['deleted_at'];
    const CREATED_AT = 'FechaRegistro';
    const UPDATED_AT = 'FechaModifica';
    public function Departamentos()
    {
        return $this->belongsTo(Departamento::class,'Id_Departamento','Id_Departamento');
    }
}
