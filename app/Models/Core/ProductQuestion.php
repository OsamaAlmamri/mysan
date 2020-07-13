<?php


namespace App\Models\Core;
use App\QuestionReplay;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class ProductQuestion extends Model
{
    //

    use Sortable;
protected $table='product_questions';
    protected $primaryKey = 'product_question_id';
    protected $fillable = [
        'question_products_id', 'question_customers_id', 'question_image', 'text',
        'replay', 'question_read', 'sort', 'question_status',
    ];

    function paginator()
    {
        $reviews = ProductQuestion::sortable(['sort' => 'ASC'])
            ->leftJoin('products_description', 'product_questions.question_products_id', 'products_description.products_id')
            ->select('product_questions.*', 'products_description.products_name',
                DB::raw("(select count(question_replays.product_question_id) from question_replays where question_replays.product_question_id = product_questions.product_question_id) AS replyes")
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
