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
        Schema::table('master_catalogs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_katalog')->nullable(); // Menambahkan kolom id_katalog

            // Menambahkan foreign key constraint
            $table->foreign('id_katalog')->references('id')->on('katalogs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_catalogs', function (Blueprint $table) {
            // Menghapus foreign key constraint
            $table->dropForeign(['id_katalog']); // Hapus foreign key constraint
            $table->dropColumn('id_katalog'); // Menghapus kolom id_katalog
        });
    }
};
