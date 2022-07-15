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
        Schema::create('recorrente', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('categoria', ['despesas', 'custos', 'imobilizados',])->nullable();
            $table->string('descricao')->nullable();
            $table->float('value', 11, 2);
            $table->string('fonte')->nullable();
            $table->string('observacao')->nullable();
            $table->float('taxa')->nullable();
            $table->date('data')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recorrente');
    }
};
