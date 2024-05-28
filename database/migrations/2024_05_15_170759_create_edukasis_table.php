<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdukasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * 
     */
    public function up(): void
    {
        Schema::create('edukasis', function (Blueprint $table) {
            $table->bigIncrements('id_edukasi')->nullable(false);
            $table->bigInteger('id_topik')->nullable(false);
            $table->string('judul_edukasi', 120)->nullable(false);
            $table->string('gambar_edukasi', 40)->nullable(false);
            $table->text('teks_edu', 500)->nullable(false);
            $table->date('tanggal')->nullable(false);

            $table->foreign('id_topik')->references('id_topik')->on('topik_edukasis');
        });
    }
    /**
     * Reverse the migrations.
     *
     * 
     */
    public function down(): void
    {
        Schema::dropIfExists('edukasis');
    }
}
