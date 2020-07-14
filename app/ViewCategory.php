<?php

namespace App;

use App\Models\Core\Images;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ViewCategory extends Model
{
    //
    use Sortable;

    protected $fillable = ['name_ar', 'name_en', 'image', 'content', 'parent', 'sort', 'product_ids'];

//
    public function imagePath()
    {
        //            ->leftJoin('image_categories as categoryTable', 'categoryTable.image_id', '=', 'categories.categories_image')
        return $this->belongsTo(Images::class, 'image', 'id');
    }

    public function subViewCategories($ids, $lang = 'ar')
    {

        $all = ViewCategory::all()->whereIn('id', $ids);
        $views = [];
        foreach ($all as $v) {
            $views[] = array(
                'id' => $v->id,
                'name' => ($lang == 1) ? $v->name_en : $v->name_ar,
                'image' => $v->imagePath->imagesTHUMBNAIL->path,
            );
        }
        return $views;
    }
}
