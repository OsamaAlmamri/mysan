<?php

namespace App\Http\Controllers\API;

//validator is builtin class in laravel
use App\Models\API\Currency;
use App\Models\API\Index;

//for password encryption or hash protected
use App\Models\API\Languages;

//for authenitcate login data
use App\Models\API\Products;
use Auth;

//for requesting a value
use DB;

//for Carbon a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Lang;
use Session;
use Validator;

//email

class ProductsController extends BaseAPIController
{
    public function __construct(
        Index $index,
        Languages $languages,
        Products $products,
        Currency $currency
    )
    {
        $this->index = $index;
        $this->languages = $languages;
        $this->products = $products;
        $this->currencies = $currency;
    }

    public function reviews(Request $request)
    {
//        return auth()->user();

        try {
            $validator = Validator::make($request->all(), [
                'products_id' => 'required',
                'reviews_text' => 'required',
                'reviews_rating' => 'required|numeric|min:1|max:5',
            ],
                [
                    'products_id.required' => 'رقم المنتج مطلوب',
                    'reviews_text.required' => ' نص التقييم مطلوب',
                    'reviews_rating.required' => 'التفييم مطلوب',
                    'reviews_rating.numeric' => 'التفييم يجب ان يكون رقم   ' ,
                    'reviews_rating.min' => 'يرجى اختيار رقم من 1 - 5   ' ,
                    'reviews_rating.max' => 'يرجى اختيار رقم من 1 - 5   ' ,

                ]);
            if ($validator->fails()) {
                return $this->sendError('error validation', $validator->errors(), 422);
            }
            if (auth()->user()!=null) {
                $check = DB::table('reviews')
                    ->where('customers_id', auth()->user()->id)
                    ->where('products_id', $request->products_id)
                    ->first();

                if ($check) {
                    return $this->sendResponse(0,'already_commented');
                }
                $id = DB::table('reviews')->insertGetId([
                    'products_id' => $request->products_id,
                    'reviews_text' => $request->reviews_text,
                    'reviews_rating' => $request->reviews_rating,
                    'customers_id' => auth()->user()->id,
                    'customers_name' => auth()->user()->first_name.auth()->user()->last_name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                return $this->sendResponse(1,'done');

//
//            DB::table('reviews_description')
//                ->insert([
//                    'review_id' => $id,
//                    'language_id' => Session::get('language_id'),
//                    'reviews_text' => $request->reviews_text,
//                ]);
            } else {
//            return 'not_login';
                return $this->sendError('error not_login', '', 400);


            }
        } catch (Exception $ex) {
            return $this->sendError('error',$ex->getMessage()) ;

        }
    }

    //shop
    public function shop(Request $request)
    {

        $page_number = (!empty($request->page)) ? $request->page : 0;
        $limit = (!empty($request->limit)) ? $request->limit : 15;
        $type = (!empty($request->type)) ? $request->type : '';
        $max_price = (!empty($request->max_price)) ? $request->max_price : '';
        $min_price = (!empty($request->min_price)) ? $request->min_price : '';
        $search = (!empty($request->search)) ? $request->search : '';
        $lang = (!empty($request->lang)) ? $request->lang : 2;

        //category
        if (!empty($request->category) and $request->category != 'all') {
            $category = $this->products->getCategories($request);
            $categories_id = $category[0]->categories_id;
        } else {
            $categories_id = '';
        }
        $filters = array();
        if (!empty($request->filters_applied) and $request->filters_applied == 1) {
            $index = 0;
            $options = array();
            $option_values = array();
            $option = $this->products->getOptions($lang);
            foreach ($option as $key => $options_data) {
                $option_name = str_replace(' ', '_', $options_data->products_options_name);
                if (!empty($request->$option_name)) {
                    $index2 = 0;
                    $values = array();
                    foreach ($request->$option_name as $value) {
                        $value = $this->products->getOptionsValues($value, (!empty($request->lang)) ? $request->lang : 2);
                        $option_values[] = $value[0]->products_options_values_id;
                    }
                    $options[] = $options_data->products_options_id;
                }
            }
            $filters['options_count'] = count($options);
            $filters['options'] = implode(',', $options);
            $filters['option_value'] = implode(',', $option_values);
            $filters['filter_attribute']['options'] = $options;
            $filters['filter_attribute']['option_values'] = $option_values;
        }
        $data = array(
            'page_number' => $page_number,
            'type' => $type,
            'lang' => $lang,
            'categories_id' => $categories_id,
            'search' => $search,
            'filters' => $filters,
            'limit' => $limit,
            'min_price' => $min_price,
            'max_price' => $max_price);
        $products = $this->products->products($data);
        return $this->sendNotFormatResponse($products);

    }

    public function filterProducts(Request $request)
    {
        $this->index->commonContent();


        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        if (!empty($request->type)) {
            $type = $request->type;
        } else {
            $type = '';
        }


        //if(!empty($request->category_id)){
        if (!empty($request->category) and $request->category != 'all') {
            $category = DB::table('categories')
                ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')
                ->where('categories_slug', $request->category)
                ->where('language_id', (!empty($request->lang)) ? $request->lang : 2)->get();

            $categories_id = $category[0]->categories_id;
        } else {
            $categories_id = '';
        }

        //search value
        if (!empty($request->search)) {
            $search = $request->search;
        } else {
            $search = '';
        }

        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

        if (!empty($request->filters_applied) and $request->filters_applied == 1) {
            $filters['options_count'] = count($request->options_value);
            $filters['options'] = $request->options;
            $filters['option_value'] = $request->options_value;
        } else {
            $filters = array();
        }

        $data = array('page_number' => $request->page_number, 'type' => $type, 'limit' => $limit, 'categories_id' => $categories_id,
            'search' => $search, 'filters' => $filters, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price, 'lang' => (!empty($request->lang)) ? $request->lang : 2);
        $products = $this->products->products($data);
        $result['products'] = $products;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);
        $result['limit'] = $limit;
        return $this->sendNotFormatResponse($result);

//        return view("web.filterproducts")->with('result', $result);

    }

    public function ModalShow(Request $request)
    {
        $result = array();
        $result['commonContent'] = $this->index->commonContent();
        $final_theme = $this->theme->theme();
        //min_price
        if (!empty($request->min_price)) {
            $min_price = $request->min_price;
        } else {
            $min_price = '';
        }

        //max_price
        if (!empty($request->max_price)) {
            $max_price = $request->max_price;
        } else {
            $max_price = '';
        }

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
        }

        $products = $this->products->getProductsById($request->products_id);

        $products = $this->products->getProductsBySlug($products[0]->products_slug);
        //category
        $category = $this->products->getCategoryByParent($products[0]->products_id, (!empty($request->lang)) ? $request->lang : 2);

        if (!empty($category) and count($category) > 0) {
            $category_slug = $category[0]->categories_slug;
            $category_name = $category[0]->categories_name;
        } else {
            $category_slug = '';
            $category_name = '';
        }
        $sub_category = $this->products->getSubCategoryByParent($products[0]->products_id, (!empty($request->lang)) ? $request->lang : 2);

        if (!empty($sub_category) and count($sub_category) > 0) {
            $sub_category_name = $sub_category[0]->categories_name;
            $sub_category_slug = $sub_category[0]->categories_slug;
        } else {
            $sub_category_name = '';
            $sub_category_slug = '';
        }

        $result['category_name'] = $category_name;
        $result['category_slug'] = $category_slug;
        $result['sub_category_name'] = $sub_category_name;
        $result['sub_category_slug'] = $sub_category_slug;

        $isFlash = $this->products->getFlashSale($products[0]->products_id);

        if (!empty($isFlash) and count($isFlash) > 0) {
            $type = "flashsale";
        } else {
            $type = "";
        }

        $data = array('page_number' => '0', 'type' => $type, 'products_id' => $products[0]->products_id, 'limit' => $limit,
            'min_price' => $min_price, 'max_price' => $max_price, 'lang' => (!empty($request->lang)) ? $request->lang : 2);
        $detail = $this->products->products($data);
        $result['detail'] = $detail;
        $postCategoryId = '';
        if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
            $i = 0;
            foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
                if ($i == 0) {
                    $postCategoryId = $postCategory->categories_id;
                    $i++;
                }
            }
        }

        $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price, 'lang' => (!empty($request->lang)) ? $request->lang : 2);
        $simliar_products = $this->products->products($data);
        $result['simliar_products'] = $simliar_products;

        $cart = '';
        $result['cartArray'] = $this->products->cartIdArray($cart);

        //liked products
        $result['liked_products'] = $this->products->likedProducts();
        return view("web.common.modal1")->with('result', $result);
    }

    //access object for custom pagination
    public function accessObjectArray($var)
    {
        return $var;
    }

    //productDetail
    public function productDetail(Request $request)
    {
        $data = array('page_number' => '0', 'type' => '', 'products_id' => $request->products_id, 'limit' => '', 'min_price' => '',
            'max_price' => '', 'lang' => (!empty($request->lang)) ? $request->lang : 2);
        $detail = $this->products->singleproducts($data);
        return $this->sendNotFormatResponse($detail);
        $result['detail'] = $detail;
//        if (!empty($result['detail']['product_data'][0]->categories) and count($result['detail']['product_data'][0]->categories) > 0) {
//            $i = 0;
//            foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
//                if ($i == 0) {
//                    $postCategoryId = $postCategory->categories_id;
//                    $i++;
//                }
//            }
//        }

//        $data = array('page_number' => '0', 'type' => '', 'products_id' => $request->products_id, 'limit' => '',
//            'min_price' => '', 'max_price' => '', 'lang' => (!empty($request->lang)) ? $request->lang : 2);
//        $simliar_products = $this->products->products($data);
//        $result['simliar_products'] = $simliar_products;
//


//        return $this->sendNotFormatResponse($result);

        //dd($result);
    }

    //filters
    public function filters($data)
    {
        $response = $this->products->filters($data);
        return ($response);
    }

    //getquantity
    public function getquantity(Request $request)
    {
        $data = array();
        $data['products_id'] = $request->products_id;
        $data['attributes'] = $request->attributeid;

        $result = $this->products->productQuantity($data);
        print_r(json_encode($result));
    }

}
