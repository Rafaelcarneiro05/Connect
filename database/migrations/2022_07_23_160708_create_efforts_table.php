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
        Schema::create('efforts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->datetime('inicio')->nullable();
            $table->datetime('fim')->nullable();
            $table->bigInteger('projeto_id')->unsigned()->nullable();
            $table->foreign('projeto_id')->references('id')->on('projects');
            $table->bigInteger('usuario_id')->unsigned()->nullable();
            $table->foreign('usuario_id')->references('id')->on('users');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('efforts');
    }
};
