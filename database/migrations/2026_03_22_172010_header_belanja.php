<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('header_belanja', function (Blueprint $table) {
            $table->id();
            $table->string('nomor', 100);
            $table->date('tgl_sp2d');
            $table->string('no_sp2d', 100)->unique();
            $table->string('unit_skpd', 255);
            $table->string('nama_penerima', 255);
            $table->text('keterangan')->nullable();
            $table->string('jenis_sp2', 10);
            $table->decimal('brutto', 15, 2);
            $table->timestamps();

            $table->index('no_sp2d');
            $table->index('tgl_sp2d');
            $table->index('jenis_sp2');
            $table->index('unit_skpd');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('header_belanja');
    }
};
