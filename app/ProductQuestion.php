<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class ProductQuestion extends Model
{
    //

    use Sortable;

    public function paginator()
    {
        $reviews = ProductQuestion::sortable(['sort' => 'ASC'])
            ->leftJoin('products_description', 'product_questions.question_products_id', 'products_description.products_id')
            ->select('product_questions.*', 'products_description.products_name',
                DB::raw("(SELECT replay.question_text  FROM product_questions as replay

                                limit 1
                                ) as replay_text"),
                DB::raw("(SELECT replay.question_products_id  FROM product_questions as replay
                                 limit 1
                                ) as replay_id")
            )
            ->groupBy('product_questions.product_question_id')
            ->where('question_parent', 0)
            ->paginate(10);
        return $reviews;
    }

}
