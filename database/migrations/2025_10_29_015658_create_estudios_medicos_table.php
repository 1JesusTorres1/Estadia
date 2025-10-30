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
        Schema::create('estudios_medicos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained('users')->onDelete('cascade');

            $table->string('tipo_estudio', 100);
            $table->text('descripcion')->nullable();
            $table->date('fecha_estudio');
            $table->text('resultado')->nullable();
            $table->enum('estatus', ['pendiente', 'en revisión', 'completado'])->default('pendiente');
            $table->text('observaciones_doctor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudios_medicos');
    }
};
