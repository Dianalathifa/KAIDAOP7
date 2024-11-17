<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerkCatalogsTable extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel merk_catalogs.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merk_catalogs', function (Blueprint $table) {
            $table->id('merk_id'); // Kolom kunci utama auto-increment
            $table->string('merk_nama'); // Nama merk
            $table->text('merk_keterangan')->nullable(); // Keterangan merk (opsional)
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Membatalkan migrasi dengan menghapus tabel merk_catalogs.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('merk_catalogs');
    }
}
