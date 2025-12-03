<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoAtraccion extends Model
{
    use HasFactory;
    protected $table = 'tipo_atraccion';
    protected $fillable = [
        'nombre_at',
    ];
}
