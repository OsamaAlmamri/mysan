<?php

namespace App\Http\Controllers\AdminControllers;

use App;
use App\DataTables\CouponsDataTable;
use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Http\Controllers\Controller;
use App\Models\Core\Setting;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Lang;

//for requesting a value

class ReportsController extends Controller
{
    //statsCustomers
    public function statsCustomers(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.CustomerOrdersTotal"));
        $cusomters = DB::table('users')
            ->join('orders', 'orders.customers_id', 'users.id')
            ->select('users.*', 'order_price',
                DB::raw('SUM(order_price) as price'),
                DB::raw('count(orders_id) as total_orders'))
//            ->where('role_id', 2)
            ->groupby('users.id')
            ->orderby('total_orders', 'desc')
            ->get();

//        return dd($cusomters);
        $result['cusomters'] = $cusomters;

        $myVar = new SiteSettingController();
        $result['setting'] = $myVar->getSetting();
        $result['commonContent'] = $myVar->Setting->commonContent();

        return view("admin.reports.statsCustomers", $title)->with('result', $result);

    }

    //statsProductsPurchased

    public function showProductsReoprts($reportType = 'inventory')
    {
        $title = array('pageTitle' => Lang::get("labels.StatsProductsPurchased"));
        $myVar = new SiteSettingController();
        $result['currency'] = $myVar->getSetting();
        $result['commonContent'] = $myVar->Setting->commonContent();

        if ($reportType == "customers_basket")
            $view = "customers_basket";
        else if ($reportType == "statsCustomers")
            $view = "statsCustomers2";
        else {
            $view = "showProductsReoprts";
        }
        return view("admin.reports.$view", $title)
            ->with('reportType', $reportType)
            ->with('result', $result);
    }

    public function customers_basketDetail($customers_id)
    {

        $basket = new App\DataTables\BasketDetailDataTable($customers_id);
        $myVar = new SiteSettingController();

//        $customers = $this->Customers->paginator();
        $title = array('pageTitle' => \Illuminate\Support\Facades\Lang::get("labels.Manufacturers"));
        $result['currency'] = $myVar->getSetting();
        $result['commonContent'] = $myVar->Setting->commonContent();
        return $basket->render('admin.reports.basketDetail', ['title' => $title, 'result' => $result,
            'dataTableType' => 'php']);
    }

