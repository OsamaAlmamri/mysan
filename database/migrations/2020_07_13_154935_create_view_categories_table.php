<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->text('product_ids');
            $table->string('name_ar');
            $table->string('image')->nullable();
            $table->string('name_en');
            $table->integer('parent')->default(0);
            $table->enum('content', ['products', 'categories'])->default('products');
            $table->integer('sort')->default(1);
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
        Schema::dropIfExists('view_categories');
    }
}
