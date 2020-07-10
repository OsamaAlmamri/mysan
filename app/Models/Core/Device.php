<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\DB;


class Device extends Model
{
    //
    use Sortable;

    protected $fillable = ['device_id', 'user_id', 'device_type', 'status', 'ram', 'processor',
        'device_os', 'location', 'latittude', 'device_model', 'manufacturer', 'device_mac', 'browser_info', 'is_notify'];


}
