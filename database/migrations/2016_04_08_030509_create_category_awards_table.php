<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CategoryAwards', function (Blueprint $table) {
            $table->integer('award_id')->unsigned();
            $table->string('category', 15)->nullable();

            $table->foreign('award_id')->references('id')->on('awards');
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
        Schema::drop('CategoryAwards');
    }
}
