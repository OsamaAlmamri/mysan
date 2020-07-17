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


if (!function_exists('datatable_lang')) {
    function datatable_lang()
    {
        return [
            'sEmptyTable' => trans('dataTable.sEmptyTable'),
            'sInfo' => trans('dataTable.sInfo'),
            'sInfoEmpty' => trans('dataTable.sInfoEmpty'),
            'sInfoFiltered' => trans('dataTable.sInfoFiltered'),
            'sInfoPostFix' => trans('dataTable.sInfoPostFix'),
            'sLengthMenu' => trans('dataTable.sLengthMenu'),
            'sInfoThousands' => trans('dataTable.sInfoThousands'),
            'sLoadingRecords' => trans('dataTable.sLoadingRecords'),
            'sProcessing' => trans('dataTable.sProcessing'),
            'sZeroRecords' => trans('dataTable.sZeroRecords'),
            'sSearch' => trans('dataTable.sSearch'),
            'oPaginate' => [
                'sNext' => trans('dataTable.sNext'),
                'sPrevious' => trans('dataTable.sPrevious'),
                'sFirst' => trans('dataTable.sFirst'),
                'sLast' => trans('dataTable.sLast'),
            ],
            'oAria' => [
                'sSortAscending' => trans('dataTable.sSortAscending'),
                'sSortDescending' => trans('dataTable.sSortDescending'),
            ],
        ];

    }
}

