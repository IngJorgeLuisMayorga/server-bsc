<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupons', function (Blueprint $table) {

            $table->id();
            $table->timestamps();
            
            $table->string('name');
            $table->string('code');
  
            $table->boolean('enable');
        
            $table->timestamp('from_date');
            $table->timestamp('to_date');

            $table->string('type');

            $table->unsignedBigInteger('variable_give_product_A_id')->nullable();
            $table->unsignedBigInteger('variable_give_product_B_id')->nullable();
            $table->unsignedBigInteger('variable_give_product_C_id')->nullable();

            $table->double('variable_give_discount_percentage')->nullable();
            $table->double('variable_give_discount_amount')->nullable();
            $table->double('variable_give_free_shipping')->nullable();

            $table->string('variable_by_brand_equal')->nullable();
            $table->double('variable_by_total_bigger_than')->nullable();  

            $table->integer('variable_by_first_N_orders_today_by_N')->nullable();
            $table->unsignedBigInteger('variable_by_first_N_orders_today_by_productId')->nullable();       
            
            $table->integer('variable_by_2_products_same_brand_brand')->nullable();
            $table->unsignedBigInteger('variable_by_2_products_same_brand_give_3rd_discount')->nullable();       

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cupons');
        Schema::disableForeignKeyConstraints();
    }
}
