<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail')->default('default.jpg');
            $table->text('body');
            $table->integer('duration_id')->unsigned()->nullable();
            $table->foreign('duration_id')->references('id')
                  ->on('durations')->onDelete('set null');
            $table->integer('difficulty_id')->unsigned()->nullable();
            $table->foreign('difficulty_id')->references('id')
                  ->on('difficulties')->onDelete('set null');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')
                  ->on('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
