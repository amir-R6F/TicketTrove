<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('movie_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('seat_id')->unsigned();
            $table->dateTime('date_bought');
            $table->timestamps();

            $table->foreign('movie_id')->references('id')->on('movies');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('seat_id')->references('id')->on('seats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
