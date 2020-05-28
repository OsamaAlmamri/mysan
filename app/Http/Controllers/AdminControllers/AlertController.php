<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\AdminControllers\SiteSettingController;
use App\Models\Core\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;


class AlertController extends Controller
{
    //
public function __construct(Setting $setting)
{

    $this->myVarsetting = new SiteSettingController($setting);

}


    //new product notifications
    public function newProductNotification($products_id){
        $result = array();
        //alert setting

        $alertSetting = $this->myVarsetting->getAlertSetting();

        $product = DB::table('products_to_categories')
            ->leftJoin('categories', 'categories.categories_id', '=', 'products_to_categories.categories_id')
            ->leftJoin('categories_description', 'categories_description.categories_id', '=', 'products_to_categories.categories_id')
            ->leftJoin('products', 'products.products_id', '=', 'products_to_categories.products_id')
            ->leftJoin('products_description','products_description.products_id','=','products.products_id')
            ->LeftJoin('manufacturers', function ($join) {
                $join->on('manufacturers.manufacturers_id', '=', 'products.manufacturers_id');
            })
            ->LeftJoin('specials', function ($join) {
                $join->on('specials.products_id', '=', 'products.products_id')->where('status', '=', '1');
            })

            ->select('products_to_categories.*', 'categories_description.categories_name','categories.*', 'products.*','products_description.*', 'specials.specials_id', 'manufacturers.*', 'specials.products_id as special_products_id', 'specials.specials_new_products_price as specials_products_price', 'specials.specials_date_added as specials_date_added', 'specials.specials_last_modified as specials_last_modified', 'specials.expires_date')
            ->where('products_description.language_id','=', 1)
            ->where('products.products_id','=', $products_id)
            ->where('categories_description.language_id','=', 1)->get();

        $result['product'] = $product;

        //email
        if($alertSetting[0]->new_product_email==1){

            $customers = DB::table('customers')->get();

            $result['customers'] = $customers;

            foreach($customers as $customers_data){
                $customers_data->product = $product;
                if( !empty($customers_data->email) )
                {
                    Mail::send('/mail/newProduct', ['customers_data' => $customers_data], function($m) use ($customers_data){
                        $m->to($customers_data->email)->subject(Lang::get("labels.NewProductEmailTitle"))->getSwiftMessage()
                            ->getHeaders()
                            ->addTextHeader('x-mailgun-native-send', 'true');
                    });
                }

            }


        }

        //notification
        if($alertSetting[0]->new_product_notification==1){

            $title	  = Lang::get("labels.newProductNotificationTitle");
            $message  = Lang::get("labels.newProductNotficationMessagePart1").$product[0]->products_name.'" '.Lang::get("labels.newProductNotficationMessagePart2");

            //image
            $websiteURL =  "https://" . $_SERVER['SERVER_NAME'] .'/demos/website/'. $product[0]->products_image;

            $sendData = array
            (
                'body' 	=> $message,
                'title'	=> $title ,
                'icon'	=> 'myicon',/*Default Icon*/
                'sound' => 'mySound',/*Default sound*/
                'image' => $websiteURL
            );

            //status change push notifications

            $setting = $this->myVarsetting->getSetting();

            $devices = DB::table('devices')
                ->where('status','=', 1)
                ->where('devices.'.$setting[54]->value,'=', '1')
                ->where('devices.is_notify','=', '1')
                ->get();

            if($setting[54]->value=='fcm'){
                $functionName = 'fcmNotification';
            }elseif($setting[54]->value=='onesignal'){
                $functionName = 'onesignalNotification';
            }

            foreach($devices as $devices_data){
                $response[] = $this->$functionName($devices_data->device_id, $sendData);
            }
        }

    }

    //new product notifications
    public function newsNotification($news_id)
    {
        $result = array();
        //alert setting

        $alertSetting = $this->myVarsetting->getAlertSetting();

        $news = DB::table('news_to_news_categories')
            ->leftJoin('news_categories', 'news_categories.categories_id', '=', 'news_to_news_categories.categories_id')
            ->leftJoin('news', 'news.news_id', '=', 'news_to_news_categories.news_id')
            ->leftJoin('news_description', 'news_description.news_id', '=', 'news.news_id')
            ->leftJoin('news_categories_description', 'news_categories_description.categories_id', '=', 'news_to_news_categories.categories_id')
            ->select('news_to_news_categories.*', 'news_categories_description.categories_name', 'news_categories.*', 'news.*', 'news_description.*')
            ->where('news.news_id', '=', $news_id)
            ->where('news_description.language_id', '=', 1)
            ->where('news_categories_description.language_id', '=', 1)
            ->orderBy('news.news_id', 'ASC')
            ->get();

        $result['news'] = $news;

        //email
        if ($alertSetting[0]->news_email == 1) {

            $customers = DB::table('customers')->get();

            $result['customers'] = $customers;

            foreach ($customers as $customers_data) {
                $customers_data->news = $news;
                if (!empty($customers_data->email)) {
                    Mail::send('/mail/news', ['customers_data' => $customers_data], function ($m) use ($customers_data) {
                        $m->to($customers_data->email)->subject($customers_data->news[0]->news_name)->getSwiftMessage()
                            ->getHeaders()
                            ->addTextHeader('x-mailgun-native-send', 'true');
                    });
                }
            }

        }
        //notification
        if($alertSetting[0]->news_notification==1){

            $title	  = Lang::get("labels.newsNotificationTitle");
            $message  = $news[0]->news_name.' '.Lang::get("labels.newsNotficationMessagePart1");

            //image
            $websiteURL =  "https://" . $_SERVER['SERVER_NAME'] .'/demos/website/'. $news[0]->news_image;

            $sendData = array
            (
                'body' 	=> $message,
                'title'	=> $title ,
                'icon'	=> 'myicon',/*Default Icon*/
                'sound' => 'mySound',/*Default sound*/
                'image' => $websiteURL
            );

            //status change push notifications

            $setting = $this->myVarsetting->getSetting();


            $devices = DB::table('devices')
                ->where('status','=', 1)
                ->where('devices.'.$setting[54]->value,'=', '1')
                ->where('devices.is_notify','=', '1')
                ->get();

            if($setting[54]->value=='fcm'){
                $functionName = 'fcmNotification';
            }elseif($setting[54]->value=='onesignal'){
                $functionName = 'onesignalNotification';
            }

            foreach($devices as $devices_data){
                $response[] = $this->$functionName($devices_data->device_id, $sendData);
            }
        }





    }

}
