<?php

namespace App\Models\API;

use DB;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{

    public function addMyAddress($request)
    {

        $customers_id = auth()->user()->id;
        $name = $request->name;
        $entry_street_address = $request->entry_street_address;
        $entry_suburb = $request->entry_suburb;
        $entry_city = $request->entry_city;
        $entry_state = $request->entry_state;
        $entry_country_id = $request->entry_country_id;
        $entry_zone_id = $request->entry_zone_id;
        $entry_longitude = $request->entry_longitude;
        $entry_latitude = $request->entry_latitude;
        $entry_company = $request->entry_company;
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
                'entry_latitude' => $entry_latitude,
                'entry_longitude' => $entry_longitude,
                'user_id' => $customers_id,
                'entry_company' => $entry_company,
            );

            //add address into address book
            $address_book_id = DB::table('address_book')->insertGetId($address_book_data);

            //default address id
            DB::table('user_to_address')
                ->insert(['user_id' => auth()->user()->id, 'address_book_id' => $address_book_id, 'is_default' => 0]);
        }

    }

    //get all customer addresses url
    public function getShippingAddress($address_id)
    {

        $addresses = DB::table('user_to_address')
            ->leftjoin('address_book', 'user_to_address.address_book_id', '=', 'address_book.address_book_id')
            ->leftJoin('countries', 'countries.countries_id', '=', 'address_book.entry_country_id')
            ->leftJoin('zones', 'zones.zone_id', '=', 'address_book.entry_zone_id')
            ->select(
                'user_to_address.is_default as default_address',
                'address_book.address_book_id as address_id',
                'address_book.entry_company as company',
                'address_book.name as name',
                'address_book.entry_street_address as street',
                'address_book.entry_suburb as suburb',
                'address_book.entry_city as city',
                'address_book.entry_state as state',

                'countries.countries_id as countries_id',
                'countries.countries_name as country_name',

                'zones.zone_id as zone_id',
                'zones.zone_code as zone_code',
                'zones.zone_name as zone_name'
            )
            ->where('address_book.customers_id', auth()->user()->id);

        if (!empty($address_id)) {
            $addresses->where('address_book.address_book_id', '=', $address_id);
        }
        $result = $addresses->get();

        return $result;

    }

    public function countries()
    {
        $allCountries = DB::table('countries')->get();
        return ($allCountries);

    }

    //get all zones
    public function zones($country_id)
    {

        $zones = DB::table('zones');

        if (!empty($country_id)) {
            $zones->where('zone_country_id', $country_id);
        }

        $getZones = $zones->get();
        return $getZones;

    }

    public function updateAddressBook($address_book_data, $address_book_id)
    {
        DB::table('address_book')->where('address_book_id', $address_book_id)->update($address_book_data);
    }

    public function updateCustomer($customers_id, $address_book_id)
    {
        DB::table('customers')->where('customers_id', $customers_id)->update(['customers_default_address_id' => $address_book_id]);
    }

    public function deleteAddress($id)
    {

        $customers_id = auth()->user()->id;
        $address_book_id = $id;
        $d = 0;
        if (!empty($customers_id)) {

            //delete address into address book
            $d = DB::table('user_to_address')->where('address_book_id', $address_book_id)->delete();
            $defaultAddress = DB::table('user_to_address')->where([['user_id', $customers_id],
                ['address_book_id', $address_book_id]])->get();
            if (count($defaultAddress) > 0) {
                //default address id
                $customers_default_address_id = '0';
                DB::table('user_to_address')->where('user_id', $customers_id)->update(['is_default' => $customers_default_address_id]);
            }
        }

        return $d;

    }

    public function myDefaultAddress($request)
    {

        $customers_id = auth()->user()->id;
        $address_book_id = $request->address_id;
        $c = DB::table('user_to_address')->where('user_id', $customers_id)->where('address_book_id', '=', $address_book_id)->count();
        if ($c > 0) {
            DB::table('user_to_address')->where('user_id', $customers_id)->where('address_book_id', '!=', $address_book_id)->where('is_default', '=', 1)->update(['is_default' => 0]);
            DB::table('user_to_address')->where('user_id', $customers_id)->where('address_book_id', '=', $address_book_id)->update(['is_default' => 1]);

            return 1;
        } else
            return 0;

    }

}
