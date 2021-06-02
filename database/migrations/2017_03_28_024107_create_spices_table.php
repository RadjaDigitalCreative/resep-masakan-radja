<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            // $table->integer('cost_id')->unsigned()->nullable();
            // $table->foreign('cost_id')->references('id')->on('costs');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('recipe_spice', function (Blueprint $table) {
            $table->integer('spice_id')->unsigned();
            $table->integer('recipe_id')->unsigned();
            $table->primary(['spice_id', 'recipe_id']);
            $table->foreign('spice_id')->references('id')
                  ->on('spices')->onDelete('cascade');
            $table->foreign('recipe_id')->references('id')
                  ->on('recipes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipe_spice');
        Schema::dropIfExists('spices');
    }
}
