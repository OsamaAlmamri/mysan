<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBouquetProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //
    public function up()
    {
        Schema::create('bouquet_products', function (Blueprint $table) {
            $table->bigIncrements('bouquet_product_id');
            $table->unsignedBigInteger('bouquet_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->string('product_option_values')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bouquet_products');
    }
}
