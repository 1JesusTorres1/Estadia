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
        Schema::create('mediciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')
                    ->nullable()
                    ->constrained('pacientes')
                    ->onUpdate('cascade')
                    ->onDelete('set null');

            $table->date('fecha')->nullable();
            $table->float('glucosa')->nullable();
            $table->float('presionSistolica')->nullable();
            $table->float('presionDiastolica')->nullable();
            $table->float('hemoglobina')->nullable();
            $table->float('fatiga')->nullable();
            $table->text('visionBorrosa')->nullable();
            $table->text('hormigueo')->nullable();
            $table->float('peso')->nullable();
            $table->float('altura')->nullable();
            $table->text('notas')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mediciones');
    }
};
