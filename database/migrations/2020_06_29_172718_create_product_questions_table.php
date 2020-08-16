<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *...........
     * @return void
     */
    public function up()
    {

        Schema::create('product_questions', function (Blueprint $table) {
            $table->bigIncrements('product_question_id');
            $table->integer('question_products_id')->index('products_images_questions_id');
            $table->integer('question_customers_id')->index('idx_questions_customers_id');
            $table->enum('products_type', ['bouquet','product'])->default('product');

            $table->string('question_image')->nullable();
            $table->text('text', 65535)->nullable();
            $table->smallInteger('question_read')->default(0);
            $table->integer('sort')->default(1);;
            $table->integer('question_status')->default(0);
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
        Schema::dropIfExists('product_questions');
    }
}
