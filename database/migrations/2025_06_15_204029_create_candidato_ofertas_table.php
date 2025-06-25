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
        Schema::create('candidato_ofertas', function (Blueprint $table) {
            $table->id();
            $table->string('estado', 1);
            $table->date('fecha_postulacion');
            $table->foreignId('oferta_id')->constrained('ofertas');
            $table->foreignId('candidato_id')->constrained('candidatos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidato_ofertas');
    }
};
