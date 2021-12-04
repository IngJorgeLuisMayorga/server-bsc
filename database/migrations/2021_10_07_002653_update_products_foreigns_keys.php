<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsForeignsKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {

            $table->unsignedBigInteger('productA_id')->nullable();
            $table->foreign('productA_id')->references('id')->on('products')->onDelete('cascade');

            $table->unsignedBigInteger('productB_id')->nullable();;
            $table->foreign('productB_id')->references('id')->on('products')->onDelete('cascade');

            $table->unsignedBigInteger('category_skin_id');
            $table->foreign('category_skin_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('category_main_ingredient_id');
            $table->foreign('category_main_ingredient_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('category_solution_id');
            $table->foreign('category_solution_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('category_step_id');
            $table->foreign('category_step_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unsignedBigInteger('category_extra_id');
            $table->foreign('category_extra_id')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
