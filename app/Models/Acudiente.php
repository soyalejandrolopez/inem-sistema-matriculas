<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Acudiente extends Model
{
    use HasFactory;

    protected $fillable = [
        'estudiante_id', 'nombre', 'tipo_documento_id', 'numero_documento',
        'lugar_expedicion', 'profesion_ocupacion', 'correo_electronico',
        'direccion_residencia', 'telefono'
    ];

    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiante::class);
    }

    public function tipoDocumento(): BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class);
    }
}
