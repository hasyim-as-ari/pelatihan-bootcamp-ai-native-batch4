<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flight_hours_reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_number', 50)->unique();
            $table->enum('period_type', ['monthly', 'quarterly', 'semester', 'annual', 'custom'])->default('monthly');
            $table->date('period_start');
            $table->date('period_end');
            $table->integer('period_year');
            $table->integer('period_month')->nullable();
            $table->foreignId('taruna_id')->nullable()->constrained('taruna')->nullOnDelete();
            $table->foreignId('pesawat_id')->nullable()->constrained('pesawat')->nullOnDelete();
            $table->decimal('total_flight_hours', 10, 2)->default(0);
            $table->decimal('dual_hours', 10, 2)->default(0);
            $table->decimal('solo_hours', 10, 2)->default(0);
            $table->integer('total_landings')->default(0);
            $table->integer('total_flights')->default(0);
            $table->json('breakdown_data')->nullable();
            $table->enum('status', ['draft', 'generated', 'approved', 'published'])->default('draft');
            $table->foreignId('generated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['period_year', 'period_month']);
            $table->index('status');
            $table->index('taruna_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flight_hours_reports');
    }
};
