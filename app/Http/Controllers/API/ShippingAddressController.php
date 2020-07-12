<?php

namespace App\Http\Controllers\API;
//use Mail;
//validator is builtin class in laravel
use Illuminate\Validation\Rule;
use Validator;

use DB;

//for password encryption or hash protected
use Hash;

//for authenitcate login data
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

//for requesting a value
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

//for Carbon a value
use Carbon;
use Illuminate\Support\Facades\Redirect;
use Session;
use Lang;
use App\Models\API\Index;
use App\Models\API\Languages;
use App\Models\API\Products;
use App\Models\API\Currency;
use App\Models\API\Shipping;

//email
use Illuminate\Support\Facades\Mail;

class ShippingAddressController extends BaseAPIController
{
    public function __construct(
        Languages $languages,
        Products $products,
        Currency $currency,
        Shipping $shipping

    )
    {
        $this->languages = $languages;
        $this->products = $products;
        $this->currencies = $currency;
        $this->shipping = $shipping;
    }


    //get all zones
    public function ajaxZones(Request $request)
    {

        $getZones = $this->shipping->zones($request->country_id);

        return $this->sendNotFormatResponse($getZones);

    }


    //get all customer addresses url
    public function my_address(Request $request)
    {
        $result = $this->shipping->getShippingAddress($address_id = '');
        return $this->sendResponse($result, '');

    }

    //get all customer addresses url
    public function shippingAddress(Request $request)
    {
        $result = array();
        if (!empty($request->action)) {
            $result['action'] = $request->action;
        } else {
            $result['action'] = '';
        }
        // address book
        $result['address'] = $this->shipping->getShippingAddress($address_id = '');
        $result['countries'] = $this->shipping->countries();
        //edit address
        if (!empty($request->address_id)) {
            $result['editAddress'] = $this->shipping->getShippingAddress($request->address_id);
            $result['zones'] = $this->shipping->zones($result['editAddress'][0]->countries_id);
        } else {
            $result['editAddress'] = '';
//            $result['zones'] = '';
            $result['zones'] = $this->shipping->zones($result['countries'][0]->countries_id);
        }
        return $this->sendNotFormatResponse($result);
//        return view("web.shipping")->with('result', $result);
    }

    public function validateAddress($request, $id = 0)
    {
        $rules = [];
        if ($id > 0)
            $rules['address_book_id'] = 'required|string';
        $rules['name'] = 'required|string';
        $rules['entry_city'] = 'required';
        $rules['entry_street_address'] = 'required';
        $rules['entry_country_id'] = 'required';
        $rules['entry_zone_id'] = 'required';
        $rules['entry_latitude'] = 'required';
        $rules['entry_longitude'] = 'required';

        $validator = Validator::make($request->all(), $rules);

        return $validator;
    }

    public function addMyAddress(Request $request)
    {
        $validator = $this->validateAddress($request);
        if ($validator->fails())
            return $this->sendError($validator->errors(), 'خطاء في الببينات المطلوبة', 422);
        $this->shipping->addMyAddress($request);
        return $this->sendResponse('', 'Your address has been added successfully!');
    }



    //update shipping address
    public function updateAddress(Request $request)
    {
        $validator = $this->validateAddress($request, 1);
        if ($validator->fails())
            return $this->sendError($validator->errors(), 'خطاء في الببينات المطلوبة', 422);
        $customers_id = auth()->user()->id;
        $address_book_id = $request->address_book_id;
        $name = $request->name;
        $entry_street_address = $request->entry_street_address;
        $entry_suburb = $request->entry_suburb;
        $entry_city = $request->entry_city;
        $entry_state = $request->entry_state;
        $entry_country_id = $request->entry_country_id;
        $entry_zone_id = $request->entry_zone_id;
        $entry_company = $request->entry_company;
        $entry_longitude = $request->entry_longitude;
        $entry_latitude = $request->entry_latitude;
        $customers_default_address_id = $request->customers_default_address_id;
        if (!empty($customers_id)) {
            $address_book_data = array(
                'name' => $name,
                'entry_street_address' => $entry_street_address,
                'entry_suburb' => $entry_suburb,
                'entry_city' => $entry_city,
                'entry_state' => $entry_state,
                'entry_country_id' => $entry_country_id,
                'entry_zone_id' => $entry_zone_id,
                'customers_id' => $customers_id,
                'entry_company' => $entry_company,
                'entry_latitude' => $entry_latitude,
                'entry_longitude' => $entry_longitude,
            );
            //add address into address book
            $this->shipping->updateAddressBook($address_book_data, $address_book_id);
            //default address id
            if ($customers_default_address_id == '1') {
                $this->shipping->updateCustomer($customers_id, $address_book_id);
            }
            return $this->sendResponse('', 'Your address has been updated successfully!');
        }
    }

    //delete shipping address
    public function deleteAddress(Request $request)
    {
        $address_book_id = $request->address_book_id;
        $this->shipping->deleteAddress($address_book_id);
        return $this->sendResponse('', 'Your address has been deleted successfully!');
    }
    //update shipping address
    public function myDefaultAddress(Request $request)
    {
        $result = $this->shipping->myDefaultAddress($request);

        return $this->sendResponse($result, $result == 1 ? 'تم تحديد هذا الموقع كافتراضي' : 'هذا الموقع غير مرتبط بالمستخدم الحالي');
    }
}
