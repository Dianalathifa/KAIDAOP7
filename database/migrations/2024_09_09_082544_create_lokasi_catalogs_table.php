<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiCatalogsTable extends Migration
{
    public function up()
    {
        Schema::create('lokasi_catalogs', function (Blueprint $table) {
            $table->id('lokasi_id');
            $table->string('lokasi_penyimpanan');
            $table->text('lokasi_deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lokasi_catalogs');
    }
}
