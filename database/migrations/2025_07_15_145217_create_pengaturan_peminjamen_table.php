<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('pengaturan_peminjamans', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('maksimal_hari')->default(7); // default 7 hari
            $table->unsignedInteger('maksimal_buku')->default(3); // default 3 buku
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
        Schema::dropIfExists('pengaturan_peminjamen');
    }
};
