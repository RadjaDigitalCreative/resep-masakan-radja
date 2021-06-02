<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('color', 6);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('category_recipe', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->integer('recipe_id')->unsigned();
            $table->primary(['category_id', 'recipe_id']);
            $table->foreign('category_id')->references('id')
                  ->on('categories')->onDelete('cascade');
            $table->foreign('recipe_id')->references('id')
                  ->on('recipes')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_recipe');
        Schema::dropIfExists('categories');
    }
}
