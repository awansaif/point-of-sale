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
            $table->string('product_pic')->default('https://image.shutterstock.com/image-illustration/set-colorful-empty-shopping-bags-260nw-691305127.jpg');
            $table->string('name')->unique();
            $table->foreignId('type')->constrained('product_types')->onDelete('Cascade');
            $table->foreignId('brand')->constrained('product_brands')->onDelete('Cascade');
            $table->tinyInteger('stock');
            $table->string('cost_per_item');
            $table->string('inventory_worth');
            $table->string('revenue_generated')->default(0);
            $table->foreignId('vendor')->constrained('product_vendors')->onDelete('Cascade');
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
