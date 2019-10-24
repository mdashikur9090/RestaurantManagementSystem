<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('food_type_id');
            $table->string('name');
            $table->longText('description');
            $table->integer('price');
            $table->integer('serve');
            $table->string('chef');
            $table->integer('cooking_hours');
            $table->integer('calories');
            $table->integer('total_vote');
            $table->integer('total_rating_point');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods');
    }
}
