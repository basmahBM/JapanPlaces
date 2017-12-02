<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en')->unique();
            $table->string('image_uri',255);
            $table->timestamps();

            $table->index('name_en'); 
        });

        Schema::create('categories', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name_en');
        $table->timestamps();
         });

        Schema::create('places', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name_en')->index();
        $table->string('image_uri',255);
        $table->text('description');   
        $table->integer('category_id')->unsigned();
        $table->integer('city_id')->unsigned();
        $table->string('long' ,100);  
        $table->string('lat' ,100);
        $table->timestamps();

        $table->foreign('category_id')->references('id')->on('categories');
        $table->foreign('city_id')->references('id')->on('cities');
    });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('cities');
    }
}
