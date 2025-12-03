<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provincia extends Model
{
    use HasFactory;
    protected $table = 'provincia';
    protected $fillable = [
        'nombre_prov',
    ];

    public function lugaresTuristicos()
    {
        return $this->hasMany(LugarTuristico::class, 'fk_id_provincia');
    }
}