    public function getData($main, $sub, $from_date = '1970-01-01', $to_date = '9999-09-09', $reportType = 'inventory')
    {
        if ($main == 'all' and $sub == 'all')
            $ids = 'all';
        elseif ($main > 0 and $sub == 'all')
            $ids = getProductsIdsAccordingForMainCategory($main);
        elseif (
            ($main == 'all' and $sub > 0) or
            ($main > 0 and $sub > 0))
            $ids = getProductsIdsAccordingForSubCategory($sub);
        /**/


        if ($reportType == 'inventory') {
            $select = 'inventory.*';
            $whereDate = 'inventory.created_at';
        } elseif ($reportType == 'like') {
            $select = 'products_liked';
            $whereDate = 'products.created_at';
        } else {
            $select = 'products.*';
            $whereDate = 'products.created_at';
        }
        $buttoms = [];
        $col_mostPrice=   DB::raw("(SELECT COALESCE(sum(products_quantity),0) FROM orders_products left join orders on orders.orders_id=orders_products.orders_id WHERE orders_products.products_id=products.products_id and orders_products_type like '%product%'   and orders.created_at between  '$from_date'  and '$to_date' )");
        if ($reportType == 'public_reports' or $reportType=='mostPurshese') {
            $buttoms = [
                DB::raw("(SELECT COALESCE(AVG(reviews_rating),0) FROM reviews WHERE reviews.products_id=products.products_id and reviews.created_at between  '$from_date'  and '$to_date'  ) as avg_rating"),
                DB::raw("(SELECT count(reviews_rating) FROM reviews WHERE reviews.products_id=products.products_id and reviews.created_at between  '$from_date'  and '$to_date'   ) as count_rating"),
                DB::raw("(SELECT COALESCE(sum(final_price * products_quantity),0) FROM orders_products left join orders on orders.orders_id=orders_products.orders_id WHERE orders_products.products_id=products.products_id and orders_products_type like '%product%'  and orders.created_at between  '$from_date'  and '$to_date'   ) as final_product_orders"),
                 DB::raw("(SELECT COALESCE(sum(products_quantity),0) FROM orders_products left join orders on orders.orders_id=orders_products.orders_id WHERE orders_products.products_id=products.products_id and orders_products_type like '%product%'   and orders.created_at between  '$from_date'  and '$to_date'   ) as sum_products_quantity"),
                DB::raw("(SELECT count(products_quantity) FROM orders_products left join orders on orders.orders_id=orders_products.orders_id WHERE orders_products.products_id=products.products_id and orders_products_type like '%product%'   and orders.created_at between  '$from_date'  and '$to_date'   ) as count_products_quantity"),
                DB::raw("(SELECT COALESCE(sum(stock),0) FROM inventory WHERE inventory.products_id=products.products_id  and  inventory.stock_type like 'in' and inventory.created_at between  '$from_date'  and '$to_date'  ) as inventory_in_products_quantity"),
                DB::raw("(SELECT COALESCE(sum(purchase_price),0) FROM inventory WHERE inventory.products_id=products.products_id  and inventory.stock_type like 'in' and inventory.created_at between  '$from_date' and '$to_date'   ) as inventory_in_purchase_price"),
                DB::raw("(SELECT COALESCE(sum(stock),0) FROM inventory WHERE inventory.products_id=products.products_id  and inventory.stock_type like 'out' and inventory.created_at between  '$from_date'  and '$to_date'  ) as inventory_out_products_quantity"),
                DB::raw("(SELECT COALESCE(sum(purchase_price),0) FROM inventory WHERE inventory.products_id=products.products_id  and inventory.stock_type like 'out' and inventory.created_at between  '$from_date'  and '$to_date'  ) as inventory_out_purchase_price"),
                DB::raw("(SELECT count(*) FROM product_questions WHERE product_questions.question_products_id=products.products_id  and product_questions.products_type like 'product' and product_questions.created_at between  '$from_date'  and '$to_date'  ) as product_questions"),
                DB::raw("(SELECT count(replay_id) FROM product_questions join question_replays on product_questions.question_products_id=question_replays.product_question_id WHERE product_questions.question_products_id=products.products_id  and product_questions.products_type like 'product'  and question_replays.created_at between  '$from_date'  and '$to_date'  ) as question_replays"),
            ];

        }

        $data = DB::table('products')
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id');
        if ($reportType == 'inventory')
            $data = $data->join('inventory', 'inventory.products_id', '=', 'products.products_id');
        $data = $data->LeftJoin('image_categories', function ($join) {
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
            ->select((array_merge($buttoms, [$select, 'products_description.*',
                'image_categories.path as path', 'products.updated_at as productupdate', 'categories_description.categories_id',
                'categories_description.categories_name'])))
            ->where('products_description.language_id', '=', 2)
            ->where('categories_description.language_id', '=', 2);
        if (!($main == 'all' and $sub == 'all'))
            $data = $data->whereIn('products.products_id', $ids);
        if ($reportType == 'inventory')
            $data = $data->where('stock_type', 'in')
                ->orderBy('products_ordered', 'DESC');
        elseif ($reportType == 'like')
            $data = $data->where('products.products_liked', '>', '0');
        elseif ($reportType == 'mostPurshese')
            $data = $data ->orderBy($col_mostPrice, 'DESC');

        return $data->whereBetween($whereDate, [$from_date, $to_date])
            ->get();
    }

    public function getCustomers_basketFilter($from_date = '1970-01-01', $to_date = '9999-09-09')
    {
        $data = DB::table('customers_basket')
            ->leftJoin('users', 'customers_basket.customers_id', '=', 'users.id')
            ->select('customers_basket.*',
                DB::raw("(SELECT COALESCE(sum(final_price),0) FROM customers_basket as Reports WHERE Reports.customers_id=customers_basket.customers_id  ) as all_price"),
                DB::raw("(SELECT COALESCE(sum(customers_basket_quantity),0) FROM customers_basket as Reports WHERE Reports.customers_id=customers_basket.customers_id  ) as all_quantity"),
                DB::raw("(SELECT COALESCE((Reports.customers_basket_date_added),0) FROM customers_basket as Reports WHERE Reports.customers_id=customers_basket.customers_id ORDER BY  Reports.customers_basket_date_added DESC LIMIT 1  ) as last_date_added"),
                DB::raw("(SELECT COALESCE((Reports.customers_basket_date_added),0) FROM customers_basket as Reports WHERE Reports.customers_id=customers_basket.customers_id ORDER BY  Reports.customers_basket_date_added  LIMIT 1  ) as first_date_added"),
                DB::raw("(SELECT COALESCE((last_basket_notification_date),0) FROM devices  WHERE devices.user_id=customers_basket.customers_id ORDER BY last_basket_notification_date DESC LIMIT 1  ) as last_basket_notification_date"),
                DB::raw("(SELECT (id) FROM devices  WHERE devices.user_id=customers_basket.customers_id ORDER BY id DESC LIMIT 1  ) as device_id"),
                DB::raw("(SELECT COALESCE(count(customers_basket_quantity),0) FROM customers_basket as Reports WHERE Reports.customers_id=customers_basket.customers_id  ) as all_productsType"),
                DB::raw("(CONCAT( COALESCE(users.first_name,' ') , ' ' ,COALESCE(users.last_name,' ') )) as customer")
            )
            ->whereBetween('customers_basket_date_added', [$from_date, $to_date])
            ->where('is_order', 0)
            ->groupBy(['customers_id'])
            ->orderByDesc('customers_basket_date_added')
            ->get();
        return $data;
    }

    public function get_statsCustomers2($from_date = '1970-01-01', $to_date = '9999-09-09')
    {
        $data = DB::table('users')
            ->join('orders', 'orders.customers_id', 'users.id')
            ->select('users.*', 'order_price',
                DB::raw("(select SUM(order_price) from orders where  orders.customers_id=users.id and  orders.created_at between  '$from_date'  and '$to_date' )as price"),
                DB::raw("(CONCAT( COALESCE(users.first_name,' ') , ' ' ,COALESCE(users.last_name,' ') )) as customer"),
                DB::raw("(select count(orders_id)  from orders where  orders.customers_id=users.id and orders.created_at between  '$from_date'  and '$to_date' ) as total_orders"))
            ->orderby('total_orders', 'desc')
            ->whereBetween('orders.created_at', [$from_date, $to_date])
            ->get();

        return $data;
    }

    public function filter2(Request $request)
    {
        $from = ($request->from_date == null) ? date('1974-01-01') : date($request->from_date);
        $to = ($request->to_date == null) ? date('9999-01-01') : date($request->to_date);
        $data = $this->getData($request->main, $request->sub, $from, $to, $request->reportType);
        if ($request->reportType == 'public_reports')
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('btn_image', 'admin.products.btn.image')
                ->addColumn('rating', 'admin.products.btn.rating')
                ->rawColumns(['btn_image', 'rating'])
                ->make(true);
        else
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('btn_image', 'admin.products.btn.image')
                ->rawColumns(['btn_image'])
                ->make(true);

    }

    public function customers_basketFilter(Request $request)
    {
        $from = ($request->from_date == null) ? date('1974-01-01') : date($request->from_date);
        $to = ($request->to_date == null) ? date('9999-01-01') : date($request->to_date);
        $data = $this->getCustomers_basketFilter($from, $to);
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('manage', 'admin.reports.btns.manageCustomers_basket')
            ->rawColumns(['manage'])
            ->make(true);
    }

    public function statsCustomers2(Request $request)
    {
        $from = ($request->from_date == null) ? date('1974-01-01') : date($request->from_date);
        $to = ($request->to_date == null) ? date('9999-01-01') : date($request->to_date);
        $data = $this->get_statsCustomers2($from, $to);
        return datatables()->of($data)
            ->addIndexColumn()
            ->make(true);
    }


    //statsProductsLiked
    public function statsProductsLiked(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.StatsProductsLiked"));
        $products = DB::table('products')
            ->join('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->where('products.products_liked', '>', '0')
            ->where('products_description.language_id', '=', '1')
            ->orderBy('products_liked', 'DESC')
            ->paginate(20);
        $result['data'] = $products;
        //get function from other controller
        $myVar = new SiteSettingController();
        $result['currency'] = $myVar->getSetting();
        $result['commonContent'] = $myVar->Setting->commonContent();
        return view("admin.reports.statsProductsLiked", $title)->with('result', $result);

    }

    //productsStock
    public function outofstock(Request $request)
    {

        $title = array('pageTitle' => Lang::get("labels.outOfStock"));
        $language_id = 2;
        $products = DB::table('products')
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->where('products_description.language_id', '=', $language_id)
            ->orderBy('products.products_id', 'DESC')
            ->get();

        $result = array();
        $products_array = array();
        $index = 0;
        $lowLimit = 0;
        $outOfStock = 0;
        $products_ids = array();
        $data = array();
        foreach ($products as $products_data) {
            $currentStocks = DB::table('inventory')->where('products_id', $products_data->products_id)->get();
            if (count($currentStocks) > 0) {
                if ($products_data->products_type != 1) {
                    $c_stock_in = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'in')->sum('stock');
                    $c_stock_out = DB::table('inventory')->where('products_id', $products_data->products_id)->where('stock_type', 'out')->sum('stock');
                    if (($c_stock_in - $c_stock_out) == 0) {
                        if (!in_array($products_data->products_id, $products_ids)) {
                            $products_ids[] = $products_data->products_id;
                            array_push($data, $products_data);
                            $outOfStock++;
                        }
                    }
                }
            } else {
                if (!in_array($products_data->products_id, $products_ids)) {
                    $products_ids[] = $products_data->products_id;
                    array_push($data, $products_data);
                    $outOfStock++;
                }

            }
        }

        $result['products'] = $data;
        $myVar = new SiteSettingController();
        $result['currency'] = $myVar->getSetting();
        $result['commonContent'] = $myVar->Setting->commonContent();

        return view("admin.reports.outofstock", $title)->with('result', $result);

    }

    //lowinstock
    public function lowinstock(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.Low Stock Products"));

        $language_id = 2;

        $products = DB::table('products')
            ->leftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            //->leftJoin('inventory','inventory.products_id','=','products.products_id')
            ->where('products_description.language_id', '=', $language_id)
            ->orderBy('products.products_id', 'DESC')
            ->get();

        $result2 = array();
        $products_array = array();
        $index = 0;
        $lowLimit = 0;
        $outOfStock = 0;
        foreach ($products as $product) {

            if ($product->products_type == 1) {

            } elseif ($product->products_type == 0 or $product->products_type == 2) {
                $inventories = DB::table('inventory')->where('products_id', $product->products_id)->get();
                $stockIn = 0;
                foreach ($inventories as $inventory) {
                    $stockIn += $inventory->stock;
                }

                $orders_products = DB::table('orders_products')
                    ->select(DB::raw('count(orders_products.products_quantity) as stockout'))
                    ->where('products_id', $product->products_id)->get();

                $stocks = $stockIn - $orders_products[0]->stockout;

                $manageLevel = DB::table('manage_min_max')->where('products_id', $product->products_id)->get();

                $min_level = 0;
                $max_level = 0;

                if (count($manageLevel) > 0) {
                    $min_level = $manageLevel[0]->min_level;
                    $max_level = $manageLevel[0]->max_level;
                }

                if ($stocks <= $min_level) {
                    array_push($products_array, $product);
                }

            }
        }

        $lowQunatity = DB::table('products')
            ->LeftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->whereColumn('products.products_quantity', '<=', 'products.low_limit')
            ->where('products_description.language_id', '=', 2)
            ->where('products.low_limit', '>', 0)
            ->paginate(10);

        $result['lowQunatity'] = $products_array;

        //get function from other controller
        $myVar = new SiteSettingController();
        $result['currency'] = $myVar->getSetting();
        $result['commonContent'] = $myVar->Setting->commonContent();

        return view("admin.reports.lowinstock", $title)->with('result', $result);
    }

    //productsStock
    public function stockin(Request $request)
    {
        $title = array('pageTitle' => Lang::get("labels.ProductsStocks"));
        $language_id = 1;

        $products = DB::table('products')
            ->LeftJoin('products_description', 'products_description.products_id', '=', 'products.products_id')
            ->where('products_description.language_id', '=', $language_id)
            ->where('products.products_id', '=', $request->products_id)
            ->get();

        $productsArray = array();
        $index = 0;
        foreach ($products as $product) {
            array_push($productsArray, $product);
            $inventories = DB::table('inventory')->where('products_id', $product->products_id)
                ->leftJoin('users', 'users.id', '=', 'inventory.admin_id')
                ->get();

            $productsArray['history'] = $inventories;
        }
        $result['products'] = $productsArray;

        //echo '<pre>'.print_r($result['products'],true).'<pre>';

        //get function from other controller
        $myVar = new SiteSettingController();
        $result['currency'] = $myVar->getSetting();
        $result['commonContent'] = $myVar->Setting->commonContent();

        return view("admin.reports.stockin", $title)->with('result', $result);

    }

    public function getFormattedDate($reportBase)
    {
        $dateFrom = date('Y-m-01', $date);
        $dateTo = date('Y-m-t', $date);
    }

    //public function productSaleReport($reportBase){
    public function productSaleReport(Request $request)
    {

        $saleData = array();
        $date = time();
        $reportBase = $request->reportBase;
        //$reportBase = 'last_year';

        if ($reportBase == 'this_month') {

            $dateLimit = date('d', $date);

            //for current month
            for ($j = 1; $j <= $dateLimit; $j++) {

                $dateFrom = date('Y-m-' . $j . ' 00:00:00', time());
                $dateTo = date('Y-m-' . $j . ' 23:59:59', time());

                //sold products
                $orders = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->get();

                $totalSale = 0;
                foreach ($orders as $orders_data) {

                    $orders_status = DB::table('orders_status_history')
                        ->where('orders_id', '=', $orders_data->orders_id)
                        ->orderby('date_added', 'DESC')->limit(1)->get();

                    if ($orders_status[0]->orders_status_id != 3) {
                        $totalSale++;
                    }
                }

                //purchase products
                $products = DB::table('products')
                    ->select('products_quantity', DB::raw('SUM(products_quantity) as products_quantity'))
                    ->whereBetween('products_date_added', [$dateFrom, $dateTo])
                    ->get();

                $saleData[$j - 1]['date'] = date('d M', strtotime($dateFrom));
                $saleData[$j - 1]['totalSale'] = $totalSale;

                if (empty($products[0]->products_quantity)) {
                    $producQuantity = 0;
                } else {
                    $producQuantity = $products[0]->products_quantity;
                }

                $saleData[$j - 1]['productQuantity'] = $producQuantity;
            }

        } else if ($reportBase == 'last_month') {
            $datePrevStart = date("Y-n-j", strtotime("first day of previous month"));
            $datePrevEnd = date("Y-n-j", strtotime("last day of previous month"));

            $dateLimit = date('d', strtotime($datePrevEnd));

            //for last month
            for ($j = 1; $j <= $dateLimit; $j++) {

                $dateFrom = date('Y-m-' . $j . ' 00:00:00', strtotime($datePrevStart));
                $dateTo = date('Y-m-' . $j . ' 23:59:59', strtotime($datePrevEnd));

                //sold products
                $orders = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->get();

                $totalSale = 0;
                foreach ($orders as $orders_data) {

                    $orders_status = DB::table('orders_status_history')
                        ->where('orders_id', '=', $orders_data->orders_id)
                        ->orderby('date_added', 'DESC')->limit(1)->get();

                    if ($orders_status[0]->orders_status_id != 3) {
                        $totalSale++;
                    }
                }

                //purchase products
                $products = DB::table('products')
                    ->select('products_quantity', DB::raw('SUM(products_quantity) as products_quantity'))
                    ->whereBetween('products_date_added', [$dateFrom, $dateTo])
                    ->get();

                $saleData[$j - 1]['date'] = date('d M', strtotime($dateFrom));
                $saleData[$j - 1]['totalSale'] = $totalSale;

                if (empty($products[0]->products_quantity)) {
                    $producQuantity = 0;
                } else {
                    $producQuantity = $products[0]->products_quantity;
                }

                $saleData[$j - 1]['productQuantity'] = $producQuantity;
            }

        } else if ($reportBase == 'last_year') {

            $dateLimit = date("Y", strtotime("-1 year"));

            $datePrevStart = date("Y-n-j", strtotime("first day of previous month"));
            $datePrevEnd = date("Y-n-j", strtotime("last day of previous month"));

            //for last year
            for ($j = 1; $j <= 12; $j++) {
                $dateFrom = date($dateLimit . '-' . $j . '-1 00:00:00', strtotime($datePrevStart));
                $dateTo = date($dateLimit . '-' . $j . '-31 23:59:59', strtotime($datePrevEnd));

                //sold products
                $orders = DB::table('orders')
                    ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                    ->get();

                $totalSale = 0;
                foreach ($orders as $orders_data) {

                    $orders_status = DB::table('orders_status_history')
                        ->where('orders_id', '=', $orders_data->orders_id)
                        ->orderby('date_added', 'DESC')->limit(1)->get();

                    if ($orders_status[0]->orders_status_id != 3) {
                        $totalSale++;
                    }
                }

                //purchase products
                $products = DB::table('products')
                    ->select('products_quantity', DB::raw('SUM(products_quantity) as products_quantity'))
                    ->whereBetween('products_date_added', [$dateFrom, $dateTo])
                    ->get();

                $saleData[$j - 1]['date'] = date('M Y', strtotime($dateFrom));
                $saleData[$j - 1]['totalSale'] = $totalSale;

                if (empty($products[0]->products_quantity)) {
                    $producQuantity = 0;
                } else {
                    $producQuantity = $products[0]->products_quantity;
                }

                $saleData[$j - 1]['productQuantity'] = $producQuantity;
            }
        } else {
            $reportBase = str_replace('dateRange', '', $reportBase);
            $reportBase = str_replace('=', '', $reportBase);
            $reportBase = str_replace('-', '/', $reportBase);

            $dateFrom = substr($reportBase, 0, 10);
            $dateTo = substr($reportBase, 11, 21);

            $diff = abs(strtotime($dateFrom) - strtotime($dateTo));
            $years = floor($diff / (365 * 60 * 60 * 24));
            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
            $totalDays = floor($diff / (60 * 60 * 24));
            //    print ('day: '.$days.' months: '.$months.' years: '.$years.'<br>');
            $totalMonths = floor($diff / 60 / 60 / 24 / 30);

            if ($diff == 0 && $days == 0 && $years == 0 && $months == 0) {
                //print 'asdsad';

                $dateLimitFrom = date('G', strtotime($dateFrom));
                $dateLimitTo = date('d', strtotime($dateTo));
                $selecteddate = date('m', strtotime($dateFrom));
                $selecteddate = date('Y', strtotime($dateFrom));

                //for current month
                for ($j = 1; $j <= 24; $j++) {

                    $dateFrom = date('Y-m-d' . ' ' . $j . ':00:00', strtotime($dateFrom));
                    $dateTo = date('Y-m-d' . ' ' . $j . ':59:59', strtotime($dateFrom));

                    //sold products
                    $orders = DB::table('orders')
                        ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                        ->get();

                    $totalSale = 0;
                    foreach ($orders as $orders_data) {

                        $orders_status = DB::table('orders_status_history')
                            ->where('orders_id', '=', $orders_data->orders_id)
                            ->orderby('date_added', 'DESC')->limit(1)->get();

                        if ($orders_status[0]->orders_status_id != 3) {
                            $totalSale++;
                        }
                    }

                    //purchase products
                    $products = DB::table('products')
                        ->select('products_quantity', DB::raw('SUM(products_quantity) as products_quantity'))
                        ->whereBetween('products_date_added', [$dateFrom, $dateTo])
                        ->get();

                    $saleData[$j - 1]['date'] = date('h a', strtotime($dateFrom));
                    $saleData[$j - 1]['totalSale'] = $totalSale;

                    if (empty($products[0]->products_quantity)) {
                        $producQuantity = 0;
                    } else {
                        $producQuantity = $products[0]->products_quantity;
                    }

                    $saleData[$j - 1]['productQuantity'] = $producQuantity;
                    //print $dateLimitFrom.'<br>';

                }

            } else if ($days > 1 && $years == 0 && $months == 0) {

                //print 'daily';

                $dateLimitFrom = date('d', strtotime($dateFrom));
                $dateLimitTo = date('d', strtotime($dateTo));
                $selectedMonth = date('m', strtotime($dateFrom));
                $selectedYear = date('Y', strtotime($dateFrom));
                //print $selectedYear;

                //for current month
                for ($j = 1; $j <= $totalDays; $j++) {

                    //print 'dateFrom: '.date('Y-m-'.$j.' 00:00:00', time()).'dateTo: '.date('Y-m-'.$j.' 23:59:59', time());
                    //print '<br>';

                    $dateFrom = date($selectedYear . '-' . $selectedMonth . '-' . $dateLimitFrom, strtotime($dateFrom));
                    //$dateTo     = date('Y-m-'.$j.' 23:59:59', time());
                    //print $dateFrom .'<br>';
                    $lastday = date('t', strtotime($dateFrom));
                    //print 'lastday: '.$lastday .' <br>';

                    //sold products
                    $orders = DB::table('orders')
                        ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                        ->get();

                    $totalSale = 0;
                    foreach ($orders as $orders_data) {

                        $orders_status = DB::table('orders_status_history')
                            ->where('orders_id', '=', $orders_data->orders_id)
                            ->orderby('date_added', 'DESC')->limit(1)->get();

                        if ($orders_status[0]->orders_status_id != 3) {
                            $totalSale++;
                        }
                    }

                    //purchase products
                    $products = DB::table('products')
                        ->select('products_quantity', DB::raw('SUM(products_quantity) as products_quantity'))
                        ->whereBetween('products_date_added', [$dateFrom, $dateTo])
                        ->get();

                    $saleData[$j - 1]['date'] = date('d M', strtotime($dateFrom));
                    $saleData[$j - 1]['totalSale'] = $totalSale;

                    if (empty($products[0]->products_quantity)) {
                        $producQuantity = 0;
                    } else {
                        $producQuantity = $products[0]->products_quantity;
                    }

                    $saleData[$j - 1]['productQuantity'] = $producQuantity;
                    //print $dateLimitFrom.'<br>';
                    if ($dateLimitFrom == $lastday) {
                        $dateLimitFrom = '1';
                        $selectedMonth++;

                    } else {
                        $dateLimitFrom++;
                    }

                    if ($selectedMonth > 12) {
                        $selectedMonth = '1';
                        $selectedYear++;
                    }
                }
            } else if ($months >= 1 && $years == 0) {

                //for check if date range enter into another month
                if ($days > 0) {
                    $months += 1;
                }

                $dateLimitFrom = date('d', strtotime($dateFrom));
                $dateLimitTo = date('d', strtotime($dateTo));
                $selectedMonth = date('m', strtotime($dateFrom));
                $selectedYear = date('Y', strtotime($dateFrom));
                //print $selectedMonth;

                $i = 0;
                //for current month
                for ($j = 1; $j <= $months; $j++) {
                    if ($j == $months) {
                        $lastday = $dateLimitTo;
                    } else {
                        $lastday = date('t', strtotime($dateLimitFrom . '-' . $selectedMonth . '-' . $selectedYear));
                    }

                    $dateFrom = date($selectedYear . '-' . $selectedMonth . '-' . $dateLimitFrom, strtotime($dateFrom));
                    $dateTo = date($selectedYear . '-' . $selectedMonth . '-' . $lastday, strtotime($dateTo));
                    //print $dateFrom.' '.$dateTo.'<br>';

                    //sold products
                    $orders = DB::table('orders')
                        ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                        ->get();

                    $totalSale = 0;
                    foreach ($orders as $orders_data) {

                        $orders_status = DB::table('orders_status_history')
                            ->where('orders_id', '=', $orders_data->orders_id)
                            ->orderby('date_added', 'DESC')->limit(1)->get();

                        if ($orders_status[0]->orders_status_id != 3) {
                            $totalSale++;
                        }
                    }

                    //purchase products
                    $products = DB::table('products')
                        ->select('products_quantity', DB::raw('SUM(products_quantity) as products_quantity'))
                        ->whereBetween('products_date_added', [$dateFrom, $dateTo])
                        ->get();

                    $saleData[$i]['date'] = date('M Y', strtotime($dateFrom));
                    $saleData[$i]['totalSale'] = $totalSale;

                    if (empty($products[0]->products_quantity)) {
                        $producQuantity = 0;
                    } else {
                        $producQuantity = $products[0]->products_quantity;
                    }

                    $saleData[$i]['productQuantity'] = $producQuantity;

                    $selectedMonth++;
                    if ($selectedMonth > 12) {
                        $selectedMonth = '1';
                        $selectedYear++;
                    }
                    $i++;
                }

            } else if ($years >= 1) {

                //print $years.'sadsa';
                if ($months > 0) {
                    $years += 1;
                }

                //print $years;

                $dateLimitFrom = date('d', strtotime($dateFrom));
                $dateLimitTo = date('d', strtotime($dateTo));

                $selectedMonthFrom = date('m', strtotime($dateFrom));
                $selectedMonthTo = date('m', strtotime($dateTo));

                $selectedYearFrom = date('Y', strtotime($dateFrom));
                $selectedYearTo = date('Y', strtotime($dateTo));
                //print $selectedYearFrom.' '.$selectedYearTo;

                $i = 0;
                //for current month
                for ($j = $selectedYearFrom; $j <= $selectedYearTo; $j++) {

                    if ($j == $selectedYearTo) {
                        $selectedYearTo = $selectedYearTo;
                        $dateLimitTo = $dateLimitTo;
                    } else {
                        $selectedMonthTo = 12;
                        $dateLimitTo = 31;
                    }

                    if ($selectedYearFrom == $j) {
                        $selectedMonthFrom = $selectedMonthFrom;
                    } else {
                        $selectedMonthFrom = 1;
                    }

                    //    print $j.'-'.$selectedMonthFrom.'-'.$dateLimitFrom.'<br>';
                    //print $j.'-'.$selectedMonthTo.'-'.$dateLimitTo.'<br>';
                    //$lastday  =  date('t',strtotime($dateLimitFrom.'-'.$selectedMonth.'-'.$selectedYear));

                    $dateFrom = date($j . '-' . $selectedMonthFrom . '-' . $dateLimitFrom, strtotime($dateFrom));
                    $dateTo = date($j . '-' . $selectedMonthTo . '-' . $dateLimitTo, strtotime($dateTo));
                    //    print $dateFrom.' '.$dateTo.'<br>';
                    //print $dateFrom.'<br>';

                    //sold products
                    $orders = DB::table('orders')
                        ->whereBetween('date_purchased', [$dateFrom, $dateTo])
                        ->get();

                    $totalSale = 0;
                    foreach ($orders as $orders_data) {

                        $orders_status = DB::table('orders_status_history')
                            ->where('orders_id', '=', $orders_data->orders_id)
                            ->orderby('date_added', 'DESC')->limit(1)->get();

                        if ($orders_status[0]->orders_status_id != 3) {
                            $totalSale++;
                        }
                    }

                    //purchase products
                    $products = DB::table('products')
                        ->select('products_quantity', DB::raw('SUM(products_quantity) as products_quantity'))
                        ->whereBetween('products_date_added', [$dateFrom, $dateTo])
                        ->get();

                    $saleData[$i]['date'] = date('Y', strtotime($dateFrom));
                    $saleData[$i]['totalSale'] = $totalSale;

                    if (empty($products[0]->products_quantity)) {
                        $producQuantity = 0;
                    } else {
                        $producQuantity = $products[0]->products_quantity;
                    }
                    $saleData[$i]['productQuantity'] = $producQuantity;
                    $i++;
                }

            }
        }
        return $saleData;
    }
}
