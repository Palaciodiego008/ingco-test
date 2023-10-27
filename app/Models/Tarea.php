<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_creacion',
        'fecha_vencimiento',
    ];

    public function usuario () {
        return $this->belongsTo(User::class);
    }

    public function etiquetas() {
        return $this->belongsToMany(Etiqueta::class);
    }
}
