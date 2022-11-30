<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->enum('type', ['SHOP', 'POINTS', 'FREE']); // SHOP, POINTS, FREE

            $table->text('description', 5000);
            $table->text('ingredients', 5000);

            $table->text('image1_src', 10000)->nullable();
            $table->text('image2_src', 10000)->nullable();
            $table->text('image3_src', 10000)->nullable();
            $table->text('image4_src', 10000)->nullable();

            $table->string('sku', 250);
            $table->double('price');
            $table->double('discount');
            $table->integer('quantity');

            $table->boolean('visible')->default(1);
            $table->boolean('isDuo')->default(0);

            $table->text('brand', 300)->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
        Schema::disableForeignKeyConstraints();
    }
}
