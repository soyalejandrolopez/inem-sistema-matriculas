<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estudiante extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca_temporal', 'apellidos', 'nombres', 'genero_id', 'tipo_documento_id',
        'numero_documento', 'lugar_expedicion', 'codigo', 'telefono_principal',
        'telefono_adicional', 'fecha_nacimiento', 'lugar_nacimiento', 'tipo_sangre_id',
        'discapacidad', 'otra_discapacidad', 'enfermedad_cronica', 'estado_embarazo',
        'ciudad_municipio_residencia', 'direccion_residencia', 'barrio_vereda', 'comuna',
        'eps_id', 'estrato_socioeconomico', 'grupo_etnico_id', 'icbf', 'sisben', 'nivel_sisben',
        'tipo_estudiante', 'sede_educativa_id', 'grado_actual', 'grado_matricula'
    ];

    protected $casts = [
        'marca_temporal' => 'datetime',
        'fecha_nacimiento' => 'date',
    ];

    public function tipoDocumento(): BelongsTo
    {
        return $this->belongsTo(TipoDocumento::class);
    }

    public function genero(): BelongsTo
    {
        return $this->belongsTo(Genero::class);
    }

    public function tipoSangre(): BelongsTo
    {
        return $this->belongsTo(TipoSangre::class);
    }

    public function eps(): BelongsTo
    {
        return $this->belongsTo(Eps::class);
    }

    public function grupoEtnico(): BelongsTo
    {
        return $this->belongsTo(GrupoEtnico::class);
    }

    public function sedeEducativa(): BelongsTo
    {
        return $this->belongsTo(SedeEducativa::class);
    }

    public function acudientes(): HasMany
    {
        return $this->hasMany(Acudiente::class);
    }

    public function padre(): HasOne
    {
        return $this->hasOne(Padre::class);
    }

    public function madre(): HasOne
    {
        return $this->hasOne(Madre::class);
    }
}
