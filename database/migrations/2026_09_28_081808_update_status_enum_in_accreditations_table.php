<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('accreditations', function (Blueprint $table) {
            DB::statement("
                ALTER TABLE `accreditations`
                MODIFY COLUMN `status` ENUM(
                    'Baik',
                    'Baik Sekali',
                    'Unggul',
                    'Terakreditasi',
                    'Tidak Terakreditasi'
                ) NOT NULL DEFAULT 'Terakreditasi'
            ");
        });
    }

    public function down(): void
    {
        Schema::table('accreditations', function (Blueprint $table) {
            DB::statement("
                ALTER TABLE `accreditations`
                MODIFY COLUMN `status` ENUM(
                    'Baik',
                    'Baik Sekali',
                    'Unggul',
                ) NOT NULL DEFAULT 'Baik'
            ");
        });
    }
};
