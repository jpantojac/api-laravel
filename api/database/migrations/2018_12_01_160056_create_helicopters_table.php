<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelicoptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helicopters', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->String('type');
            $table->String('name');
            $table->String('speed');
            $table->String('color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('helicopters');
    }
}
