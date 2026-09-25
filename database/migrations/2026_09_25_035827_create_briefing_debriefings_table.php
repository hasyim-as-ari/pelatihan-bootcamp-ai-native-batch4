<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('briefing_debriefings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_penerbangan_id')->nullable()->constrained('jadwal_penerbangan')->nullOnDelete();
            $table->foreignId('instruktur_id')->constrained('instruktur')->cascadeOnDelete();
            $table->foreignId('taruna_id')->constrained('taruna')->cascadeOnDelete();
            $table->enum('type', ['briefing', 'debriefing']);
            $table->date('date');
            $table->time('time_start');
            $table->time('time_end')->nullable();
            $table->string('location', 100)->nullable();
            $table->text('topics_covered')->nullable();
            $table->text('instructor_notes')->nullable();
            $table->text('student_notes')->nullable();
            $table->enum('performance_rating', ['excellent', 'good', 'satisfactory', 'needs_improvement', 'unsatisfactory'])->nullable();
            $table->boolean('cleared_for_flight')->default(false);
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled');
            $table->timestamps();

            $table->index(['instruktur_id', 'date']);
            $table->index(['taruna_id', 'date']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('briefing_debriefings');
    }
};
