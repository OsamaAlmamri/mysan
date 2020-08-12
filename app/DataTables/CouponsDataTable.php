<?php

namespace App\DataTables;

use App\Models\Core\Coupon;
use App\Models\Core\Reviews;
use App\Models\Core\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class CouponsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

    public function dataTable($query)
    {
        return datatables($query)
            ->addIndexColumn()
            ->addColumn('manage', 'admin.coupons.btn.manage')
            ->rawColumns(['manage']);
    }


    public function query()
    {

        $coupons = Coupon::all()
            ->sortByDesc('created_at');
        return $coupons;

    }


    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            //  ->addAction(['width' => '80px'])
            //  ->parameters($this->getBuilderParameters());
            ->parameters(
                [
                    'paging' => true,
                    'responsive' => true,
                    'scrollX' => true,
                    'searching' => true,
                    'autoWidth' => false,

                    'info' => false, 'searchDelay' => 350,
//                    'language' => ['url' => url('js/dataTables/language.json')],
                    'language' => datatable_lang(),
//                    'dom' => 'Blftip',
                    'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, trans('dataTable.all')]],
                ]
            );
    }

    protected function getColumns()
    {

        return [
            ['name' => 'DT_RowIndex',
                'data' => 'DT_RowIndex',
                'title' => '#'],
            [
                'name' => 'code',
                'data' => 'code',
                'title' => trans('labels.Code'),
            ], [
                'name' => 'discount_type',
                'data' => 'discount_type',
                'title' => trans('labels.CouponType'),
            ], [
                'name' => 'amount',
                'data' => 'amount',
                'title' => trans('labels.CouponAmount'),
            ], [
                'name' => 'description',
                'data' => 'description',
                'title' => trans('labels.Description'),
            ],
            [
                'name' => 'expiry_date',
                'data' => 'expiry_date',
                'title' => trans('labels.ExpiryDate'),
            ],
            ['name' => 'manage',
                'data' => 'manage',
                'title' => trans('labels.Action'),
                'exportable' => false,
                'printable' => false,
                'orderable' => false,
                'searchable' => false,
            ],

        ];
    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Project_' . date('YmdHis');
    }
}
