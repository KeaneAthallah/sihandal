{{-- database/migrations/2024_01_01_000001_create_realisasi_rincian_belanja_table.php --}}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('realisasi_rincian_belanja', function (Blueprint $table) {
            $table->id();
            $table->integer('bulan');
            $table->string('kdskpd', 50);
            $table->string('nmskpd', 255);
            $table->string('kdsubunit', 50)->nullable();
            $table->string('nmsubunit', 255)->nullable();
            $table->string('kdkegiatan', 50)->nullable();
            $table->string('nmkegiatan', 255)->nullable();
            $table->string('kdsubkegiatan', 50)->nullable();
            $table->string('nmsubkegiatan', 255)->nullable();
            $table->string('kdrek', 50)->nullable();
            $table->string('nmrek', 255)->nullable();
            $table->decimal('nilai', 15, 2);
            $table->date('tgl_sp2d');
            $table->string('no_sp2d', 100)->unique();
            $table->string('sumberdana', 100);
            $table->unsignedBigInteger('id_smb')->nullable();
            $table->timestamps();

            // Indexes for better performance
            $table->index('bulan');
            $table->index('kdskpd');
            $table->index('no_sp2d');
            $table->index('sumberdana');
            $table->index('tgl_sp2d');

            // Foreign key constraint
            $table->foreign('id_smb')
                ->references('id')
                ->on('sumberdana')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('realisasi_rincian_belanja');
    }
};
