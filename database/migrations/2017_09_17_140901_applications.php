<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Applications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments_simulations_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_simulation')->unsigned();
            $table->foreign('id_simulation')->references('id')->on('investments_simulations');
            $table->double('val_application');
            $table->dateTime('date_application');
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
        Schema::dropIfExists('investments_simulations_applications');
    }
}
