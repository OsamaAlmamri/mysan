<?php


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


function formatDateToTimeLine($date)
{
//       return Carbon::parse($date)->diffForHumans();
    return array(
        'month' => Carbon::parse($date)->monthName,
        'day' => Carbon::parse($date)->day,
        'all' => Carbon::parse($date)->day . '/' . Carbon::parse($date)->shortMonthName . '/' . Carbon::parse($date)->year,
    );
}

function dateFormFormat($date)
{
//       return Carbon::parse($date)->diffForHumans();
    return Carbon::parse($date)->month . '/' . Carbon::parse($date)->day . '/' . Carbon::parse($date)->year;
}

if (!function_exists('lang')) {
    function lang()
    {
        if (session()->has('lang')) {
            return session('lang');
        } else {
            if (setting('default_lang') != null)
                return setting('default_lang');
            else
                return 'ar';
        }

    }
}


