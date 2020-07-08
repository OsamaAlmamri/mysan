<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Currency extends Model
{
//"id": 2,
//"title": "دولار امريكي",
//"code": "USD",
//"symbol_left": "$",
//"symbol_right": "",
//"decimal_point": null,
//"thousands_point": null,
//"decimal_places": "2",
//"created_at": "2020-05-28 02:05:15",
//"updated_at": "2020-05-28 02:05:15",
//"value": 0.264,
//"is_default": 0,
//
    public function getter(){
      $currencies = DB::table('currencies')->get(['title','code','symbol_left','value','is_default','decimal_places']);
      return $currencies;
    }

}
