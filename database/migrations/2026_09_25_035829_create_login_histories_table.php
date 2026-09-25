<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('login_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('email', 191)->comment('Email attempted');
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();
            $table->enum('status', ['success', 'failed', 'locked'])->default('success');
            $table->string('failure_reason', 200)->nullable()->comment('Why login failed');
            $table->string('country', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->timestamp('logged_at')->useCurrent();

            $table->index(['user_id', 'logged_at']);
            $table->index(['email', 'logged_at']);
            $table->index('status');
            $table->index('ip_address');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('login_histories');
    }
};
