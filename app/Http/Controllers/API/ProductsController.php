<?php

namespace App\Http\Controllers\API;

//validator is builtin class in laravel
use App\Models\API\Currency;
use App\Models\API\Index;

//for password encryption or hash protected
use App\Models\API\Languages;

//for authenitcate login data
use App\Models\API\Products;
use App\Models\Core\Categories;
use App\Models\Core\ProductQuestion;
use App\QuestionReplay;
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
                    'reviews_rating.numeric' => 'التفييم يجب ان يكون رقم   ',
                    'reviews_rating.min' => 'يرجى اختيار رقم من 1 - 5   ',
                    'reviews_rating.max' => 'يرجى اختيار رقم من 1 - 5   ',

                ]);
            if ($validator->fails()) {
                return $this->sendError('error validation', $validator->errors(), 422);
            }
            if (auth()->user() != null) {
                $check = DB::table('reviews')
                    ->where('customers_id', auth()->user()->id)
                    ->where('products_id', $request->products_id)
                    ->first();

                if ($check) {
                    return $this->sendResponse(0, 'already_commented');
                }
                $id = DB::table('reviews')->insertGetId([
                    'products_id' => $request->products_id,
                    'reviews_text' => $request->reviews_text,
                    'reviews_rating' => $request->reviews_rating,
                    'customers_id' => auth()->user()->id,
                    'customers_name' => auth()->user()->first_name . auth()->user()->last_name,
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                return $this->sendResponse(1, 'done');
            } else {
                return $this->sendError('error not_login', '', 400);


            }
        } catch (Exception $ex) {
            return $this->sendError('error', $ex->getMessage());

        }
    }

    public function addQuestion(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'question_products_id' => 'required',
                'text' => 'required',
            ],
                [
                    'question_products_id.required' => 'رقم المنتج مطلوب',
                    'text.required' => ' نص السؤال مطلوب',
                ]);
            if ($validator->fails()) {
                return $this->sendError('error validation', $validator->errors(), 422);
            }
            if (auth()->user() != null) {
                ProductQuestion::create(array_merge($request->all(), [
                    'question_customers_id' => auth()->user()->id,
                ]));
                return $this->sendResponse(1, 'done');
            } else {
                return $this->sendError('error not_login', '', 400);

            }
        } catch (Exception $ex) {
            return $this->sendError('error', $ex->getMessage());

        }
    }

    public function updateQuestion(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_question_id' => 'required',
                'text' => 'required',
            ],
                [
                    'product_question_id.required' => 'رقم السؤال مطلوب',
                    'text.required' => ' نص السؤال مطلوب',
                ]);
            if ($validator->fails()) {
                return $this->sendError('error validation', $validator->errors(), 422);
            }
            if (auth()->user() != null) {
                $q = ProductQuestion::find($request->product_question_id);
                if ($q != null and $q->question_customers_id == auth()->user()->id)
                    $q->update($request->all());
                return $this->sendResponse($q->text, 'done');
            } else {
                return $this->sendError('error not_login', '', 400);

            }
        } catch (Exception $ex) {
            return $this->sendError('error', $ex->getMessage());

        }
    }

    public function deleteQuestion(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_question_id' => 'required',
            ],
                [
                    'product_question_id.required' => 'رقم السؤال مطلوب',
                ]);
            if ($validator->fails()) {
                return $this->sendError('error validation', $validator->errors(), 422);
            }
            if (auth()->user() != null) {
                $q = ProductQuestion::find($request->product_question_id);
                if ($q != null and $q->question_customers_id == auth()->user()->id) {
                    $reples = QuestionReplay::all()->where('product_question_id', $request->product_question_id)
                        ->where('replay_user_type', 'admin')->count();
                    if ($reples == 0) {
                        $q->delete();
                        return $this->sendResponse(1, 'تم الحذف بنجاح');
                    }
                }
                return $this->sendResponse(0, 'لايمكن حذف هذا السؤال');

            } else {
                return $this->sendError('error not_login', '', 400);

            }
        } catch (Exception $ex) {
            return $this->sendError('error', $ex->getMessage());

        }
    }

    public function addReplay(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'product_question_id' => 'required',
                'text' => 'required',
            ],
                [
                    'product_question_id.required' => 'رقم السؤال مطلوب',
                    'text.required' => ' نص السؤال مطلوب',
                ]);
            if ($validator->fails()) {
                return $this->sendError('error validation', $validator->errors(), 422);
            }
            if (auth()->user() != null) {
                QuestionReplay::create(array_merge($request->all(), [
                    'replay_user_id' => auth()->user()->id,
                ]));
                return $this->sendResponse(1, 'done');
            } else {
                return $this->sendError('error not_login', '', 400);

            }
        } catch (Exception $ex) {
            return $this->sendError('error', $ex->getMessage());

        }
    }


    public function updateReplay(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'replay_id' => 'required',
                'text' => 'required',
            ], [
                'replay_id.required' => 'رقم الرد مطلوب',
                'text.required' => ' نص الرد مطلوب',
            ]);
            if ($validator->fails()) {
                return $this->sendError('error validation', $validator->errors(), 422);
            }
            if (auth()->user() != null) {
                $q = QuestionReplay::find($request->replay_id);
                if ($q != null and $q->replay_user_id == auth()->user()->id)
                    $q->update($request->all());
                return $this->sendResponse($q->text, 'done');
            } else {
                return $this->sendError('error not_login', '', 400);

            }
        } catch (Exception $ex) {
            return $this->sendError('error', $ex->getMessage());

        }
    }


    public function deleteReplay(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'replay_id' => 'required',
            ], [
                'replay_id.required' => 'رقم الرد مطلوب',
            ]);
            if ($validator->fails()) {
                return $this->sendError('error validation', $validator->errors(), 422);
            }
            if (auth()->user() != null) {
                $q = QuestionReplay::find($request->replay_id);
                if ($q != null and $q->replay_user_id == auth()->user()->id) {
                    $q->delete();
                } else
                    return $this->sendResponse(0, 'لايممكن حذف هذا الرد');
                return $this->sendResponse(1, 'done');
            } else {
                return $this->sendError('error not_login', '', 400);
            }
        } catch (Exception $ex) {
            return $this->sendError('error', $ex->getMessage());
        }
    }


    public function shop(Request $request)
    {
        if ($request->is('api/wishlist') == true or $request->type == 'wishlist') {
            if (auth()->user() != null)
                $type = 'wishlist';
            else
                return $this->sendError('0', 'قم بتسجيل الدخول اولا');

        } elseif ($request->is('api/flash_sale') == true or $request->type == 'flash_sale') {
            $type = 'flashsale';
        } elseif ($request->is('api/top_seller') == true or $request->type == 'top_seller') {
            $type = 'topseller';
        } elseif ($request->is('api/most_liked') == true or $request->type == 'most_liked') {
            $type = 'mostliked';
        } elseif ($request->is('api/featured') == true or $request->type == 'featured') {
            $type = 'is_feature';
        } elseif ($request->is('api/specialProducts') == true or $request->type == 'special') {
            $type = 'special';
        } elseif ($request->is('api/weeklySoldProducts') == true or $request->type == 'feweeklySoldProductsatured') {
            $type = 'special';
        } else {

            $type = (!empty($request->type)) ? $request->type : '';
        }

        $page_number = (!empty($request->page)) ? $request->page : 0;
        $limit = (!empty($request->limit)) ? $request->limit : 15;
        $max_price = (!empty($request->max_price)) ? $request->max_price : '';
        $min_price = (!empty($request->min_price)) ? $request->min_price : '';
        $search = (!empty($request->search)) ? $request->search : '';
        $lang = (!empty($request->lang)) ? $request->lang : 2;

        //category
        if ($request->is('api/categoryProducts') == true and empty($request->category)) {
            return $this->sendError('0', 'قم بتحدبد category اولا');

        }
        if (!empty($request->category) and $request->category != 'all') {
            $category = $this->products->getCategories($request);
            if ($category->count() > 0)
                $categories_id = $category[0]->categories_id;
            else
                return $this->sendError('0', 'هذا الصنف غير موجود   ');
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
//        $products = $this->products->allProductsWithDatails($data);
        return $this->sendNotFormatResponse($products);

    }


    //productDetail
    public function productDetail(Request $request)
    {
        $data = array('page_number' => '0', 'type' => '', 'products_id' => $request->products_id, 'limit' => '', 'min_price' => '',
            'max_price' => '', 'lang' => (!empty($request->lang)) ? $request->lang : 2);
        $detail = $this->products->singleproducts2($data);
        return $this->sendResponse($detail['product_data'], '');

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
        return $this->sendNotFormatResponse($result);
        print_r(json_encode($result));
    }

}
