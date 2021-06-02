<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('bio', 140)->default('');
            $table->string('avatar')->default('default.png');
            $table->string('cover')->nullable();
            $table->string('password');
            $table->boolean('verified')->default(false);
            $table->string('token', 30)->nullable();
            $table->integer('role_id')->unsigned()->default(1);
            $table->foreign('role_id')->references('id')
                  ->on('user_roles')->onDelete('no action');;
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
