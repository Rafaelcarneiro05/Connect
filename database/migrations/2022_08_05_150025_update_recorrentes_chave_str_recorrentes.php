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

            $table->bigInteger('recorrente_id')->unsigned()->nullable();
            $table->foreign('recorrente_id')->references('id')->on('recorrente');

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
