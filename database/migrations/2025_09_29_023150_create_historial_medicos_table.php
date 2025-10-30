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
        if (!Schema::hasTable('historial_medicos')){
            Schema::create('historial_medicos', function (Blueprint $table) {
                $table->id();
                
                // Relación con el paciente (un historial por paciente)
                $table->foreignId('patient_id')
                    ->nullable()
                    ->unique()
                    ->constrained('pacientes')
                    ->onUpdate('cascade')
                    ->onDelete('set null');
                

                $table->text('antecedentesFamiliares')->nullable();
                $table->text('alergias')->nullable();
                $table->text('medicamentos')->nullable();
                $table->text('enfermedades')->nullable();
                $table->text('notasMedicas')->nullable();
                
                $table->timestamps();
            });
        }  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_medicos');
    }
};
