<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemasukans', function (Blueprint $table) {
            DB::statement("ALTER TABLE pemasukans MODIFY status VARCHAR(50) DEFAULT 'pending'");
            $table->string('document_1_name')->nullable()->after('rejection_reason');
            $table->string('document_1_path')->nullable()->after('document_1_name');
            $table->string('document_2_name')->nullable()->after('document_1_path');
            $table->string('document_2_path')->nullable()->after('document_2_name');
        });

        Schema::table('pengeluarans', function (Blueprint $table) {
            DB::statement("ALTER TABLE pengeluarans MODIFY status VARCHAR(50) DEFAULT 'pending'");
            $table->string('document_1_name')->nullable()->after('rejection_reason');
            $table->string('document_1_path')->nullable()->after('document_1_name');
            $table->string('document_2_name')->nullable()->after('document_1_path');
            $table->string('document_2_path')->nullable()->after('document_2_name');
        });
    }

    public function down(): void
    {
        Schema::table('pemasukans', function (Blueprint $table) {
            $table->dropColumn(['document_1_name', 'document_1_path', 'document_2_name', 'document_2_path']);
            DB::statement("ALTER TABLE pemasukans MODIFY status ENUM('pending','approved','rejected') DEFAULT 'pending'");
        });

        Schema::table('pengeluarans', function (Blueprint $table) {
            $table->dropColumn(['document_1_name', 'document_2_name', 'document_1_path', 'document_2_path']);
            DB::statement("ALTER TABLE pengeluarans MODIFY status ENUM('pending','approved','rejected') DEFAULT 'pending'");
        });
    }
};