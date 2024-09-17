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
        Schema::create('imports', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nom de l'employé
            $table->string('department'); // Département
            $table->date('date'); // Date
            $table->string('shift')->nullable(); // Shift (quart de travail)
            $table->string('timetable')->nullable(); // Emploi du temps
            $table->string('attendance_status')->nullable(); // Statut de présence
            $table->time('check_in')->nullable(); // Heure d'arrivée
            $table->time('check_out')->nullable(); // Heure de départ
            $table->boolean('late')->default(false); // Retard
            $table->boolean('early_leave')->default(false); // Départ anticipé
            $table->boolean('attended')->default(true); // Présence
            $table->boolean('absent')->default(false); // Absence
            $table->integer('worked')->nullable(); // Heures travaillées
            $table->integer('break')->nullable(); // Temps de pause
            $table->string('leave_type')->nullable(); // Type de congé
            $table->boolean('leave')->default(false); // Congé
            $table->integer('ot1')->nullable(); // Heure supplémentaire 1
            $table->integer('ot2')->nullable(); // Heure supplémentaire 2
            $table->integer('ot3')->nullable(); // Heure supplémentaire 3
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imports');
    }
};
