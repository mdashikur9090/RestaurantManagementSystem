<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngridientLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingridient_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ingridient_id');
            $table->string('name');
            $table->string('type');
            $table->decimal('amount', 8, 2);
            $table->decimal('net_amount', 8, 2);
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
        Schema::dropIfExists('ingridient_log');
    }
}
