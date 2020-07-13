<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ViewCategory extends Model
{
    //
    use Sortable;

    protected $fillable = ['name_ar', 'name_en', 'sort', 'product_ids'];
}
