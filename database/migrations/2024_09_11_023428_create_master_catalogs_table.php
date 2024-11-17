<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterCatalogsTable extends Migration
{
    public function up()
    {
        Schema::create('master_catalogs', function (Blueprint $table) {
            $table->id('master_barang_id');
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->integer('jumlah_masuk')->default(0);
            $table->integer('jumlah_keluar')->default(0);
            $table->integer('total_stok')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_catalogs');
    }

};
