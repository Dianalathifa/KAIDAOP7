<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCustomerFromMasukCatalogsTable extends Migration
{
    public function up()
    {
        if (Schema::hasColumn('masuk_catalogs', 'customer')) {
            Schema::table('masuk_catalogs', function (Blueprint $table) {
                $table->dropColumn('customer');
            });
        }
    }

    public function down()
    {
        Schema::table('masuk_catalogs', function (Blueprint $table) {
            if (!Schema::hasColumn('masuk_catalogs', 'customer')) {
                $table->string('customer'); // sesuaikan tipe data sesuai kebutuhan
            }
        });
    }
}
