<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LugarTuristico extends Model
{
    use HasFactory;
    protected $table = 'lugar_turistico';
    protected $fillable = [
        'nombre',
        'coordenadas',
        'descripcion',
        'anio',
        'accesibilidad',
        'fk_id_provincia',
        'fk_id_tipo',
    ];
    // Relación con Provincia
    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'fk_id_provincia');
    }

    // Relación con TipoAtraccion
    public function tipoAtraccion()
    {
        return $this->belongsTo(TipoAtraccion::class, 'fk_id_tipo');
    }
}
