<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating_stores', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('store_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('rating',['+','-','N'])->default('+');
            $table->text('opinion');
            $table->string('selectOption')->nullable();
            $table->enum('status',['USER','STORE'])->default('USER');
            $table->timestamp('created_sale');

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
        Schema::dropIfExists('rating_stores');
    }
}
