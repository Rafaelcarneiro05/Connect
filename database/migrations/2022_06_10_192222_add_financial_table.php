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
        Schema::table('financials', function (Blueprint $table) {

        
        $table->string('fonte')->nullable();
        $table->date('data')->nullable();
        $table->enum('moeda', ['brl','usdt','bnb','btc','euro'])->nullable();
        $table->float('cotacaoEmBRL')->nullable();
        $table->integer('fracao')->nullable();
        $table->float('taxa')->nullable();
        $table->string('observacao')->nullable();
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
