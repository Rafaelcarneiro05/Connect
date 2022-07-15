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
        //
        Schema::table('users', function (Blueprint $table) {
            $table->string('rg', 255)->nullable();
            $table->string('pix', 255)->nullable();
            $table->string('escolaridade', 255)->nullable();
            $table->string('cnpj', 255)->nullable();
            $table->string('nacionalidade', 255)->nullable();
            $table->enum('estado_civil', ['solteiro','casado'])->default('solteiro');
            $table->enum('sexo', ['masculino', 'feminino'])->default('masculino');
            $table->string('tamanho_roupa', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
 