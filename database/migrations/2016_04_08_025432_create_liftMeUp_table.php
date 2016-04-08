<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiftMeUpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('LiftMeUp', function (Blueprint $table) {
            $table->increments('id');
            $table->string('URL');
            $table->string('type', 15);
            $table->string('category', 15)->nullable();
            $table->timestamps();

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
        Schema::drop('LiftMeUp');
    }
}
