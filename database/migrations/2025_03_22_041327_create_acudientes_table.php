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
        Schema::create('acudientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->foreignId('tipo_documento_id')->constrained('tipo_documentos');
            $table->string('numero_documento', 20);
            $table->string('lugar_expedicion', 100)->nullable();
            $table->string('profesion_ocupacion', 100)->nullable();
            $table->string('correo_electronico', 100)->nullable();
            $table->string('direccion_residencia', 200)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acudientes');
    }
};
