<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            // $table->integer('cost_id')->unsigned()->nullable();
            // $table->foreign('cost_id')->references('id')->on('costs');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ingredient_recipe', function (Blueprint $table) {
            $table->integer('ingredient_id')->unsigned();
            $table->integer('recipe_id')->unsigned();
            $table->primary(['ingredient_id', 'recipe_id']);
            $table->foreign('ingredient_id')->references('id')
                  ->on('ingredients')->onDelete('cascade');
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
        Schema::dropIfExists('ingredient_recipe');
        Schema::dropIfExists('ingredients');
    }
}
