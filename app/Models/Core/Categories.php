<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
use App\Http\Controllers\AdminControllers\SiteSettingController;

class Categories extends Model
{
    //
    use Sortable;
    protected $fillable=['sort_order'];

    public function images()
    {
        return $this->belongsTo('App\Images');
    }

    public function categories_description()
    {
        return $this->beliesngsTo('App\Categories_description');
    }

    public $sortable = ['categories_id', 'created_at'];
    public $sortableAs = ['categories_name'];
    protected $primaryKey='categories_id';

    public function recursivecategories($lang=2)
    {
        $items = DB::table('categories')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id')
            ->where('language_id', '=', $lang)
//            ->where('categories_status', '1')
            //->orderby('categories_id','ASC')
            ->get();

        $childs = array();
        foreach ($items as $item)
            $childs[$item->parent_id][] = $item;

        foreach ($items as $item) if (isset($childs[$item->categories_id]))
            $item->childs = $childs[$item->categories_id];
        if (count($childs) > 0) {
            $tree = $childs[0];
        } else {
            $tree = $childs;
        }

        return $tree;
    }

    public function editrecursivecategories($data)
    {
        $items = DB::table('categories')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id', 'categories_description.categories_name', 'categories.parent_id')
            ->where('language_id', '=', 1)
            ->where('categories.categories_id', '!=', $data->id)
            ->where('categories_status', '1')
            //->orderby('categories_id','ASC')
            ->get();

        $childs = array();
        foreach ($items as $item)
            $childs[$item->parent_id][] = $item;

        foreach ($items as $item) if (isset($childs[$item->categories_id]))
            $item->childs = $childs[$item->categories_id];

        if (count($childs) > 0) {
            $tree = $childs[0];
        } else {
            $tree = $childs;
        }
        return $tree;
    }

    public function paginator()
    {
        $setting = new Setting();
        $myVarsetting = new SiteSettingController($setting);
        $commonsetting = $myVarsetting->commonsetting();

        $categories = Categories::sortable(['categories_id' => 'ASC'])
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'categories.categories_image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'ACTUAL')
                            ->where('categoryTable.image_type', '!=', 'ACTUAL')
                            ->orWhere('categoryTable.image_type', '=', 'THUMBNAIL');
                    });
            })
            ->LeftJoin('image_categories as iconTable', function ($join) {
                $join->on('iconTable.image_id', '=', 'categories.categories_icon')
                    ->where(function ($query) {
                        $query->where('iconTable.image_type', '=', 'ACTUAL')
                            ->where('iconTable.image_type', '!=', 'ACTUAL')
                            ->orWhere('iconTable.image_type', '=', 'THUMBNAIL');
                    });
            })
            ->select('categories.categories_id as id', 'categories.categories_image as image',
                'categories.categories_icon as icon', 'categories.created_at as date_added',
                'categories.updated_at as last_modified', 'categories_description.categories_name as name',
                'categories_description.language_id', 'categoryTable.path as imgpath', 'iconTable.path as iconpath',
                'categories.categories_status  as categories_status')
            ->where('categories_description.language_id', '1')
            ->groupby('categories.categories_id')
            ->paginate($commonsetting['pagination']);

        return $categories;
    }

    public function getAllCategories($lang = 2)
    {
        $setting = new Setting();
        $myVarsetting = new SiteSettingController($setting);
        $commonsetting = $myVarsetting->commonsetting();

        $categories = Categories::sortable(['categories_id' => 'ASC'])
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'categories.categories_image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'ACTUAL')
                            ->where('categoryTable.image_type', '!=', 'ACTUAL')
                            ->orWhere('categoryTable.image_type', '=', 'THUMBNAIL');
                    });
            })
            ->LeftJoin('image_categories as iconTable', function ($join) {
                $join->on('iconTable.image_id', '=', 'categories.categories_icon')
                    ->where(function ($query) {
                        $query->where('iconTable.image_type', '=', 'ACTUAL')
                            ->where('iconTable.image_type', '!=', 'ACTUAL')
                            ->orWhere('iconTable.image_type', '=', 'THUMBNAIL');
                    });
            })
            ->select('categories.categories_id as id', 'categories_description.categories_name as name',
                'categories_description.language_id', 'categoryTable.path as imgpath', 'iconTable.path as iconpath')
            ->where('categories_description.language_id', $lang)
            ->groupby('categories.categories_id')->get();

        return $categories;
    }


    public function getter($language_id)
    {
        $listingCategories = DB::table('categories')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id as id', 'categories.categories_image as image', 'categories.created_at as date_added', 'categories.updated_at as last_modified', 'categories_description.categories_name as name', 'categories.categories_slug as slug')
            ->where('categories_description.language_id', '=', $language_id)
            ->where('parent_id', '>', '0')
            ->where('categories_status', '1')
            ->get();

        return $listingCategories;
    }

    public function allCategories2($language_id, $parent)
    {
        $listingCategories = DB::table('categories')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'categories.categories_image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->LeftJoin('image_categories as iconTable', function ($join) {
                $join->on('iconTable.image_id', '=', 'categories.categories_icon')
                    ->where(function ($query) {
                        $query->where('iconTable.image_type', '=', 'THUMBNAIL')
                            ->where('iconTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('iconTable.image_type', '=', 'ACTUAL');
                    });
            })
            ->select('categories.categories_id',
                'categoryTable.path as imgpath', 'iconTable.path as iconpath', 'categories_description.categories_name', 'categories.parent_id')
