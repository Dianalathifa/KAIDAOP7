<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitKerjasTable extends Migration

{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaturan_unit_kerja', function (Blueprint $table) {
            $table->id(); // Menambahkan kolom ID sebagai primary key
            $table->string('Nama_Unit'); // Kolom Nama Unit, dengan tipe string
            $table->string('DAOP'); // Kolom DAOP, dengan tipe string
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaturan_unit_kerja');
    }
}
