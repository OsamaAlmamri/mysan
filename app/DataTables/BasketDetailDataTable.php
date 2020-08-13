<?php

namespace App\DataTables;

use App\Models\Core\Currency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Services\DataTable;

class BasketDetailDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    private $customer_id;

    public function __construct($id)
    {
        $this->customer_id=$id;
    }

    public function dataTable($query)
    {

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('btn_image', 'admin.reports.btns.btn_image')
            ->addColumn('btn_name', 'admin.reports.btns.btn_name')
            ->rawColumns([
                'btn_image', 'btn_name',
            ]);
    }


    public function query()
    {
        $data = DB::table('customers_basket')
            ->leftJoin('products', 'customers_basket.products_id', '=', 'products.products_id')
            ->LeftJoin('image_categories', function ($join) {
                $join->on('image_categories.image_id', '=', 'products.products_image')
                    ->where(function ($query) {
                        $query->where('image_categories.image_type', '=', 'THUMBNAIL')
                            ->where('image_categories.image_type', '!=', 'THUMBNAIL')
                            ->orWhere('image_categories.image_type', '=', 'ACTUAL');
                    });
            })
            ->select(
                DB::raw("(customers_basket_quantity * final_price ) as sum_final_price"),
                DB::raw("(SELECT (bouquets.bouquet_name_ar) FROM bouquets  WHERE bouquets.bouquet_id=customers_basket.products_id  LIMIT 1  ) as bouquet_name"),
                DB::raw("(SELECT (bouquets_image_categories.path ) FROM image_categories as   bouquets_image_categories  join bouquets on  bouquets.default_image=bouquets_image_categories.image_id  WHERE bouquets.bouquet_id=customers_basket.products_id and  bouquets_image_categories.image_type like 'THUMBNAIL'  LIMIT 1  ) as bouquet_image"),
                DB::raw("(SELECT (products_description.products_name) FROM products_description  WHERE products_description.products_id=customers_basket.products_id and products_description.language_id=2 LIMIT 1  ) as products_name"),
                'products.*',
//                'products_description.*',
                'customers_basket.*',
                'image_categories.path as path'
// 'products.updated_at as productupdate', 'categories_description.categories_id',
//                'categories_description.categories_name'
            )
//            ->where('products_description.language_id', '=', 2)
//            ->where('categories_description.language_id', '=', 2)
            ->where('is_order', 0)
            ->where('customers_id', $this->customer_id)
            ->get();
        return $data;
    }


    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $btnAdd = [];
        $route = "";
        $route = URL::to('admin/currencies/add');

//        if (Auth::user()->can('manage good_types') != false) {
        $btnAdd = ['className' => 'btn btn-primary', 'text' => '<i class="fa fa-plus" ></i> ' . trans('labels.AddNew'),
            'action' => " function(){
                              window.location.href='$route'
                              }"];
//        }

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

                    'info' => false,
                    'searchDelay' => 350,
//                    'language' => ['url' => url('js/dataTables/language.json')],
                    'language' => datatable_lang(),
//                    'dom' => 'Blfrtip',
                    'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, trans('dataTable.all')]],
                    'buttons' => [
                        $btnAdd,
//                        ['extend' => 'copyHtml5', 'text' => '<i class="fa fa-copy" ></i>' . trans('dataTable.btn.copy'), 'className' => 'btn btn-info ', 'exportOptions' => ['columns' => [0, 1, 2, 5]]],
                        ['extend' => 'excelHtml5', 'text' => '<i class="fa fa-file-excel-o" ></i> ' . trans('dataTable.btn.excel'), 'className' => 'btn btn-info ', 'exportOptions' => ['columns' => ':visible']],
                        ['extend' => 'print', 'text' => '<i class="feather icon-printer close-card" ></i> ' . trans('dataTable.btn.print'), 'className' => 'btn btn-info ', 'exportOptions' => ['columns' => ':visible']],
//                        ['extend' => 'pdfHtml5', 'text' => '<i class="fa fa-file-pdf-o" ></i> ' . trans('dataTable.btn.pdf'), 'className' => 'btn btn-info ', 'exportOptions' => ['columns' => [0, 1, 2, 5]]],
                    ],
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
                'name' => 'btn_name',
                'data' => 'btn_name',
                'title' => trans('labels.Name'),
            ],

            [
                'name' => 'btn_image',
                'data' => 'btn_image',
                'title' => trans('labels.Image'),
            ],
            [
                'name' => 'orders_products_type',
                'data' => 'orders_products_type',
                'title' => trans('labels.orders_products_type'),
            ],

            [
                'name' => 'customers_basket_date_added',
                'data' => 'customers_basket_date_added',
                'title' => trans('labels.customers_basket_date_added'),
            ],

            [
                'name' => 'customers_basket_quantity',
                'data' => 'customers_basket_quantity',
                'title' => trans('labels.customers_basket_quantity'),
            ],
            [
                'name' => 'final_price',
                'data' => 'final_price',
                'title' => trans('labels.final_price'),
            ],
  [
                'name' => 'sum_final_price',
                'data' => 'sum_final_price',
                'title' => trans('labels.sum_final_price'),
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
