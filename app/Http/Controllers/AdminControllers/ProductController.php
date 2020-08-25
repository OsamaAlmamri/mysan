<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\AlertController;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Categories;
use App\Models\Core\Images;
use App\Models\Core\Languages;
use App\Models\Core\Manufacturers;
use App\Models\Core\Products;
use App\Models\Core\Reviews;
use App\Models\Core\Setting;
use App\Models\Core\ProductQuestion;
use App\QuestionReplay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ProductController extends Controller
{

    public function __construct(Products $products, Languages $language, Images $images, Categories $category, Setting $setting,
                                Manufacturers $manufacturer, Reviews $reviews, ProductQuestion $productQuestion)
    {
        $this->category = $category;
        $this->reviews = $reviews;
        $this->productQuestion = $productQuestion;
        $this->language = $language;
        $this->images = $images;
        $this->manufacturer = $manufacturer;
        $this->products = $products;
        $this->myVarsetting = new SiteSettingController($setting);
        $this->myVaralter = new AlertController($setting);
        $this->Setting = $setting;

    }


//    public function display(Request $request)
//    {
//        $language_id = '1';
//        $categories_id = $request->categories_id;
//        $product = $request->product;
//        $title = array('pageTitle' => Lang::get("labels.Products"));
//        $subCategories = $this->category->allcategories($language_id);
//        $products = $this->products->paginator($request);
//        $results['products'] = $products;
//        $results['currency'] = $this->myVarsetting->getSetting();
//        $results['units'] = $this->myVarsetting->getUnits();
//        $results['subCategories'] = $subCategories;
//        $currentTime = array('currentTime' => time());
//        $result['commonContent'] = $this->Setting->commonContent();
//        return view("admin.products.index", $title)->with('result', $result)->with('results', $results)->with('categories_id', $categories_id)->with('product', $product);
//
//    }

    public function display(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.Products"));
        $results['currency'] = $this->myVarsetting->getSetting();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products.index2", $title)
            ->with('result', $result)
            ->with('results', $results);
    }

    public function active(Request $r)
    {
        $new_status = 1;
        if ($r->status == 1)
            $new_status = 0;
        $user = Products::find($r->id);
        $user->products_status = $new_status;
        $user->save();
        return $new_status;
    }


    public function getData($main, $sub, $from_date = '1970-01-01', $to_date = '9999-09-09')
    {
        if ($main == 'all' and $sub == 'all')
            $ids = 'all';
        elseif ($main > 0 and $sub == 'all')
            $ids = getProductsIdsAccordingForMainCategory($main);
        elseif (
            ($main == 'all' and $sub > 0) or
            ($main > 0 and $sub > 0))
            $ids = getProductsIdsAccordingForSubCategory($sub);
        $btn__avg_Rating = "(SELECT COALESCE(AVG(reviews_rating),0) FROM reviews WHERE reviews.products_id=products.products_id ) as avg_rating";
        $btn_count_Rating = "(SELECT count(reviews_rating) FROM reviews WHERE reviews.products_id=products.products_id  ) as count_rating";

        $data = DB::table('products')
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->LeftJoin('manufacturers', function ($join) {
                $join->on('manufacturers.manufacturers_id', '=', 'products.manufacturers_id');
            })
            ->LeftJoin('specials', function ($join) {
                $join->on('specials.products_id', '=', 'products.products_id')->where('specials.status', '=', '1');
            })
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'products.products_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            })
            ->leftJoin('products_to_categories', 'products.products_id', '=', 'products_to_categories.products_id')
            ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
            ->leftJoin('categories_description', 'categories.categories_id', '=', 'categories_description.categories_id')
            ->select('products.*',
                DB::raw($btn__avg_Rating),
                DB::raw($btn_count_Rating),
                'products_description.*', 'specials.specials_id', 'manufacturers.*',
                'specials.products_id as special_products_id', 'specials.specials_new_products_price as specials_products_price',
                'specials.specials_date_added as specials_date_added', 'specials.specials_last_modified as specials_last_modified',
                'specials.expires_date', 'image_categories.path as path', 'products.updated_at as productupdate', 'categories_description.categories_id',
                'categories_description.categories_name')
            ->where('products_description.language_id', '=', 2)
            ->where('categories_description.language_id', '=', 2);
        if (!($main == 'all' and $sub == 'all'))
            $data = $data->whereIn('products.products_id', $ids);
        $data = $data
            ->whereBetween('products.created_at', [$from_date, $to_date])
            ->orderBy('sort')
            ->get()->unique('products_id')->keyBy('products_id');
        return $data;
    }

    public function filter2(Request $request)
    {
        $from = ($request->from_date == null) ? date('1974-01-01') : date($request->from_date);
        $to = ($request->to_date == null) ? date('9999-01-01') : date($request->to_date);
        $data = $this->getData($request->main, $request->sub, $from, $to);
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('manage', 'admin.products.btn.manage')
            ->addColumn('btn_image', 'admin.products.btn.image')
            ->addColumn('info', 'admin.products.btn.info')
            ->addColumn('status', 'admin.products.btn.status')
            ->addColumn('rating', 'admin.products.btn.rating')
            ->addColumn('btn_sort', 'admin.sortFiles.btn_sort')
            ->rawColumns(['manage', 'btn_sort', 'rating', 'status', 'btn_image', 'info'])
            ->make(true);
    }


    public function add(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddProduct"));
        $language_id = '2';
        $allimage = $this->images->getimages();
        $result = array();
        $categories = $this->category->recursivecategories($language_id);
//        return dd($categories);
        $parent_id = array();
        $option = '<ul class="list-group list-group-root well">';
        foreach ($categories as $parents) {
            if (in_array($parents->categories_id, $parent_id)) {
                $checked = 'checked';
            } else {
                $checked = '';
            }
            $option .= '<li href="#" class="list-group-item">
          <label style="width:100%">
          ' . $parents->categories_name . '
          </label></li>';
//            $option .= '<li href="#" class="list-group-item">
//          <label style="width:100%">
//            <input id="categories_' . $parents->categories_id . '" ' . $checked . ' type="checkbox"  class=" required_one categories sub_categories" name="categories[]" value="' . $parents->categories_id . '">
//          ' . $parents->categories_name . '
//          </label></li>';

            if (isset($parents->childs)) {
                $option .= '<ul class="list-group">
          <li class="list-group-item">';
                $option .= $this->childcat($parents->childs, $parent_id);
                $option .= '</li></ul>';
            }
        }
        $option .= '</ul>';

        $result['categories'] = $option;

        $result['manufacturer'] = $this->manufacturer->getter($language_id);
        $taxClass = DB::table('tax_class')->get();
        $result['taxClass'] = $taxClass;
        $result['languages'] = $this->myVarsetting->getLanguages();
        $result['units'] = $this->myVarsetting->getUnits();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products.add", $title)->with('result', $result)->with('allimage', $allimage);

    }

    public
    function changeOrder(Request $request)
    {
        $sortData = Products::all();
        changeOrder($request, $sortData, 'products_id', 'sort');
        return response('Update Successfully.', 200);
    }

    public function childcat($childs, $parent_id)
    {

        $contents = '';
        foreach ($childs as $key => $child) {

            if (in_array($child->categories_id, $parent_id)) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $contents .= '<label> <input id="categories_' . $child->categories_id . '" parents_id="' . $child->parent_id . '"  type="checkbox" name="categories[]" class="required_one sub_categories categories sub_categories_' . $child->parent_id . '" value="' . $child->categories_id . '" ' . $checked . '> ' . $child->categories_name . '</label>';

            if (isset($child->childs)) {
                $contents .= '<ul class="list-group">
        <li class="list-group-item">';
                $contents .= $this->childcat($child->childs, $parent_id);
                $contents .= "</li></ul>";
            }

        }
        return $contents;
    }

    public function edit(Request $request)
    {
        $allimage = $this->images->getimages();
        $result = $this->products->edit($request);
        //dd($result['categories_array']);
        $categories = $this->category->recursivecategories();

        $parent_id = $result['categories_array'];
        $option = '<ul class="list-group list-group-root well">';

        foreach ($categories as $parents) {

            if (in_array($parents->categories_id, $parent_id)) {
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $option .= '<li href="#" class="list-group-item">
          <label style="width:100%">
          ' . $parents->categories_name . '
          </label></li>';

            if (isset($parents->childs)) {
                $option .= '<ul class="list-group">
        <li class="list-group-item">';
                $option .= $this->childcat($parents->childs, $parent_id);
                $option .= '</li></ul>';
            }
        }

        $option .= '</ul>';
        $result['categories'] = $option;
        $title = array('pageTitle' => Lang::get("labels.EditProduct"));
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products.edit", $title)->with('result', $result)->with('allimage', $allimage);

    }

    public function update(Request $request)
    {
        $result = $this->products->updaterecord($request);
        $products_id = $request->id;
        if ($request->products_type == 1) {
            return redirect('admin/products/attach/attribute/display/' . $products_id);
        } else {
            return redirect('admin/products/images/display/' . $products_id);
        }
    }

    public function delete(Request $request)
    {
        $this->products->deleterecord($request);
        return redirect()->back()->withErrors([Lang::get("labels.ProducthasbeendeletedMessage")]);

    }

    public function insert(Request $request)
    {
        return dd($request);

        $title = array('pageTitle' => Lang::get("labels.AddAttributes"));
        $language_id = '1';
        $products_id = $this->products->insert($request);
        $result['data'] = array('products_id' => $products_id, 'language_id' => $language_id);
        $alertSetting = $this->myVaralter->newProductNotification($products_id);
        if ($request->products_type == 1) {
            return redirect('/admin/products/attach/attribute/display/' . $products_id);
        } else {
            return redirect('admin/products/images/display/' . $products_id);
        }
    }

    public function addinventory(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ProductInventory"));
        $id = $request->id;
        $result = $this->products->addinventory($id);

        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products.inventory.add", $title)->with('result', $result);

    }

    public function ajax_min_max($id)
    {
        $title = array('pageTitle' => Lang::get("labels.ProductInventory"));
        $result = $this->products->ajax_min_max($id);
        return $result;

    }

    public function ajax_attr($id)
    {
        $title = array('pageTitle' => Lang::get("labels.ProductInventory"));
        $result = $this->products->ajax_attr($id);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products.inventory.attribute_div")->with('result', $result);

    }

    public function addinventoryfromsidebar(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ProductInventory"));
        $result = $this->products->addinventoryfromsidebar();
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products.inventory.add1", $title)->with('result', $result);

    }

    public function addnewstock(Request $request)
    {

        $this->products->addnewstock($request);
        return redirect()->back()->withErrors([Lang::get("labels.inventoryaddedsuccessfully")]);

    }

    public function addminmax(Request $request)
    {

        $this->products->addminmax($request);
        return redirect()->back()->withErrors([Lang::get("labels.Min max level added successfully")]);

    }

    public function displayProductImages($id, $type = 'product')
    {
        $title = array('pageTitle' => Lang::get("labels.AddImages"));
        $result = $this->products->displayProductImages($id, $type);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products/images/index", $title)
            ->with('result', $result)
            ->with('products_id', $id)
            ->with('products_type', $type);

    }

    public function addProductImages($products_id, $type='product')
    {
        $title = array('pageTitle' => Lang::get("labels.AddImages"));
        $allimage = $this->images->getimages();
        $result = $this->products->addProductImages($products_id);
        $result['commonContent'] = $this->Setting->commonContent();
        return view('admin.products.images.edit', $title)
            ->with('result', $result)
            ->with('products_id', $products_id)
            ->with('products_type', $type)
            ->with('allimage', $allimage);

    }

    public function insertProductImages(Request $request)
    {
        $product_id = $this->products->insertProductImages($request);
        return redirect()->back()->with('product_id', $product_id);
    }

    public function editProductImages($id,$type='product')
    {

        $allimage = $this->images->getimages();
        $products_images = $this->products->editProductImages($id);
        $result['commonContent'] = $this->Setting->commonContent();

//        return dd($allimage);
        return view("admin/products/images/edit")
            ->with('products_images', $products_images)
            ->with('allimage', $allimage)
            ->with('old_image', $products_images[0]->path)
            ->with('products_id', $products_images[0]->products_id)
            ->with('products_type', $type)
            ->with('result', $result);

    }

    public function updateproductimage(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.Manage Values"));
        $result = $this->products->updateproductimage($request);
        return redirect()->back();

    }

    public function deleteproductimagemodal(Request $request)
    {

        $products_id = $request->products_id;
        $id = $request->id;
        $result['data'] = array('products_id' => $products_id, 'id' => $id);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin/products/images/modal/delete")->with('result', $result);

    }

    public function deleteproductimage(Request $request)
    {
        $this->products->deleteproductimage($request);
        return redirect()->back()->with('success', trans('labels.DeletedSuccessfully'));

    }

    public function addproductattribute(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.AddAttributes"));
        $result = $this->products->addproductattribute($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin.products.attribute.add", $title)->with('result', $result);
    }

    public function addnewdefaultattribute(Request $request)
    {
        $products_attributes = $this->products->addnewdefaultattribute($request);
        return ($products_attributes);
    }

    public function editdefaultattribute(Request $request)
    {
        $result = $this->products->editdefaultattribute($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin/products/pop_up_forms/editdefaultattributeform")->with('result', $result);
    }

    public function updatedefaultattribute(Request $request)
    {
        $products_attributes = $this->products->updatedefaultattribute($request);
        return ($products_attributes);

    }

    public function deletedefaultattributemodal(Request $request)
    {

        $products_id = $request->products_id;
        $products_attributes_id = $request->products_attributes_id;
        $result['data'] = array('products_id' => $products_id, 'products_attributes_id' => $products_attributes_id);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin/products/modals/deletedefaultattributemodal")->with('result', $result);

    }

    public function deletedefaultattribute(Request $request)
    {
        $products_attributes = $this->products->deletedefaultattribute($request);
        return ($products_attributes);
    }

    public function showoptions(Request $request)
    {
        $products_attributes = $this->products->showoptions($request);
        return ($products_attributes);
    }

    public function editoptionform(Request $request)
    {
        $result = $this->products->editoptionform($request);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin/products/pop_up_forms/editproductattributeoptionform")->with('result', $result);

    }

    public function updateoption(Request $request)
    {
        $products_attributes = $this->products->updateoption($request);
        return ($products_attributes);
    }

    public function showdeletemodal(Request $request)
    {

        $products_id = $request->products_id;
        $products_attributes_id = $request->products_attributes_id;
        $result['data'] = array('products_id' => $products_id, 'products_attributes_id' => $products_attributes_id);
        $result['commonContent'] = $this->Setting->commonContent();
        return view("admin/products/modals/deleteproductattributemodal")->with('result', $result);

    }

    public function deleteoption(Request $request)
    {
        $products_attributes = $this->products->deleteoption($request);
        return ($products_attributes);

    }

    public function getOptionsValue(Request $request)
    {
        $value = $this->products->getOptionsValue($request);
        if (count($value) > 0) {
            foreach ($value as $value_data) {
                $value_name[] = "<option value='" . $value_data->products_options_values_id . "'>" . $value_data->options_values_name . "</option>";
            }
        } else {
            $value_name = "<option value=''>" . Lang::get("labels.ChooseValue") . "</option>";
        }
        print_r($value_name);
    }

    public function currentstock(Request $request)
    {
        $result = $this->products->currentstock($request);
        print_r(json_encode($result));

    }

}
