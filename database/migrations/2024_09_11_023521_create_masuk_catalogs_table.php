<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasukCatalogsTable extends Migration
{
    public function up()
    {
        Schema::create('masuk_catalogs', function (Blueprint $table) {
            $table->id('masuk_barang_id'); // Primary key
            $table->string('kode_masuk'); // Kode masuk barang
            $table->string('kode_barang'); // Kode barang
            $table->string('barang'); // Nama barang
            $table->integer('jumlah_masuk'); // Jumlah barang yang masuk
            $table->unsignedBigInteger('unit_id')->nullable(); // Menambahkan kolom unit_id sebagai foreign key
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('unit_id')->references('id')->on('pengaturan_unit_kerja')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('masuk_catalogs');
    }
}
