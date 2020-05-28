<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    //
    public function fetchorder($request)
    {
        $reportBase = $request->reportBase;
        $language_id = '1';
        $orders = DB::table('orders')
            ->LeftJoin('currencies', 'currencies.code', '=', 'orders.currency')
            ->get();

        $index = 0;
        $total_price = array();
        foreach ($orders as $orders_data) {
            $orders_products = DB::table('orders_products')
                ->select('final_price', DB::raw('SUM(final_price) as total_price'))
                ->where('orders_id', '=', $orders_data->orders_id)
                ->groupBy('final_price')
                ->get();

            $orders[$index]->total_price = $orders_products[0]->total_price;

            $orders_status_history = DB::table('orders_status_history')
                ->LeftJoin('orders_status', 'orders_status.orders_status_id', '=', 'orders_status_history.orders_status_id')
                ->LeftJoin('orders_status_description', 'orders_status_description.orders_status_id', '=', 'orders_status.orders_status_id')
                ->select('orders_status_description.orders_status_name', 'orders_status_description.orders_status_id')
                ->where('orders_id', '=', $orders_data->orders_id)
                ->where('orders_status_description.language_id', '=', $language_id)
                ->where('role_id', '<=', 2)
                ->orderby('orders_status_history.date_added', 'DESC')->limit(1)->get();

            $orders[$index]->orders_status_id = $orders_status_history[0]->orders_status_id;
            $orders[$index]->orders_status = $orders_status_history[0]->orders_status_name;

            $index++;
        }

        $compeleted_orders = 0;
        $pending_orders = 0;
        foreach ($orders as $orders_data) {

            if ($orders_data->orders_status_id == '2') {
                $compeleted_orders++;
            }
            if ($orders_data->orders_status_id == '1') {
                $pending_orders++;
            }
        }

        $result['orders'] = $orders->chunk(10);
        $result['pending_orders'] = $pending_orders;
        $result['compeleted_orders'] = $compeleted_orders;
        $result['total_orders'] = count($orders);

        $result['inprocess'] = count($orders) - $pending_orders - $compeleted_orders;
        //add to cart orders
        $cart = DB::table('customers_basket')->get();

        $result['cart'] = count($cart);

        //Rencently added products
        $recentProducts = DB::table('products')
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->where('products_description.language_id', '=', $language_id)
            ->orderBy('products.products_id', 'DESC')
            ->paginate(8);

        $result['recentProducts'] = $recentProducts;

        //products
        $products = DB::table('products')
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->where('products_description.language_id', '=', $language_id)
            ->orderBy('products.products_id', 'DESC')
            ->get();

        //low products & out of stock
        $lowLimit = 0;
        $outOfStock = 0;
        foreach ($products as $products_data) {
            $currentStocks = DB::table('inventory')->where('products_id', $products_data->products_id)->get();
            if (count($currentStocks) > 0) {
                if ($products_data->products_type == 1) {

                    /*$products_attribute = DB::table('products_attributes')->where('products_id','=', $products_id)->groupBy('options_id')->get();

                    if(count($products_attribute)>0){
                    $index2 = 0;
                    foreach($products_attribute as $attribute_data){
                    $attribute_data
                    }
                    }else{
                    $result['attributes'] =     array();
                    }*/

                    /*$stockIn = 0;
                foreach($currentStocks as $inventory){

                $totalAttribute = DB::table('inventory_detail')->where('inventory_detail.inventory_ref_id','=',$inventory->inventory_ref_id)->get();
                $totalAttributes = count($totalAttribute);

                if($postAttributes>$totalAttributes){
                $count = $postAttributes;
                }elseif($postAttributes<$totalAttributes or $postAttributes==$totalAttributes){
                $count = $totalAttributes;
                }

                $individualStock = DB::table('inventory')->leftjoin('inventory_detail','inventory_detail.inventory_ref_id','=','inventory.inventory_ref_id')
                ->selectRaw('inventory.*')
                ->whereIn('inventory_detail.attribute_id', [$attributeid])
                ->where(DB::raw('(select count(*) from `inventory_detail` where `inventory_detail`.`attribute_id` in ('.$attributeid.') and `inventory_ref_id`= "'.$inventory->inventory_ref_id.'")'),'=',$count)
                ->where('inventory.inventory_ref_id','=',$inventory->inventory_ref_id)
                ->groupBy('inventory_detail.inventory_ref_id')
                ->get();

                if(count($individualStock)>0){
                $inventory_ref_id[] = $individualStock[0]->inventory_ref_id;
                $stockIn += $individualStock[0]->stock;
                }

                }*/

                } else {
                    $stockIn = 0;

                    foreach ($currentStocks as $currentStock) {
                        $stockIn += $currentStock->stock;
                    }
                    /*print $stocks;
                    print '<br>';*/
                    $orders_products = DB::table('orders_products')
                        ->select(DB::raw('count(orders_products.products_quantity) as stockout'))
                        ->where('products_id', $products_data->products_id)->get();
                    //print($product->products_id);
                    //print '<br>';
                    $stocks = $stockIn - $orders_products[0]->stockout;

                    $manageLevel = DB::table('manage_min_max')->where('products_id', $products_data->products_id)->get();
                    $min_level = 0;
                    $max_level = 0;
                    if (count($manageLevel) > 0) {
                        $min_level = $manageLevel[0]->min_level;
                        $max_level = $manageLevel[0]->max_level;
                    }

                    /*print 'min level'.$min_level;
                    print '<br>';
                    print 'max level'.$max_level;
                    print '<br>';*/

                    if ($stocks >= $min_level) {
                        $lowLimit++;
                    }
                    $stocks = $stockIn - $orders_products[0]->stockout;
                    if ($stocks == 0) {
                        $outOfStock++;
                    }

                }
            } else {
                $outOfStock++;
            }
        }

        $result['lowLimit'] = $lowLimit;
        $result['outOfStock'] = $outOfStock;
        $result['totalProducts'] = count($products);

        $customers = DB::table('customers')
            ->LeftJoin('customers_info', 'customers_info.customers_info_id', '=', 'customers.customers_id')
            ->leftJoin('images', 'images.id', '=', 'customers.customers_picture')
            ->leftJoin('image_categories', 'image_categories.image_id', '=', 'customers.customers_picture')
            ->where('image_categories.image_type', '=', 'THUMBNAIL')
            ->select('customers.created_at', 'customers_id', 'customers_firstname', 'customers_lastname', 'customers_dob', 'email', 'user_name', 'customers_default_address_id', 'customers_telephone', 'customers_fax'
                , 'password', 'customers_picture', 'path')
            ->orderBy('customers.created_at', 'DESC')

//            ->orderBy('customers_info.customers_info_date_account_created','DESC')
            ->get();

        $result['recentCustomers'] = $customers->take(6);
        $result['totalCustomers'] = count($customers);
        $result['reportBase'] = $reportBase;
//
        //        //get function from other controller
        //        $myVar = new AdminSiteSettingController();
        //        $currency = $myVar->getSetting();
        //        $result['currency'] = $currency;

        return $result;

    }
}
