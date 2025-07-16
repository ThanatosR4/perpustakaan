<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeLamaPinjamToIntegerInPinjamanTable extends Migration
{
    public function up()
    {
        Schema::table('pinjaman', function (Blueprint $table) {
            $table->integer('lama_pinjam')->change();
        });
    }

    public function down()
    {
        Schema::table('pinjaman', function (Blueprint $table) {
            $table->date('lama_pinjam')->change(); // Kalau sebelumnya tipe DATE
        });
    }
};
