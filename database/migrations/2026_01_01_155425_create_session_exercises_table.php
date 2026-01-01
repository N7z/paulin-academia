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
        Schema::create('session_exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workout_session_id')->constrained('workout_sessions');
            $table->foreignId('workout_exercise_id')->constrained('workout_exercises');
            $table->integer('difficulty')->default(0)->comment('0-facil 1-moderado 2-dificil');
            $table->integer('performed_sets')->nullable();
            $table->integer('performed_reps')->nullable();
            $table->float('performed_weight')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('completed')->default(false);
            $table->dateTime('started_at')->nullable();
            $table->dateTime('ended_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_exercises');
    }
};
