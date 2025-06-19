<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('suara')) {
            Schema::create('suara', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('id_kandidat');
                $table->unsignedBigInteger('id_users');
                $table->timestamp('waktu_pemilihan');
                $table->timestamps();
            });
    
            Schema::table('suara', function (Blueprint $table) {
                $table->foreign('id_kandidat')->references('id')->on('kandidat');
                $table->foreign('id_users')->references('id')->on('users');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suara');
    }
}
