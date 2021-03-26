<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direct_messages', function (Blueprint $table) {
            $table->id();

            $table->string('order_id');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('store_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('body');
            $table->string('date_order');
            $table->enum('type',['CLIENT','STORE','ADMIN'])->default('CLIENT');
            $table->enum('status',['VIEW','NO-VIEW','STORE'])->default('NO-VIEW');

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
        Schema::dropIfExists('direct_messages');
    }
}
