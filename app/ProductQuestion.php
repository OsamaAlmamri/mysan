<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class ProductQuestion extends Model
{
    //

    use Sortable;

    protected $primaryKey = 'product_question_id';
    protected $fillable = [
        'question_products_id', 'question_customers_id', 'question_image', 'question_text',
        'replay', 'question_read', 'sort', 'question_status',
    ];

    function paginator()
    {
        $reviews = ProductQuestion::sortable(['sort' => 'ASC'])
            ->leftJoin('products_description', 'product_questions.question_products_id', 'products_description.products_id')
            ->select('product_questions.*', 'products_description.products_name'
            )
            ->groupBy('product_questions.product_question_id')
            ->paginate(10);
        return $reviews;
    }

    function replies()
    {
        return $this->hasMany(QuestionReplay::class, 'product_question_id', 'product_question_id')->orderByDesc('replay_id');
    }

}
