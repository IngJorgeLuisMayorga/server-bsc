<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->json('products_json')->nullable();
            $table->json('coupon_json')->nullable();

            $table->string('phone');
            $table->string('address');
            $table->string('city');

            $table->double('subtotal');
            $table->double('taxes');
            $table->double('discounts');
            $table->double('points');
            $table->double('total');

            // 
            // $table->double('no_guia');

            // 3 CORREOS (AL CLIENTE)
            $table->date('ordered_at')->nullable(); // fecha de la compra
            $table->date('shipped_at')->nullable(); // fecha de envio
            $table->date('delivered_at')->nullable(); // fecha de recibido. 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('orders');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
