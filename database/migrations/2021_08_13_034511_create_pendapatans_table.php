<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendapatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendapatans', function (Blueprint $table) {
            $table->id();
            $table->integer('gudang_id');
            $table->string('hari');
            $table->integer('barang_masuk');
            $table->integer('barang_keluar');
            $table->integer('jumlah_barang');
            $table->integer('pendapatan');
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
        Schema::dropIfExists('pendapatans');
    }
}
