<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Skip this migration for SQLite (tests) since the base migration already has nullable()
        if (DB::getDriverName() === 'sqlite') {
            return;
        }
        
        // MySQL/MariaDB
        DB::statement('ALTER TABLE users MODIFY COLUMN nip VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Skip this migration for SQLite (tests) since the base migration already has nullable()
        if (DB::getDriverName() === 'sqlite') {
            return;
        }
        
        // MySQL/MariaDB
        DB::statement('ALTER TABLE users MODIFY COLUMN nip VARCHAR(255) NOT NULL');
    }
};
