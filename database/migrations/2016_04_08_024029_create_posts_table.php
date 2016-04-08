<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('upvotes');
            $table->integer('downvotes');
            $table->integer('user_id')->unsigned();
            $table->string('category', 15)->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('app_users');
            $table->foreign('category')->references('category_name')->on('Category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Posts');
    }
}
