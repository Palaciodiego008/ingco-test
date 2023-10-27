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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function etiquetas()
    {
        return $this->belongsToMany(Etiqueta::class, 'etiqueta_tarea', 'tarea_id', 'etiqueta_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($tarea) {
            $tarea->etiquetas()->detach();
        });
    }
}
