<?php

namespace App\DataTables;

use App\Models\Core\Coupon;
use App\Models\Core\Reviews;
use App\Models\Core\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class CouponOrdersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
   private $coboun_id;


   public function __construct($id)
   {
       $this->coboun_id=$id;
   }

    public function dataTable($query)
    {
        return datatables($query)
            ->addIndexColumn()
            ->addColumn('manage', 'admin.Orders.btns.manage')
            ->rawColumns(['manage']);
    }


    public function query()
    {

        $c=Coupon::find($this->coboun_id);
        return  $c->orders;

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
                'name' => 'orders_id',
                'data' => 'orders_id',
                'title' => trans('labels.ID'),
            ],
            [
                'name' => 'customers_name',
                'data' => 'customers_name',
                'title' => trans('labels.CustomerName'),
            ],
//            date('d/m/Y', strtotime($orderData->date_purchased))
            [
                'name' => 'order_price',
                'data' => 'order_price',
                'title' => trans('labels.OrderTotal'),
            ],
            [
                'name' => 'date_purchased',
                'data' => 'date_purchased',
                'title' => trans('labels.DatePurchased'),
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
