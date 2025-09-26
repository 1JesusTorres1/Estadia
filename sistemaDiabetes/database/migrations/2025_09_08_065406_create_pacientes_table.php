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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users') // Se enlaza a la tabla 'users'
                  ->onUpdate('cascade')
                  ->onDelete('set null');
            
            $table->date('fechaRegistro');
            $table->string('tipoDiabetes');
            $table->string('sexo',45);
            $table->date('fecha_nacimiento');

            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
