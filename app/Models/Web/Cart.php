<?php

namespace App\Models\Web;

use App\Models\Core\Categories;
use App\Models\Web\Index;
use App\Models\Web\Products;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;
use Session;

class Cart extends Model
{
    //mycart
    public function myCart($baskit_id)
    {
        $cart = DB::table('customers_basket')
            ->join('products', 'products.products_id', '=', 'customers_basket.products_id')
            ->join('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'products.products_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            })
            ->select('customers_basket.*',
                'image_categories.path as image_path', 'products.products_model as model',
                'products.products_type as products_type', 'products.products_min_order as min_order', 'products.products_max_stock as max_order',
                'products.products_image as image', 'products_description.products_name as products_name', 'products.products_price as price',
                'products.products_slug')
            ->where([
                ['customers_basket.is_order', '=', '0'],
                ['products_description.language_id', '=', Session::get('language_id')],
            ]);

        if (empty(session('customers_id'))) {
            $cart->where('customers_basket.session_id', '=', Session::getId());
        } else {
            $cart->where('customers_basket.customers_id', '=', session('customers_id'));
        }

        if (!empty($baskit_id)) {
            $cart->where('customers_basket.customers_basket_id', '=', $baskit_id);
        }

        $baskit = $cart->get();
        $total_carts = count($baskit);
        $result = array();
        $index = 0;
        if ($total_carts > 0) {
            foreach ($baskit as $cart_data) {
                //products_image
                $default_images = DB::table('image_categories')
                    ->where('image_id', '=', $cart_data->image)
                    ->where('image_type', 'THUMBNAIL')
                    ->first();

                if ($default_images) {
                    $cart_data->image_path = $default_images->path;
                } else {
                    $default_images = DB::table('image_categories')
                        ->where('image_id', '=', $cart_data->image)
                        ->where('image_type', 'Medium')
                        ->first();

                    if ($default_images) {
                        $cart_data->image_path = $default_images->path;
                    } else {
                        $default_images = DB::table('image_categories')
                            ->where('image_id', '=', $cart_data->image)
                            ->where('image_type', 'ACTUAL')
                            ->first();
                        $cart_data->image_path = $default_images->path;
                    }

                }


                 //categories
                 $categories = DB::table('products_to_categories')
                    ->leftjoin('categories', 'categories.categories_id', 'products_to_categories.categories_id')
                    ->leftjoin('categories_description', 'categories_description.categories_id', 'products_to_categories.categories_id')
                    ->select('categories.categories_id', 'categories_description.categories_name', 'categories.categories_image', 'categories.categories_icon', 'categories.parent_id')
                    ->where('products_id', '=', $cart_data->products_id)
                    ->where('categories_description.language_id', '=', Session::get('language_id'))->get();
                if(!empty($categories) and count($categories)>0){
                    $cart_data->categories = $categories;
                }else{
                    $cart_data->categories = array();
                }
                array_push($result, $cart_data);

                //default product
                $stocks = 0;
                if ($cart_data->products_type == '0') {

                    $currentStocks = DB::table('inventory')->where('products_id', $cart_data->products_id)->get();
                    if (count($currentStocks) > 0) {
                        foreach ($currentStocks as $currentStock) {
                            $stocks += $currentStock->stock;
                        }
                    }

                    if (!empty($cart_data->max_order) and $cart_data->max_order != 0) {
                        if ($cart_data->max_order >= $stocks) {
                            $result[$index]->max_order = $stocks;
                        }
                    } else {
                        $result[$index]->max_order = $stocks;
                    }
                    $index++;

                } else {

                    $attributes = DB::table('customers_basket_attributes')
                        ->join('products_options', 'products_options.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                        ->join('products_options_descriptions', 'products_options_descriptions.products_options_id', '=', 'customers_basket_attributes.products_options_id')
                        ->join('products_options_values', 'products_options_values.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                        ->leftjoin('products_options_values_descriptions', 'products_options_values_descriptions.products_options_values_id', '=', 'customers_basket_attributes.products_options_values_id')
                        ->leftjoin('products_attributes', function ($join) {
                            $join->on('customers_basket_attributes.products_id', '=', 'products_attributes.products_id')->on('customers_basket_attributes.products_options_id', '=', 'products_attributes.options_id')->on('customers_basket_attributes.products_options_values_id', '=', 'products_attributes.options_values_id');
                        })
                        ->select('products_options_descriptions.options_name as attribute_name', 'products_options_values_descriptions.options_values_name as attribute_value', 'customers_basket_attributes.products_options_id as options_id', 'customers_basket_attributes.products_options_values_id as options_values_id', 'products_attributes.price_prefix as prefix', 'products_attributes.products_attributes_id as products_attributes_id', 'products_attributes.options_values_price as values_price')

                        ->where('customers_basket_attributes.products_id', '=', $cart_data->products_id)
                        ->where('customers_basket_id', '=', $cart_data->customers_basket_id)
                        ->where('products_options_descriptions.language_id', '=', Session::get('language_id'))
                        ->where('products_options_values_descriptions.language_id', '=', Session::get('language_id'));

                    if (empty(session('customers_id'))) {
                        $attributes->where('customers_basket_attributes.session_id', '=', Session::getId());
                    } else {
                        $attributes->where('customers_basket_attributes.customers_id', '=', session('customers_id'));
                    }

                    $attributes_data = $attributes->get();

                    //if($index==0){
                    $products_attributes_id = array();
                    //}

                    foreach ($attributes_data as $attributes_datas) {
                        if ($cart_data->products_type == '1') {
                            $products_attributes_id[] = $attributes_datas->products_attributes_id;

                        }

                    }
                    $myVar = new Products();

                    $qunatity['products_id'] = $cart_data->products_id;
                    $qunatity['attributes'] = $products_attributes_id;

                    $content = $myVar->productQuantity($qunatity);
                    $stocks = $content['remainingStock'];
                    if (!empty($cart_data->max_order) and $cart_data->max_order != 0) {
                        if ($cart_data->max_order >= $stocks) {
                            $result[$index]->max_order = $stocks;
                        }
                    } else {
                        $result[$index]->max_order = $stocks;
                    }

                    $result[$index]->attributes_id = $products_attributes_id;

                    $result2 = array();
                    if (!empty($cart_data->coupon_id)) {
                        //coupon
                        $coupons = explode(',', $cart_data->coupon_id);
                        $index2 = 0;
                        foreach ($coupons as $coupons_data) {
                            $coupons = DB::table('coupons')->where('coupans_id', '=', $coupons_data)->get();
                            $result2[$index2++] = $coupons[0];
                        }

                    }

                    $result[$index]->coupons = $result2;
                    $result[$index]->attributes = $attributes_data;
                    $index++;
                }
            }
        }
        return ($result);
    }
    //getCart
    public function cart($request)
    {

        $cart = DB::table('customers_basket')
            ->join('products', 'products.products_id', '=', 'customers_basket.products_id')
            ->join('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->leftJoin('price_by_currency', 'products.products_id', '=', 'price_by_currency.product_id')
            ->LeftJoin('image_categories', 'products.products_image', '=', 'image_categories.image_id')
            ->leftJoin('currencies', 'price_by_currency.currency_id', '=', 'currencies.id')
            ->select('currencies.symbol_left as currency_symbol_left', 'currencies.symbol_right as currency_symbol_right', 'price_by_currency.price as price', 'image_categories.path as image_path', 'customers_basket.*', 'products.products_model as model', 'products.products_image as image', 'products_description.products_name as products_name', 'products.products_quantity as quantity', 'products.products_price as price')->where('customers_basket.is_order', '=', '0')->where('products_description.language_id', '=', Session::get('language_id'));

        if (empty(session('customers_id'))) {
            $cart->where('customers_basket.session_id', '=', Session::getId());
        } else {
            $cart->where('customers_basket.customers_id', '=', session('customers_id'));
        }

        $baskit = $cart->groupBy('customers_basket.products_id')->get();



        return ($baskit);

    }

    public function editcart($request)
    {
        $index = new Index();
        $products = new Products();
        $result = array();
        $data = array();
        $baskit_id = $request->id;
        //category
        $category = DB::table('categories')->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')->leftJoin('products_to_categories', 'products_to_categories.categories_id', '=', 'categories.categories_id')->where('products_to_categories.products_id', $result['cart'][0]->products_id)->where('categories.parent_id', 0)->where('language_id', Session::get('language_id'))->get();

        if (!empty($category) and count($category) > 0) {
            $category_slug = $category[0]->categories_slug;
            $category_name = $category[0]->categories_name;
        } else {
            $category_slug = '';
            $category_name = '';
        }
        $sub_category = DB::table('categories')->leftJoin('categories_description', 'categories_description.categories_id', '=', 'categories.categories_id')->leftJoin('products_to_categories', 'products_to_categories.categories_id', '=', 'categories.categories_id')->where('products_to_categories.products_id', $result['cart'][0]->products_id)->where('categories.parent_id', '>', 0)->where('language_id', Session::get('language_id'))->get();

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

        $isFlash = DB::table('flash_sale')->where('products_id', $result['cart'][0]->products_id)
            ->where('flash_expires_date', '>=', time())->where('flash_status', '=', 1)
            ->get();

        if (!empty($isFlash) and count($isFlash) > 0) {
            $type = "flashsale";
        } else {
            $type = "";
        }

        $data = array('page_number' => '0', 'type' => $type, 'products_id' => $result['cart'][0]->products_id, 'limit' => '1', 'min_price' => '', 'max_price' => '');
        $detail = $products->products($data);
        $result['detail'] = $detail;

        $i = 0;
        foreach ($result['detail']['product_data'][0]->categories as $postCategory) {
            if ($i == 0) {
                $postCategoryId = $postCategory->categories_id;
                $i++;
            }
        }

        $data = array('page_number' => '0', 'type' => '', 'categories_id' => $postCategoryId, 'limit' => '15', 'min_price' => '', 'max_price' => '');
        $simliar_products = $products->products($data);
        $result['simliar_products'] = $simliar_products;

        $cart = '';
        $result['cartArray'] = $products->cartIdArray($cart);

        //liked products
        $result['liked_products'] = $products->likedProducts();
        return $result;
    }

    public function deleteCart($request)
    {
        session(['out_of_stock' => 0]);
        $baskit_id = $request->id;

        DB::table('customers_basket')->where([
            ['customers_basket_id', '=', $baskit_id],
        ])->delete();

        DB::table('customers_basket_attributes')->where([
            ['customers_basket_id', '=', $baskit_id],
        ])->delete();
        $check = DB::table('customers_basket')
            ->where('customers_basket.session_id', '=', Session::getId())
            ->first();
        return $check;

    }

    public function cartIdArray($request)
    {

        $cart = DB::table('customers_basket')->where('customers_basket.is_order', '=', '0');

        if (empty(session('customers_id'))) {
            $cart->where('customers_basket.session_id', '=', Session::getId());
        } else {
            $cart->where('customers_basket.customers_id', '=', session('customers_id'));
        }

        $baskit = $cart->get();

        $result = array();
        $index = 0;
        foreach ($baskit as $baskit_data) {
            $result[$index++] = $baskit_data->products_id;
        }

        return ($result);

    }

    public function updatesinglecart($request)
    {
        $index = new Index();
        $products = new Products();
        $products_id = $request->products_id;
        $basket_id = $request->cart_id;

        if (empty(session('customers_id'))) {
            $customers_id = '';
        } else {
            $customers_id = session('customers_id');
        }

        $session_id = Session::getId();
        $customers_basket_date_added = date('Y-m-d H:i:s');

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
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

        $data = array('page_number' => '0', 'type' => '', 'products_id' => $products_id, 'limit' => $limit, 'min_price' => $min_price, 'max_price' => $max_price);

        $detail = $products->products($data);
        //price is not default
        $final_price = $request->products_price;
        //quantity is not default
        $customers_basket_quantity = $request->quantity;

        $parms = array(
            'customers_id' => $customers_id,
            'products_id' => $products_id,
            'session_id' => $session_id,
            'customers_basket_quantity' => $customers_basket_quantity,
            'final_price' => $final_price,
            'customers_basket_date_added' => $customers_basket_date_added,
        );
        //update into cart
        DB::table('customers_basket')->where('customers_basket_id', '=', $basket_id)->update(
            [
                'customers_id' => $customers_id,
                'products_id' => $products_id,
                'session_id' => $session_id,
                'customers_basket_quantity' => $customers_basket_quantity,
                'final_price' => $final_price,
                'customers_basket_date_added' => $customers_basket_date_added,
            ]);

        if (count($request->option_id) > 0) {
            foreach ($request->option_id as $option_id) {

                DB::table('customers_basket_attributes')->where([
                    ['customers_basket_id', '=', $basket_id],
                    ['products_id', '=', $products_id],
                    ['products_options_id', '=', $option_id],
                ])->update(
                    [
                        'customers_id' => $customers_id,
                        'products_options_values_id' => $request->$option_id,
                        'session_id' => $session_id,
                    ]);
            }

        }
        //apply coupon
        if (count(session('coupon')) > 0) {
            $session_coupon_data = session('coupon');
            session(['coupon' => array()]);
            $response = array();
            if (!empty($session_coupon_data)) {
                foreach ($session_coupon_data as $key => $session_coupon) {
                    $response = $this->common_apply_coupon($session_coupon->code);
                }
            }
        }
        $result['commonContent'] = $index->commonContent();
        return $result;
    }

    public function addToCart($request)
    {
        $index = new Index();
        $products = new Products();

        $products_id = $request->products_id;

        if (empty(session('customers_id'))) {
            $customers_id = '';
        } else {
            $customers_id = session('customers_id');
        }

        $session_id = Session::getId();
        $customers_basket_date_added = date('Y-m-d H:i:s');

        if (!empty($request->limit)) {
            $limit = $request->limit;
        } else {
            $limit = 15;
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

        if (empty($customers_id)) {

            $exist = DB::table('customers_basket')->where([
                ['session_id', '=', $session_id],
                ['products_id', '=', $products_id],
                ['is_order', '=', 0],
            ])->get();

        } else {

            $exist = DB::table('customers_basket')->where([
                ['customers_id', '=', $customers_id],
                ['products_id', '=', $products_id],
                ['is_order', '=', 0],
            ])->get();

        }
        $isFlash = DB::table('flash_sale')->where('products_id', $products_id)
            ->where('flash_expires_date', '>=', time())->where('flash_status', '=', 1)
            ->get();
        //get products detail  is not default
        if (!empty($isFlash) and count($isFlash) > 0) {
            $type = "flashsale";
        } else {
            $type = "";
        }

        $data = array('page_number' => '0', 'type' => $type, 'products_id' => $request->products_id, 'limit' => '15', 'min_price' => '', 'max_price' => '');
        $detail = $products->products($data);
        $result['detail'] = $detail;

        if ($result['detail']['product_data'][0]->products_type == 0) {

            //check lower value to match with added stock
            if ($result['detail']['product_data'][0]->products_max_stock != null and $result['detail']['product_data'][0]->products_max_stock < $result['detail']['product_data'][0]->defaultStock) {
                $default_stock = $result['detail']['product_data'][0]->products_max_stock;
            } else {
                $default_stock = $result['detail']['product_data'][0]->defaultStock;
            }

            if (!empty($exist) and count($exist) > 0) {
                $count = $exist[0]->customers_basket_quantity + $request->quantity;
                $remain = $result['detail']['product_data'][0]->defaultStock - $exist[0]->customers_basket_quantity;

                if ($count > $default_stock) {

                    return array('status' => 'exceed', 'defaultStock' => $result['detail']['product_data'][0]->defaultStock, 'already_added' => $exist[0]->customers_basket_quantity, 'remain_pieces' => $remain);
                }

                // if ($count >= $result['detail']['product_data'][0]->defaultStock || $count > $result['detail']['product_data'][0]->products_max_stock and $result['detail']['product_data'][0]->products_max_stock != null) {

                //     return array('status' => 'exceed', 'defaultStock' => $result['detail']['product_data'][0]->defaultStock, 'already_added' => $exist[0]->customers_basket_quantity, 'remain_pieces' => $remain);
                // }
            } else {

                //if ($request->quantity > $result['detail']['product_data'][0]->defaultStock || $request->quantity > $result['detail']['product_data'][0]->products_max_stock and $result['detail']['product_data'][0]->products_max_stock != null) {
                if ($request->quantity > $default_stock) {
                    $count = $request->quantity;
                    $remain = $result['detail']['product_data'][0]->defaultStock - $count;
                    return array('status' => 'exceed');
                }
            }
        }

        if (!empty($result['detail']['product_data'][0]->flash_price)) {
            $final_price = $result['detail']['product_data'][0]->flash_price + 0;
        } elseif (!empty($result['detail']['product_data'][0]->discount_price)) {
            $final_price = $result['detail']['product_data'][0]->discount_price + 0;
        } else {
            $final_price = $result['detail']['product_data'][0]->products_price + 0;
        }

        //$variables_prices = 0
        if ($result['detail']['product_data'][0]->products_type == 1) {
            $attributeid = $request->attributeid;
            $attribute_price = 0;
            if (!empty($attributeid) and count($attributeid) > 0) {

                foreach ($attributeid as $attribute) {
                    $attribute = DB::table('products_attributes')->where('products_attributes_id', $attribute)->first();
                    $symbol = $attribute->price_prefix;
                    $values_price = $attribute->options_values_price;
                    if ($symbol == '+') {
                        $final_price = intval($final_price) + intval($values_price);
                    }
                    if ($symbol == '-') {
                        $final_price = intval($final_price) - intval($values_price);
                    }
                }
            }

        }

        //check quantity
        if ($result['detail']['product_data'][0]->products_type == 1) {
            $qunatity['products_id'] = $request->products_id;
            $qunatity['attributes'] = $attributeid;

            $content = $products->productQuantity($qunatity);
            //dd($content);
            $stocks = $content['remainingStock'];

        } else {
            $stocks = $result['detail']['product_data'][0]->defaultStock;

        }

        if ($stocks <= $result['detail']['product_data'][0]->products_max_stock) {
            $stocksToValid = $stocks;
        } else {
            $stocksToValid = $result['detail']['product_data'][0]->products_max_stock;
        }

        //check variable stock limit
        if (!empty($exist) and count($exist) > 0) {
            $count = $exist[0]->customers_basket_quantity + $request->quantity;
            if ($count > $stocksToValid) {
                return array('status' => 'exceed');
            }
        }

        if (empty($request->quantity)) {
            $customers_basket_quantity = 1;
        } else {
            $customers_basket_quantity = $request->quantity;
        }

        if ($stocksToValid > $customers_basket_quantity) {
            $customers_basket_quantity = $result['detail']['product_data'][0]->products_min_order;
        }

        //quantity is not default
        if (empty($request->quantity)) {
            $customers_basket_quantity = 1;
        } else {
            $customers_basket_quantity = $request->quantity;
        }

        if ($request->customers_basket_id) {
            $basket_id = $request->customers_basket_id;
            DB::table('customers_basket')->where('customers_basket_id', '=', $basket_id)->update(
                [
                    'customers_id' => $customers_id,
                    'products_id' => $products_id,
                    'session_id' => $session_id,
                    'customers_basket_quantity' => $customers_basket_quantity,
                    'final_price' => $final_price,
                    'customers_basket_date_added' => $customers_basket_date_added,
                ]);

            if (count($request->option_id) > 0) {
                foreach ($request->option_id as $option_id) {

                    DB::table('customers_basket_attributes')->where([
                        ['customers_basket_id', '=', $basket_id],
                        ['products_id', '=', $products_id],
                        ['products_options_id', '=', $option_id],
                    ])->update(
                        [
                            'customers_id' => $customers_id,
                            'products_options_values_id' => $request->$option_id,
                            'session_id' => $session_id,
                        ]);
                }

            }
        } else {
            //insert into cart
            if (count($exist) == 0) {

                $customers_basket_id = DB::table('customers_basket')->insertGetId(
                    [
                        'customers_id' => $customers_id,
                        'products_id' => $products_id,
                        'session_id' => $session_id,
                        'customers_basket_quantity' => $customers_basket_quantity,
                        'final_price' => $final_price,
                        'customers_basket_date_added' => $customers_basket_date_added,
                    ]);

                if (!empty($request->option_id) && count($request->option_id) > 0) {
                    foreach ($request->option_id as $option_id) {

                        DB::table('customers_basket_attributes')->insert(
                            [
                                'customers_id' => $customers_id,
                                'products_id' => $products_id,
                                'products_options_id' => $option_id,
                                'products_options_values_id' => $request->$option_id,
                                'session_id' => $session_id,
                                'customers_basket_id' => $customers_basket_id,
                            ]);

                    }

                } else if (!empty($detail['product_data'][0]->attributes)) {

                    foreach ($detail['product_data'][0]->attributes as $attribute) {

                        DB::table('customers_basket_attributes')->insert(
                            [
                                'customers_id' => $customers_id,
                                'products_id' => $products_id,
                                'products_options_id' => $attribute['option']['id'],
                                'products_options_values_id' => $attribute['values'][0]['id'],
                                'session_id' => $session_id,
                                'customers_basket_id' => $customers_basket_id,
                            ]);
                    }
                }
            } else {

                $existAttribute = '0';
                $totalAttribute = '0';
                $basket_id = '0';

                if (!empty($request->option_id)) {
                    if (count($request->option_id) > 0) {

                        foreach ($exist as $exists) {
                            $totalAttribute = '0';
                            foreach ($request->option_id as $option_id) {
                                $checkexistAttributes = DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $exists->customers_basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $option_id],
                                    ['customers_id', '=', $customers_id],
                                    ['products_options_values_id', '=', $request->$option_id],
                                    ['session_id', '=', $session_id],
                                ])->get();
                                $totalAttribute++;
                                if (count($checkexistAttributes) > 0) {
                                    $existAttribute++;
                                } else {
                                    $existAttribute = 0;
                                }

                            }

                            if ($totalAttribute == $existAttribute) {
                                $basket_id = $exists->customers_basket_id;
                            }
                        }

                    } else
                    if (!empty($detail['product_data'][0]->attributes)) {
                        foreach ($exist as $exists) {
                            $totalAttribute = '0';
                            foreach ($detail['product_data'][0]->attributes as $attribute) {
                                $checkexistAttributes = DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $exists->customers_basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $attribute['option']['id']],
                                    ['customers_id', '=', $customers_id],
                                    ['products_options_values_id', '=', $attribute['values'][0]['id']],
                                    ['products_options_id', '=', $option_id],
                                ])->get();
                                $totalAttribute++;
                                if (count($checkexistAttributes) > 0) {
                                    $existAttribute++;
                                } else {
                                    $existAttribute = 0;
                                }
                                if ($totalAttribute == $existAttribute) {
                                    $basket_id = $exists->customers_basket_id;
                                }
                            }
                        }

                    }

                    //attribute exist
                    if ($basket_id == 0) {

                        $customers_basket_id = DB::table('customers_basket')->insertGetId(
                            [
                                'customers_id' => $customers_id,
                                'products_id' => $products_id,
                                'session_id' => $session_id,
                                'customers_basket_quantity' => $customers_basket_quantity,
                                'final_price' => $final_price,
                                'customers_basket_date_added' => $customers_basket_date_added,
                            ]);

                        if (count($request->option_id) > 0) {
                            foreach ($request->option_id as $option_id) {

                                DB::table('customers_basket_attributes')->insert(
                                    [
                                        'customers_id' => $customers_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $option_id,
                                        'products_options_values_id' => $request->$option_id,
                                        'session_id' => $session_id,
                                        'customers_basket_id' => $customers_basket_id,
                                    ]);

                            }

                        } else if (!empty($detail['product_data'][0]->attributes)) {

                            foreach ($detail['product_data'][0]->attributes as $attribute) {

                                DB::table('customers_basket_attributes')->insert(
                                    [
                                        'customers_id' => $customers_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $attribute['option']['id'],
                                        'products_options_values_id' => $attribute['values'][0]['id'],
                                        'session_id' => $session_id,
                                        'customers_basket_id' => $customers_basket_id,
                                    ]);
                            }
                        }

                    } else {

                        //update into cart
                        DB::table('customers_basket')->where('customers_basket_id', '=', $basket_id)->update(
                            [
                                'customers_id' => $customers_id,
                                'products_id' => $products_id,
                                'session_id' => $session_id,
                                'customers_basket_quantity' => DB::raw('customers_basket_quantity+' . $customers_basket_quantity),
                                'final_price' => $final_price,
                                'customers_basket_date_added' => $customers_basket_date_added,
                            ]);

                        if (count($request->option_id) > 0) {
                            foreach ($request->option_id as $option_id) {

                                DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $option_id],
                                ])->update(
                                    [
                                        'customers_id' => $customers_id,
                                        'products_options_values_id' => $request->$option_id,
                                        'session_id' => $session_id,
                                    ]);
                            }

                        } else if (!empty($detail['product_data'][0]->attributes)) {

                            foreach ($detail['product_data'][0]->attributes as $attribute) {

                                DB::table('customers_basket_attributes')->where([
                                    ['customers_basket_id', '=', $basket_id],
                                    ['products_id', '=', $products_id],
                                    ['products_options_id', '=', $option_id],
                                ])->update(
                                    [
                                        'customers_id' => $customers_id,
                                        'products_id' => $products_id,
                                        'products_options_id' => $attribute['option']['id'],
                                        'products_options_values_id' => $attribute['values'][0]['id'],
                                        'session_id' => $session_id,
                                        'customers_basket_id' => $customers_basket_id,
                                    ]);
                            }
                        }

                    }

                } else {
                    //update into cart
                    DB::table('customers_basket')->where('customers_basket_id', '=', $exist[0]->customers_basket_id)->update(
                        [
                            'customers_id' => $customers_id,
                            'products_id' => $products_id,
                            'session_id' => $session_id,
                            'customers_basket_quantity' => DB::raw('customers_basket_quantity+' . $customers_basket_quantity),
                            'final_price' => $final_price,
                            'customers_basket_date_added' => $customers_basket_date_added,
                        ]);

                }
                //apply coupon
                if (count(session('coupon')) > 0) {
                    $session_coupon_data = session('coupon');
                    session(['coupon' => array()]);
                    $response = array();
                    if (!empty($session_coupon_data)) {
                        foreach ($session_coupon_data as $key => $session_coupon) {
                            $response = $this->common_apply_coupon($session_coupon->code);
                        }
                    }
                }

            }
        }
        $result['commonContent'] = $index->commonContent();
        return $result;
    }

    public function common_apply_coupon($coupon_code)
    {
        $result = array();

        //current date
        $currentDate = date('Y-m-d 00:00:00', time());

        $data = DB::table('coupons')->where([
            ['code', '=', $coupon_code],
            ['expiry_date', '>', $currentDate],
        ]);

        if (session('coupon') == '' or count(session('coupon')) == 0) {
            session(['coupon' => array()]);
            session(['coupon_discount' => 0]);
        }

        $session_coupon_ids = array();
        $session_coupon_data = array();
        if (!empty(session('coupon'))) {
            foreach (session('coupon') as $session_coupon) {
                array_push($session_coupon_data, $session_coupon);
                $session_coupon_ids[] = $session_coupon->coupans_id;

            }
        }


        $coupons = $data->get();

        if (count($coupons) > 0) {

            if (!empty(auth()->guard('customer')->user()->email) and in_array(auth()->guard('customer')->user()->email, explode(',', $coupons[0]->email_restrictions))) {
                $response = array('success' => '2', 'message' => Lang::get("website.You are not allowed to use this coupon"));
            } else {
                if ($coupons[0]->usage_limit > 0 and $coupons[0]->usage_limit == $coupons[0]->usage_count) {
                    $response = array('success' => '2', 'message' => Lang::get("website.This coupon has been reached to its maximum usage limit"));
                } else {

                    $carts = $this->myCart(array());

                    $total_cart_items = count($carts);
                    $price = 0;
                    $discount_price = 0;
                    $used_by_user = 0;
                    $individual_use = 0;
                    $price_of_sales_product = 0;
                    $exclude_sale_items = array();
                    $currentDate = time();
                    foreach ($carts as $cart) {

                        //check if amy coupons applied
                        if (!empty($session_coupon_ids)) {
                            $individual_use++;
                        }

                        //user limit
                        if (in_array($coupons[0]->coupans_id, $session_coupon_ids)) {
                            $used_by_user++;
                        }

                        //cart price
                        $price += $cart->final_price * $cart->customers_basket_quantity;

                        //if cart items are special product
                        if ($coupons[0]->exclude_sale_items == 1) {
                            $products_id = $cart->products_id;
                            $sales_item = DB::table('specials')->where([
                                ['status', '=', '1'],
                                ['expires_date', '>', $currentDate],
                                ['products_id', '=', $products_id]])->select('products_id', 'specials_new_products_price as specials_price')->get();

                            if (count($sales_item) > 0) {
                                $exclude_sale_items[] = $sales_item[0]->products_id;

                                //price check is remaining if already an other coupon is applied and stored in session
                                $price_of_sales_product += $sales_item[0]->specials_price;
                            }
                        }
                    }

                    $total_special_items = count($exclude_sale_items);

                    if ($coupons[0]->individual_use == '1' and $individual_use > 0) {
                        $response = array('success' => '2', 'message' => Lang::get("website.The coupon cannot be used in conjunction with other coupons"));

                    } else {

                        //check limit
                        if ($coupons[0]->usage_limit_per_user > 0 and $coupons[0]->usage_limit_per_user <= $used_by_user) {
                            $response = array('success' => '2', 'message' => Lang::get("website.coupon is used limit"));
                        } else {

                            $cart_price = $price + 0 - $discount_price;

                            if ($coupons[0]->minimum_amount > 0 and $coupons[0]->minimum_amount >= $cart_price) {
                                $response = array('success' => '2', 'message' => Lang::get("website.Coupon amount limit is low than minimum price"));
                            } elseif ($coupons[0]->maximum_amount > 0 and $coupons[0]->maximum_amount <= $cart_price) {
                                $response = array('success' => '2', 'message' => Lang::get("website.Coupon amount limit is exceeded than maximum price"));
                            } else {

                                //exclude sales item
                                //print 'price before applying sales cart price: '.$cart_price;
                                $cart_price = $cart_price - $price_of_sales_product;
                                //print 'current cart price: '.$cart_price;

                                if ($coupons[0]->exclude_sale_items == 1 and $total_special_items == $total_cart_items) {
                                    $response = array('success' => '2', 'message' => Lang::get("website.Coupon cannot be applied this product is in sale"));
                                } else {

                                    if ($coupons[0]->discount_type == 'fixed_cart') {

                                        if ($coupons[0]->amount < $cart_price) {

                                            $coupon_discount = $coupons[0]->amount;
                                            $coupon[] = $coupons[0];

                                        } else {
                                            $response = array('success' => '2', 'message' => Lang::get("website.Coupon amount is greater than total price"));
                                        }

                                    } elseif ($coupons[0]->discount_type == 'percent') {
                                        $current_discount = $coupons[0]->amount / 100 * $cart_price;
                                        $cart_price = $cart_price - $current_discount;
                                        if ($cart_price > 0) {

                                            $coupon_discount = $current_discount;
                                            $coupon[] = $coupons[0];
                                        } else {
                                            $response = array('success' => '2', 'message' => Lang::get("website.Coupon amount is greater than total price"));
                                        }

                                    } elseif ($coupons[0]->discount_type == 'fixed_product') {

                                        $product_discount_price = 0;
                                        //no of items have greater discount price than original price
                                        $items_greater_price = 0;

                                        foreach ($carts as $cart) {

                                            if (!empty($coupon[0]->product_categories)) {

                                                //get category ids
                                                $categories = BD::table('products_to_categories')->where('products_id', '=', $cart->products_id)->get();

                                                if (in_array($categories[0]->categories_id, $coupon[0]->product_categories)) {

                                                    //if coupon is apply for specific product
                                                    if (!empty($coupons[0]->product_ids) and in_array($cart->products_id, $coupons[0]->product_ids)) {

                                                        $product_price = $cart->final_price;
                                                        if ($product_price > $coupons[0]->amount) {

                                                            $product_discount_price += $coupons[0]->amount * $cart->customers_basket_quantity;
                                                        } else {
                                                            $items_greater_price++;
                                                        }

                                                        //if coupon cannot be apply for speciafic product
                                                    } elseif (!empty($coupons[0]->exclude_product_ids) and in_array($cart->products_id, $coupons[0]->exclude_product_ids)) {

                                                    } elseif (empty($coupons[0]->exclude_product_ids) and empty($coupons[0]->product_ids)) {

                                                        $product_price = $cart->final_price;
                                                        if ($product_price > $coupons[0]->amount) {
                                                            $product_discount_price += $coupons[0]->amount * $cart->customers_basket_quantity;
                                                        } else {
                                                            $items_greater_price++;
                                                        }
                                                    }

                                                }

                                            } else if (!empty($coupon[0]->excluded_product_categories)) {

                                                //get category ids
                                                $categories = BD::table('products_to_categories')->where('products_id', '=', $cart->products_id)->get();

                                                if (in_array($categories[0]->categories_id, $coupon[0]->excluded_product_categories)) {

                                                    //if coupon is apply for specific product
                                                    if (!empty($coupons[0]->product_ids) and in_array($cart->products_id, $coupons[0]->product_ids)) {

                                                        $product_price = $cart->final_price;
                                                        if ($product_price > $coupons[0]->amount) {
                                                            $product_discount_price += $coupons[0]->amount * $cart->customers_basket_quantity;
                                                        } else {
                                                            $items_greater_price++;
                                                        }

                                                        //if coupon cannot be apply for speciafic product
                                                    } elseif (!empty($coupons[0]->exclude_product_ids) and in_array($cart->products_id, $coupons[0]->exclude_product_ids)) {

                                                    } elseif (empty($coupons[0]->exclude_product_ids) and empty($coupons[0]->product_ids)) {

                                                        $product_price = $cart->final_price;
                                                        if ($product_price > $coupons[0]->amount) {
                                                            $product_discount_price += $coupons[0]->amount * $cart->customers_basket_quantity;
                                                        } else {
                                                            $items_greater_price++;
                                                        }
                                                    }
                                                }

                                            } else {
                                                //if coupon is apply for specific product
                                                if (!empty($coupons[0]->product_ids) and in_array($cart->products_id, $coupons[0]->product_ids)) {

                                                    $product_price = $cart->final_price;
                                                    if ($product_price > $coupons[0]->amount) {
                                                        $product_discount_price += $coupons[0]->amount * $cart->customers_basket_quantity;
                                                    } else {
                                                        $items_greater_price++;
                                                    }

                                                    //if coupon cannot be apply for speciafic product
                                                } elseif (!empty($coupons[0]->exclude_product_ids) and in_array($cart->products_id, $coupons[0]->exclude_product_ids)) {

                                                } elseif (empty($coupons[0]->exclude_product_ids) and empty($coupons[0]->product_ids)) {

                                                    $product_price = $cart->final_price;
                                                    if ($product_price > $coupons[0]->amount) {
                                                        $product_discount_price += $coupons[0]->amount * $cart->customers_basket_quantity;
                                                    } else {
                                                        $items_greater_price++;
                                                    }
                                                }
                                            }

                                        }

                                        //check if all cart products are equal to that product which have greater discount amount
                                        if ($total_cart_items == $items_greater_price) {
                                            $response = array('success' => '2', 'message' => Lang::get("website.Coupon amount is greater than product price"));
                                        } else {
                                            $coupon_discount = $product_discount_price;
                                            $coupon[] = $coupons[0];

                                        }

                                    } elseif ($coupons[0]->discount_type == 'percent_product') {

                                        $product_discount_price = 0;
                                        //no of items have greater discount price than original price
                                        $items_greater_price = 0;

                                        foreach ($carts as $cart) {

                                            if (!empty($coupon[0]->product_categories)) {

                                                //get category ids
                                                $categories = BD::table('products_to_categories')->where('products_id', '=', $cart->products_id)->get();

                                                if (in_array($categories[0]->categories_id, $coupon[0]->product_categories)) {

                                                    //if coupon is apply for specific product
                                                    if (!empty($coupons[0]->product_ids) and in_array($cart->products_id, $coupons[0]->product_ids)) {

                                                        $product_price = $cart->final_price - ($coupons[0]->amount / 100 * $cart->final_price);
                                                        if ($product_price > $coupons[0]->amount) {
                                                            $product_discount_price += $coupons[0]->amount / 100 * ($cart->final_price * $cart->customers_basket_quantity);
                                                        } else {
                                                            $items_greater_price++;
                                                        }

                                                        //if coupon cannot be apply for speciafic product
                                                    } elseif (!empty($coupons[0]->exclude_product_ids) and in_array($cart->products_id, $coupons[0]->exclude_product_ids)) {

                                                    } elseif (empty($coupons[0]->exclude_product_ids) and empty($coupons[0]->product_ids)) {

                                                        $product_price = $cart->final_price - ($coupons[0]->amount / 100 * $cart->final_price);
                                                        if ($product_price > $coupons[0]->amount) {
                                                            $product_discount_price += $coupons[0]->amount / 100 * ($cart->final_price * $cart->customers_basket_quantity);
                                                        } else {
                                                            $items_greater_price++;
                                                        }
                                                    }

                                                }

                                            } else if (!empty($coupon[0]->excluded_product_categories)) {

                                                //get category ids
                                                $categories = BD::table('products_to_categories')->where('products_id', '=', $cart->products_id)->get();

                                                if (in_array($categories[0]->categories_id, $coupon[0]->excluded_product_categories)) {

                                                    //if coupon is apply for specific product
                                                    if (!empty($coupons[0]->product_ids) and in_array($cart->products_id, $coupons[0]->product_ids)) {

                                                        $product_price = $cart->final_price - ($coupons[0]->amount / 100 * $cart->final_price);
                                                        if ($product_price > $coupons[0]->amount) {
                                                            $product_discount_price += $coupons[0]->amount / 100 * ($cart->final_price * $cart->customers_basket_quantity);
                                                        } else {
                                                            $items_greater_price++;
                                                        }

                                                        //if coupon cannot be apply for speciafic product
                                                    } elseif (!empty($coupons[0]->exclude_product_ids) and in_array($cart->products_id, $coupons[0]->exclude_product_ids)) {

                                                    } elseif (empty($coupons[0]->exclude_product_ids) and empty($coupons[0]->product_ids)) {

                                                        $product_price = $cart->final_price - ($coupons[0]->amount / 100 * $cart->final_price);
                                                        if ($product_price > $coupons[0]->amount) {
                                                            $product_discount_price += $coupons[0]->amount / 100 * ($cart->final_price * $cart->customers_basket_quantity);
                                                        } else {
                                                            $items_greater_price++;
                                                        }
                                                    }

                                                }

                                            } else {

                                                //if coupon is apply for specific product
                                                if (!empty($coupons[0]->product_ids) and in_array($cart->products_id, $coupons[0]->product_ids)) {

                                                    $product_price = $cart->final_price - ($coupons[0]->amount / 100 * $cart->final_price);
                                                    if ($product_price > $coupons[0]->amount) {
                                                        $product_discount_price += $coupons[0]->amount / 100 * ($cart->final_price * $cart->customers_basket_quantity);
                                                    } else {
                                                        $items_greater_price++;
                                                    }

                                                    //if coupon cannot be apply for speciafic product
                                                } elseif (!empty($coupons[0]->exclude_product_ids) and in_array($cart->products_id, $coupons[0]->exclude_product_ids)) {

                                                } elseif (empty($coupons[0]->exclude_product_ids) and empty($coupons[0]->product_ids)) {

                                                    $product_price = $cart->final_price - ($coupons[0]->amount / 100 * $cart->final_price);
                                                    if ($product_price > $coupons[0]->amount) {
                                                        $product_discount_price += $coupons[0]->amount / 100 * ($cart->final_price * $cart->customers_basket_quantity);
                                                    } else {
                                                        $items_greater_price++;
                                                    }
                                                }
                                            }

                                        }

                                        //check if all cart products are equal to that product which have greater discount amount
                                        if ($total_cart_items == $items_greater_price) {
                                            $response = array('success' => '2', 'message' => Lang::get("website.Coupon amount is greater than product price"));
                                        } else {
                                            $coupon_discount = $product_discount_price;
                                            $coupon[] = $coupons[0];
                                        }

                                    }
                                }

                            }

                        }

                    }

                }
            }

            if(empty($response)){
                if (!in_array($coupons[0]->coupans_id, $session_coupon_ids)) {

                    if (count($session_coupon_data) > 0) {
                        $index = count($session_coupon_data);
                    } else {
                        $index = 0;
                    }
                    $session_coupon_data[$index] = $coupons[0];
                    session(['coupon_discount' => session('coupon_discount') + $coupon_discount]);
                    $response = array('success' => '1', 'message' => Lang::get("website.Couponisappliedsuccessfully"));

                } else {
                    $response = array('success' => '0', 'message' => Lang::get("website.Coupon is already applied"));
                }

                session(['coupon' => $session_coupon_data]);
            }


        } else {

            $response = array('success' => '0', 'message' => Lang::get("website.Coupon does not exist"));
        }

        return $response;

    }

    public function updateRecord($customers_basket_id, $customers_id, $session_id, $quantity)
    {
        DB::table('customers_basket')->where('customers_basket_id', '=', $customers_basket_id)->update(
            [
                'customers_id' => $customers_id,
                'session_id' => $session_id,
                'customers_basket_quantity' => $quantity,
            ]);
    }

}
