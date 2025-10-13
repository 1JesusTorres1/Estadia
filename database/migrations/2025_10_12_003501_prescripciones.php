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
        Schema::create('prescripciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('doctor_id')->nullable()->constrained('users')->onDelete('set null'); 
            $table->foreignId('medicamento_id')->constrained('medicamentos')->onDelete('cascade');

            $table->text('dosis');
            $table->text('indicaciones')->nullable(); 
            $table->date('fecha_prescripcion');
            $table->date('fecha_fin_consumo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescripciones');
    }
};
