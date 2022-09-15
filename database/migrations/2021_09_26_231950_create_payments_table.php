<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            
            $table->id();
            $table->timestamps();

            $table->string('method');
            $table->string('reference');
            $table->double('amount');

            $table->double('wompi_amount_in_cents')->nullable();
            $table->string('wompi_currency')->nullable();
            $table->string('wompi_method')->nullable();
            $table->string('wompi_id')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('payments');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
