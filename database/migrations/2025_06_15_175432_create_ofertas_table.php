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
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            $table->string('cargo');
            $table->string('descripcion');
            $table->string('estado', 1);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('modalidad', 1);
            $table->decimal('salario_minimo', 10, 2);
            $table->decimal('salario_maximo', 10, 2);
            $table->foreignId('area_id')->constrained('areas');
            $table->foreignId('reclutador_id')->constrained('reclutadors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ofertas');
    }
};
