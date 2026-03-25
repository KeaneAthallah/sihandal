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
        Schema::create('sumberdana', function (Blueprint $table) {
            $table->id();
            $table->string('no')->nullable();
            $table->string('kd_skpd', 50)->nullable();
            $table->string('nm_skpd', 255)->nullable();
            $table->string('kd_subunit', 50)->nullable();
            $table->string('nm_subunit', 255)->nullable();
            $table->string('kd_kegiatan', 50)->nullable();
            $table->string('nm_kegiatan', 255)->nullable();
            $table->string('kd_subkegiatan', 50)->nullable();
            $table->string('nm_subkegiatan', 255)->nullable();
            $table->string('kd_rek', 100)->nullable();
            $table->string('nm_rek', 255)->nullable();
            $table->decimal('pagu', 15, 2)->default(0);
            $table->string('sumberdana', 255)->nullable();
            $table->timestamps();

            // Add indexes for better performance
            $table->index('kd_skpd');
            $table->index('kd_subunit');
            $table->index('kd_kegiatan');
            $table->index('kd_subkegiatan');
            $table->index('kd_rek');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sumberdana');
    }
};
