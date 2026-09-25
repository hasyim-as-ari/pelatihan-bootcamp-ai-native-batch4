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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->enum('action_type', [
                'LOGIN',
                'LOGOUT',
                'INSERT',
                'UPDATE',
                'DELETE',
                'PRINT',
                'EXPORT',
                'VIEW',
            ]);
            $table->string('module_name', 100);
            $table->unsignedBigInteger('record_id')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();
            $table->text('description');
            $table->timestamp('created_at')->useCurrent();

            $table->index('user_id', 'idx_user_id');
            $table->index('action_type', 'idx_action_type');
            $table->index('module_name', 'idx_module_name');
            $table->index('created_at', 'idx_created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
