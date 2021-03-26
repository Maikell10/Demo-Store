<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->foreignId('provider_id')->references('id')->on('providers')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('serie');
            $table->string('number');
            $table->decimal('tax', 4, 2)->default(0);
            $table->decimal('profit', 4, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->enum('state',['Cargada','Pagada','Anulada'])->default('Cargada');
            
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
        Schema::dropIfExists('purchases');
    }
}
