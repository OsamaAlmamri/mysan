<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class QuestionReplay extends Model
{
    //
    use Sortable;

    protected $primaryKey = 'replay_id';
    protected $fillable = [
        'product_question_id', 'replay_user_id', 'text', 'replay_user_type',
    ];


    function user()
    {
        return $this->belongsTo(User::class, 'replay_user_id', 'id');
    }

}

