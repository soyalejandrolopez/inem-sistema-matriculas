<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoSangre extends Model
{
    use HasFactory;

    protected $fillable = ['tipo'];

    public function estudiantes(): HasMany
    {
        return $this->hasMany(Estudiante::class);
    }
}
