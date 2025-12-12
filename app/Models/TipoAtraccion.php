<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoAtraccion extends Model
{
    use HasFactory;
    protected $table = 'tipo_atraccion';
    protected $primaryKey = 'id_atraccion'; 
    protected $fillable = [
        'nombre_at',
    ];
    public function lugaresTuristicos()
    {
        return $this->hasMany(LugarTuristico::class, 'fk_id_tipo','id_atraccion');
    }
}
