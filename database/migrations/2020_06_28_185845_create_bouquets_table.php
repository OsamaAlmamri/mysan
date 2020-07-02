<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBouquetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bouquets', function (Blueprint $table) {
            $table->bigIncrements('bouquet_id');
            $table->string('bouquet_name_ar');
            $table->string('bouquet_name_en');
            $table->double('bouquet_price');
            $table->text('bouquet_description_ar', 65535)->nullable();
            $table->text('bouquet_description_en', 65535)->nullable();
            $table->dateTime('expiry_date');
            $table->integer('bouquet_type');
            $table->integer('usage_count');
            $table->integer('usage_limit')->nullable();
            $table->boolean('free_shipping')->default(0);
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
        Schema::dropIfExists('bouquets');
    }
}
