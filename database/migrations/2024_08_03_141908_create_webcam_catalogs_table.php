<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebcamCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webcam_catalogs', function (Blueprint $table) {
            $table->id('id_webcam');
            $table->string('nama')->nullable();
            $table->text('detail_spesifikasi')->nullable();
            $table->string('klasifikasi')->nullable();
            $table->string('brand')->nullable();
            $table->string('type')->nullable();
            $table->integer('harga_asli_offline')->nullable();
            $table->integer('harga_asli_online')->nullable();
            $table->integer('harga_rab_persen')->nullable();
            $table->integer('harga_rab_wajar')->nullable();
            $table->date('tanggal_update')->nullable();
            $table->string('vendor')->nullable();
            $table->integer('jumlah_kebutuhan')->nullable();
            $table->integer('jumlah_ketersediaan')->nullable();
            $table->string('satuan', 50)->nullable();
            $table->text('keterangan')->nullable();
            $table->string('gambar_perangkat')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('webcam_catalogs');
    }
}
