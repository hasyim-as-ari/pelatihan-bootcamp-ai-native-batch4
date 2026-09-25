<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('licenses_ratings', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name', 100);
            $table->enum('type', ['license', 'rating'])->default('license');
            $table->text('description')->nullable();
            $table->decimal('min_flight_hours', 7, 2)->default(0);
            $table->integer('validity_months')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index('type');
            $table->index('is_active');
        });

        Schema::create('taruna_license', function (Blueprint $table) {
            $table->id();
            $table->foreignId('taruna_id')->constrained('taruna')->cascadeOnDelete();
            $table->foreignId('license_rating_id')->constrained('licenses_ratings')->cascadeOnDelete();
            $table->date('issued_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->string('certificate_number', 100)->nullable();
            $table->enum('status', ['active', 'expired', 'suspended', 'pending'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('taruna_license');
        Schema::dropIfExists('licenses_ratings');
    }
};
