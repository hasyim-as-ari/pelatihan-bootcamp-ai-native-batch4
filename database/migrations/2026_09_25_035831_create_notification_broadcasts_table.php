<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_broadcasts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->text('message');
            $table->enum('channel', ['whatsapp', 'email', 'both', 'system'])->default('system');
            $table->enum('target_role', ['all', 'student', 'instructor', 'admin', 'specific'])->default('all');
            $table->json('target_user_ids')->nullable();
            $table->foreignId('jadwal_penerbangan_id')->nullable()->constrained('jadwal_penerbangan')->nullOnDelete();
            $table->enum('trigger_type', ['manual', 'schedule_change', 'schedule_approved', 'schedule_cancelled', 'reminder', 'alert'])->default('manual');
            $table->enum('priority', ['low', 'normal', 'high', 'urgent'])->default('normal');
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->integer('recipients_count')->default(0);
            $table->integer('delivered_count')->default(0);
            $table->integer('failed_count')->default(0);
            $table->enum('status', ['draft', 'queued', 'sending', 'sent', 'failed', 'cancelled'])->default('draft');
            $table->text('error_log')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('status');
            $table->index('channel');
            $table->index('trigger_type');
            $table->index('scheduled_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_broadcasts');
    }
};
