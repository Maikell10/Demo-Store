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
            $table->string('nombre')->unique();
            $table->string('slug')->unique();

            $table->foreignId('main_category_id')->references('id')->on('main_categories');
            //$table->unsignedBigInteger('sub_category_id');
            $table->bigInteger('cantidad')->unsigned()->default(0);
            $table->decimal('precio_actual', 12, 2)->default(0);
            $table->decimal('precio_anterior', 12, 2)->default(0);
            $table->integer('porcentaje_descuento')->unsigned()->default(0);
            $table->text('descripcion_corta')->nullable();
            $table->text('descripcion_larga')->nullable();
            $table->text('especificaciones')->nullable();
            $table->text('datos_de_interes')->nullable();
            $table->unsignedBigInteger('visitas')->default(0);
            $table->unsignedBigInteger('ventas')->default(0);
            $table->string('estado');
            $table->char('activo', 2);
            $table->char('sliderprincipal', 2);
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
        Schema::dropIfExists('products');
    }
}
