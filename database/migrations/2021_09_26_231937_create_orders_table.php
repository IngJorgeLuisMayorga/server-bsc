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

            // User Data
            $table->unsignedInteger('user_id')->nullable();
            $table->string('user_nid_type')->nullable();
            $table->string('user_nid_number')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_first_name')->nullable();
            $table->string('user_last_name')->nullable();

            //Payment
            $table->unsignedInteger('payment_id')->nullable();
            $table->string('payment_wompi_id')->nullable();
            $table->string('payment_method')->nullable();
            $table->date('payment_approved_at')->nullable();

            //Coupon
            $table->unsignedInteger('coupon_id')->nullable();
            $table->string('coupon_discount')->nullable();
           
            //Order
            $table->string('order_ref')->nullable();
            $table->double('order_points')->nullable();
            $table->double('order_subtotal')->nullable();
            $table->double('order_taxes')->nullable();
            $table->double('order_total')->nullable();
            $table->json('order_products_json')->nullable();
       
            //Shipping
            $table->enum('shipping_status', ['s0_pending', 's1_ordered', 's2_shipped', "s3_delivered", "s4_canceled"])->default('s0_pending');
            $table->string('shipping_guide_ref')->nullable();
            $table->string('shipping_guide_company')->nullable();
            $table->date('shipping_ordered_at')->nullable();
            $table->date('shipping_shipped_at')->nullable();
            $table->date('shipping_delivered_at')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_department')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_phone')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('orders');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
