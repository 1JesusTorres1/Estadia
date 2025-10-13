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
        Schema::create('seguimiento_medicos', function (Blueprint $table) {
            $table->id();

            // Relación con el paciente
            $table->foreignId('patient_id')
                    ->nullable()
                    ->constrained('pacientes')
                    ->onUpdate('cascade')
                    ->onDelete('set null');

            $table->dateTime('fechaSeguimiento');
            $table->text('motivoConsulta');
            $table->text('observaciones');
            $table->text('planTratamiento');
            $table->date('proximaCita')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimiento_medicos');
    }
};
