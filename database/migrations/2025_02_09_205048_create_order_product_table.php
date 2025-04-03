<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id(); // Id para la tabla pivote (opcional, puedes omitirlo si no lo necesitas)
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Referencia a la tabla de orders
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Referencia a la tabla de products
            $table->decimal('price', 10, 2); // Precio del producto en ese pedido
            $table->integer('quantity'); // Cantidad del producto en el pedido
            $table->timestamps(); // Si deseas mantener marcas de tiempo (opcional)
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_product');
    }
};
