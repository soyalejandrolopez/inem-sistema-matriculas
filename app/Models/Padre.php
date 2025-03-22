<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Padre extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudiante_id', 'nombre', 'numero_documento',
        'profesion_ocupacion', 'telefono'
    ];

    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiante::class);
    }
}
