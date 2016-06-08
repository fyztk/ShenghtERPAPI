<?php

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
            $table->string('username',20)->unique();
            $table->string('password',128);
            $table->integer('deptid')->nullable();
            $table->string('realname',20)->nullable();
            $table->string('sex',2)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('position',10)->nullable();
            $table->boolean('is_login')->default(0);
            $table->boolean('is_admin')->default(0);
            $table->integer('created_id');
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
        Schema::drop('User');
    }
}
