<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sumberdana', function (Blueprint $table) {
            // Increase string column lengths
            $table->string('kd_skpd', 100)->nullable()->change();
            $table->string('nm_skpd', 500)->nullable()->change();
            $table->string('kd_subunit', 100)->nullable()->change();
            $table->string('nm_subunit', 500)->nullable()->change();
            $table->string('kd_kegiatan', 100)->nullable()->change();
            $table->string('nm_kegiatan', 500)->nullable()->change();
            $table->string('kd_subkegiatan', 100)->nullable()->change();
            $table->string('nm_subkegiatan', 500)->nullable()->change();
            $table->string('kd_rek', 200)->nullable()->change();
            $table->string('nm_rek', 500)->nullable()->change();
            $table->string('sumberdana', 500)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('sumberdana', function (Blueprint $table) {
            // Revert to original lengths (but we won't do this in production)
            $table->string('kd_skpd', 50)->nullable()->change();
            $table->string('nm_skpd', 255)->nullable()->change();
            $table->string('kd_subunit', 50)->nullable()->change();
            $table->string('nm_subunit', 255)->nullable()->change();
            $table->string('kd_kegiatan', 50)->nullable()->change();
            $table->string('nm_kegiatan', 255)->nullable()->change();
            $table->string('kd_subkegiatan', 50)->nullable()->change();
            $table->string('nm_subkegiatan', 255)->nullable()->change();
            $table->string('kd_rek', 100)->nullable()->change();
            $table->string('nm_rek', 255)->nullable()->change();
            $table->string('sumberdana', 255)->nullable()->change();
        });
    }
};
