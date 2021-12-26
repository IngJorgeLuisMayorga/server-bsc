<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

            $table->id();

            $table->string('name')->nullable();
            $table->string('email')->unique();

            $table->string('nid_number')->nullable();
            $table->string('nid_type')->nullable();

            $table->timestamp('birthdate')->nullable();

            $table->integer('points')->nullable();
            $table->string('photo', 5000)->default('');
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->text('comments')->nullable();

            $table->timestamp('signin_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('password')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}