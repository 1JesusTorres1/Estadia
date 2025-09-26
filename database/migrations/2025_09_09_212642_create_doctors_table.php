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
        Schema::create('doctores', function (Blueprint $table) {
            $table->id('idDoctor');
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users') // Se enlaza a la tabla 'users'
                  ->onUpdate('cascade')
                  ->onDelete('set null');
            $table->string('especialidad', 45);
            $table->string('cedula', 45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctores');
    }
};
