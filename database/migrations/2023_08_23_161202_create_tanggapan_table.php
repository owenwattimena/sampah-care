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
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_pengaduan');
            $table->mediumText('isi');
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('id_admin')->references('id')->on('admin');
            $table->foreign('id_pengaduan')->references('id')->on('pengaduan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tanggapan');
    }
};
