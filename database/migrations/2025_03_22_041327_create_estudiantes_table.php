<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('apellidos', 100);
            $table->string('nombres', 100);
            $table->foreignId('genero_id')->constrained('generos');
            $table->foreignId('tipo_documento_id')->constrained('tipo_documentos');
            $table->string('numero_documento', 20)->unique();
            $table->string('lugar_expedicion', 100)->nullable();
            $table->string('codigo', 20)->nullable();
            $table->string('telefono_principal', 20)->nullable();
            $table->string('telefono_adicional', 20)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('lugar_nacimiento', 100)->nullable();
            $table->foreignId('tipo_sangre_id')->nullable()->constrained('tipo_sangres');
            $table->string('discapacidad', 100)->nullable();
            $table->string('otra_discapacidad', 100)->nullable();
            $table->string('enfermedad_cronica', 100)->nullable();
            $table->enum('estado_embarazo', ['Sí', 'No'])->default('No');
            $table->string('ciudad_municipio_residencia', 100)->nullable();
            $table->string('direccion_residencia', 200)->nullable();
            $table->string('barrio_vereda', 100)->nullable();
            $table->string('comuna', 50)->nullable();
            $table->foreignId('eps_id')->nullable()->constrained('eps');
            $table->integer('estrato_socioeconomico')->nullable();
            $table->foreignId('grupo_etnico_id')->nullable()->constrained('grupo_etnicos');
            $table->enum('icbf', ['Sí', 'No'])->default('No');
            $table->string('sisben', 50)->nullable();
            $table->string('nivel_sisben', 50)->nullable();
            $table->enum('tipo_estudiante', ['Nuevo', 'Antiguo', 'Reintegrado']);
            $table->foreignId('sede_educativa_id')->constrained('sede_educativas');
            $table->foreignId('grado_id')->constrained('grados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
