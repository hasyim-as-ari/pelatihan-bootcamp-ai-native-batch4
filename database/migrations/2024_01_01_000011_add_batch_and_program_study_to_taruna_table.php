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
        Schema::table('taruna', function (Blueprint $table) {
            if (! Schema::hasColumn('taruna', 'batch')) {
                $table->unsignedInteger('batch')->nullable()->after('angkatan')->comment('Nomor batch taruna (1, 2, 3, dst)');
            }
            if (! Schema::hasColumn('taruna', 'status_batch')) {
                $table->string('status_batch', 10)->nullable()->after('batch')->comment('Status batch taruna (A, B, C, dst)');
            }
            if (! Schema::hasColumn('taruna', 'program_study')) {
                $table->string('program_study')->nullable()->after('status_batch')->comment('Program study taruna');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taruna', function (Blueprint $table) {
            $columnsToDrop = [];
            if (Schema::hasColumn('taruna', 'batch')) {
                $columnsToDrop[] = 'batch';
            }
            if (Schema::hasColumn('taruna', 'status_batch')) {
                $columnsToDrop[] = 'status_batch';
            }
            if (Schema::hasColumn('taruna', 'program_study')) {
                $columnsToDrop[] = 'program_study';
            }
            if (! empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