//            ->where('language_id','=', 1)
            ->where('categories_status', '1')
            ->where('categories_description.language_id', '=', $language_id)
            ->where('parent_id', '=', $parent)
            ->get();
        return $listingCategories;
    }

    public function recursivecategories2($language_id)
    {
        $items = DB::table('categories')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->LeftJoin('image_categories as categoryTable', function ($join) {
                $join->on('categoryTable.image_id', '=', 'categories.categories_image')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'ACTUAL')
                            ->where('categoryTable.image_type', '!=', 'ACTUAL')
                            ->orWhere('categoryTable.image_type', '=', 'THUMBNAIL');
                    });
            })
            ->LeftJoin('image_categories as iconTable', function ($join) {
                $join->on('iconTable.image_id', '=', 'categories.categories_icon')
                    ->where(function ($query) {
                        $query->where('iconTable.image_type', '=', 'ACTUAL')
                            ->where('iconTable.image_type', '!=', 'ACTUAL')
                            ->orWhere('iconTable.image_type', '=', 'THUMBNAIL');
                    });
            })
            ->select('categories.categories_id',
                'categoryTable.path as imgpath', 'iconTable.path as iconpath', 'categories_description.categories_name', 'categories.parent_id')
            ->where('categories_status', '1')
            ->where('categories_description.language_id', '=', $language_id)
            ->get();

        $childs = array();
        foreach ($items as $item)
            $childs[$item->parent_id][] = $item;

        foreach ($items as $item) if (isset($childs[$item->categories_id]))
            $item->childs = $childs[$item->categories_id];
        if (count($childs) > 0) {
            $tree = $childs[0];
        } else {
            $tree = $childs;
        }

        return $tree;
    }

    public function allcategories($language_id)
    {
        $listingCategories = DB::table('categories')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id as id', 'categories.categories_image as image', 'categories.created_at as date_added', 'categories.updated_at as last_modified', 'categories_description.categories_name as name', 'categories.categories_slug as slug')
            ->where('categories_description.language_id', '=', $language_id)
            ->where('categories_status', '1')
            ->get();
        return $listingCategories;
    }

    public function filter($data)
    {
        $name = $data['FilterBy'];
        $param = $data['parameter'];

        switch ($name) {
            case 'Name':
                $categories = Categories::sortable(['categories_id' => 'ASC'])
                    ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
                    ->leftJoin('images', 'images.id', '=', 'categories.categories_image')
                    ->leftJoin('image_categories as categoryTable', 'categoryTable.image_id', '=', 'categories.categories_image')
                    ->leftJoin('image_categories as iconTable', 'iconTable.image_id', '=', 'categories.categories_icon')
                    ->select('categories.categories_id as id', 'categories.categories_image as image',
                        'categories.categories_icon as icon', 'categories.created_at as date_added',
                        'categories.updated_at as last_modified', 'categories_description.categories_name as name',
                        'categories_description.language_id', 'categoryTable.path as imgpath', 'iconTable.path as iconpath', 'categories.categories_status  as categories_status')
                    ->where('categories_description.language_id', '1')
                    ->where(function ($query) {
                        $query->where('categoryTable.image_type', '=', 'THUMBNAIL')
                            ->where('categoryTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('categoryTable.image_type', '=', 'ACTUAL')
                            ->where('iconTable.image_type', '=', 'THUMBNAIL')
                            ->where('iconTable.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('iconTable.image_type', '=', 'ACTUAL');
                    })
                    ->where('categories_description.categories_name', 'LIKE', '%' . $param . '%')
                    ->groupby('categories.categories_id')
                    ->paginate(10);

                break;
            case 'Main':

                $categories = Categories::sortable(['categories_id' => 'ASC'])
                    ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
                    ->leftJoin('categories as mainCategory', 'mainCategory.categories_id', '=', 'categories.categories_id')
                    ->leftJoin('categories_description as mainCategoryDesc', 'mainCategoryDesc.categories_id', '=', 'categories.parent_id')
                    ->leftJoin('image_categories as categoryTable', 'categoryTable.image_id', '=', 'categories.categories_image')
                    ->leftJoin('image_categories as iconTable', 'iconTable.image_id', '=', 'categories.categories_icon')
                    ->select(
                        'categories.categories_id as subId',
                        'categories.categories_image as image',
                        'categories.categories_icon as icon',
                        'categories.created_at as date_added',
                        'categories.updated_at as last_modified',
                        'categories_description.categories_name as subCategoryName',
                        'mainCategoryDesc.categories_name as mainCategoryName',
                        'categories_description.language_id', 'categoryTable.path as imgpath', 'iconTable.path as iconpath'
                    )
                    ->where('categories.parent_id', '>', '0')
                    ->where('mainCategoryDesc.categories_name', 'LIKE', '%' . $param . '%')
                    ->where('mainCategoryDesc.language_id', '1')
                    ->where('categories_description.language_id', '1')
                    ->groupby('categories.categories_id')
                    ->paginate(10);
                break;
            default:
                $categories = Categories::sortable(['categories_id' => 'ASC'])
                    ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
                    ->leftJoin('categories as mainCategory', 'mainCategory.categories_id', '=', 'categories.categories_id')
                    ->leftJoin('categories_description as mainCategoryDesc', 'mainCategoryDesc.categories_id', '=', 'categories.parent_id')
                    ->leftJoin('image_categories as categoryTable', 'categoryTable.image_id', '=', 'categories.categories_image')
                    ->leftJoin('image_categories as iconTable', 'iconTable.image_id', '=', 'categories.categories_icon')
                    ->select(
                        'categories.categories_id as subId',
                        'categories.categories_image as image',
                        'categories.categories_icon as icon',
                        'categories.created_at as date_added',
                        'categories.updated_at as last_modified',
                        'categories_description.categories_name as subCategoryName',
                        'mainCategoryDesc.categories_name as mainCategoryName',
                        'categories_description.language_id', 'categoryTable.path as imgpath', 'iconTable.path as iconpath'
                    )
                    ->where('categories.parent_id', '>', '0')->where('mainCategoryDesc.language_id', '1')
                    ->where('categories_description.language_id', '1')
                    ->groupby('categories.categories_id')
                    ->paginate(10);
                break;
        }
        return $categories;
    }

    public function insert($uploadImage, $date_added, $parent_id, $uploadIcon, $categories_status)
    {
        $categories = DB::table('categories')->insertGetId([
            'categories_image' => $uploadImage,
            'created_at' => $date_added,
            'parent_id' => $parent_id,
            'categories_icon' => $uploadIcon,
            'categories_slug' => 'Null',
            'categories_status' => $categories_status
        ]);
        return $categories;
    }

    public function insertcategorydescription($categoryNameSub, $categories_id, $languages_data_id)
    {
        DB::table('categories_description')->insert([
            'categories_name' => $categoryNameSub,
            'categories_id' => $categories_id,
            'language_id' => $languages_data_id
        ]);
    }

    public function checkSulg($currentSlug)
    {
        $checkSlug = DB::table('categories')->where('categories_slug', $currentSlug)->get();
        return $checkSlug;
    }

    public function edit($request)
    {
        $category = DB::table('categories')->leftJoin('images', 'images.id', '=', 'categories.categories_image')
            ->leftJoin('image_categories as ImageTable', 'ImageTable.image_id', '=', 'categories.categories_image')
            ->leftJoin('image_categories as IconTable', 'IconTable.image_id', '=', 'categories.categories_icon')
            ->select('categories.categories_id as id', 'categories.categories_image as image',
                'categories.categories_icon as icon', 'categories.created_at as date_added',
                'categories.updated_at as last_modified', 'categories.categories_slug as slug',
                'ImageTable.path as imagepath', 'IconTable.path as iconpath')
            ->where('categories.categories_id', $request->id)->get();
        return $category;
    }

    public function updaterecord($categories_id, $uploadImage, $uploadIcon, $last_modified, $parent_id, $slug, $categories_status)
    {
        DB::table('categories')->where('categories_id', $categories_id)->update(
            [
                'categories_image' => $uploadImage,
                'categories_icon' => $uploadIcon,
                'updated_at' => $last_modified,
                'parent_id' => $parent_id,
                'categories_slug' => $slug,
                'categories_status' => $categories_status
            ]);
    }

    public function checkExit($categories_id, $languages_data)
    {
        $checkExist = DB::table('categories_description')->where('categories_id', '=', $categories_id)->where('language_id', '=', $languages_data->languages_id)->get();
        return $checkExist;
    }

    public function updatedescription($categories_name, $languages_data, $categories_id)
    {
        $category = DB::table('categories_description')->where('categories_id', '=', $categories_id)->where('language_id', '=', $languages_data->languages_id)->update([
            'categories_name' => $categories_name,
        ]);
        return $category;
    }


    public function checkSlug($currentSlug)
    {
        $checkSlug = DB::table('categories')->where('categories_slug', $currentSlug)->get();
        return $checkSlug;
    }

    public function updateSlug($categories_id, $slug)
    {
        $updateSlug = DB::table('categories')->where('categories_id', $categories_id)->update([
            'categories_slug' => $slug
        ]);
        return $updateSlug;
    }

    public function subcategorydes()
    {
        $categories = DB::table('categories')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
            ->select('categories.categories_id as mainId', 'categories_description.categories_name as mainName')
            ->where('parent_id', '0')->get();
        return $categories;
    }

    public function editsubcategory($request)
    {
        $editSubCategory = DB::table('categories')
            ->leftJoin('image_categories as categoryTable', 'categoryTable.image_id', '=', 'categories.categories_image')
            ->leftJoin('image_categories as iconTable', 'iconTable.image_id', '=', 'categories.categories_icon')
            ->select('categories.categories_id as id', 'categories.categories_image as image', 'categories.categories_icon as icon', 'categories.created_at as date_added', 'categories.updated_at as last_modified',
                'categories.categories_slug as slug', 'categories.categories_status  as categories_status', 'categories.parent_id as parent_id', 'categoryTable.path as imgpath', 'iconTable.path as iconpath')
            ->where('categories.categories_id', $request->id)->get();
        return $editSubCategory;
    }

    public function editdescription($languages_id, $id)
    {
        $description = DB::table('categories_description')->where([
            ['language_id', '=', $languages_id],
            ['categories_id', '=', $id],
        ])->get();
        return $description;
    }

    public function deleterecord($request)
    {
        $category_id = $request->id;
        DB::table('categories')->where('categories_id', $category_id)->delete();
        DB::table('categories_description')->where('categories_id', $category_id)->delete();
        DB::table('products_to_categories')->where('categories_id', $category_id)->delete();
        return "success";
    }

}
