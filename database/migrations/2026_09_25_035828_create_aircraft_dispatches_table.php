<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aircraft_dispatches', function (Blueprint $table) {
            $table->id();
            $table->string('dispatch_number', 50)->unique();
            $table->foreignId('jadwal_penerbangan_id')->nullable()->constrained('jadwal_penerbangan')->nullOnDelete();
            $table->foreignId('pesawat_id')->constrained('pesawat')->cascadeOnDelete();
            $table->foreignId('instruktur_id')->constrained('instruktur')->cascadeOnDelete();
            $table->foreignId('taruna_id')->constrained('taruna')->cascadeOnDelete();
            $table->foreignId('dispatcher_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('dispatch_date');
            $table->time('planned_departure')->nullable();
            $table->time('actual_departure')->nullable();
            $table->time('actual_return')->nullable();
            $table->decimal('fuel_before_liters', 8, 2)->nullable();
            $table->decimal('fuel_after_liters', 8, 2)->nullable();
            $table->decimal('fuel_added_liters', 8, 2)->nullable();
            $table->decimal('hobbs_start', 10, 2)->nullable();
            $table->decimal('hobbs_end', 10, 2)->nullable();
            $table->decimal('tach_start', 10, 2)->nullable();
            $table->decimal('tach_end', 10, 2)->nullable();
            $table->string('weather_conditions', 200)->nullable();
            $table->integer('visibility_meters')->nullable();
            $table->string('wind_info', 100)->nullable();
            $table->integer('cloud_ceiling_ft')->nullable();
            $table->boolean('atc_clearance_obtained')->default(false);
            $table->string('atc_clearance_code', 50)->nullable();
            $table->text('pre_flight_check_notes')->nullable();
            $table->text('post_flight_notes')->nullable();
            $table->enum('status', ['planned', 'dispatched', 'airborne', 'returned', 'cancelled'])->default('planned');
            $table->timestamps();

            $table->index(['pesawat_id', 'dispatch_date']);
            $table->index(['instruktur_id', 'dispatch_date']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aircraft_dispatches');
    }
};
