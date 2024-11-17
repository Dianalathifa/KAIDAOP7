<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('keluar_barang_catalogs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_keluar')->unique(); // Kolom untuk kode keluar
            $table->string('kode_barang'); // Kolom untuk kode barang, referensi ke tabel katalog
            $table->foreign('kode_barang')->references('kode_barang')->on('katalogs')->onDelete('cascade');
            $table->string('nama_barang'); // Kolom untuk nama barang
            $table->integer('jumlah_keluar'); // Kolom untuk jumlah barang keluar
            $table->unsignedBigInteger('unit_id'); // Kolom untuk unit kerja, referensi ke tabel unit kerja
            $table->foreign('unit_id')->references('id')->on('pengaturan_unit_kerja')->onDelete('cascade');
            $table->date('tanggal_keluar')->nullable(); // Kolom tanggal keluar
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('keluar_barang_catalogs');
    }
};
