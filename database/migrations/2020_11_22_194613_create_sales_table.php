<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->bigInteger('cantidad')->unsigned()->default(0);
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('price_sale', 12, 2)->default(0);
            $table->enum('state',['Ordenado','Pagado','Entregado','Finalizada','Cancelada'])->default('Ordenado');

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
        Schema::dropIfExists('sales');
    }
}
