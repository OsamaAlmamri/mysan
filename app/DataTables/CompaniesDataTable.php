<?php

namespace App\DataTables;

use App\Models\Core\Currency;
use App\Models\Core\Manufacturers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Services\DataTable;

class CompaniesDataTable extends DataTable
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
            ->addColumn('manage', 'admin.manufacturers.btn.manage')
            ->addColumn('btn_info', 'admin.manufacturers.btn.info')
            ->addColumn('btn_image', 'admin.manufacturers.btn.image')
            ->rawColumns([
                'manage',
                'btn_info',
                'btn_image',
            ]);
    }


    public function query()
    {
        $manufacturers = DB::table('manufacturers')
            ->leftJoin('manufacturers_info', 'manufacturers_info.manufacturers_id', '=', 'manufacturers.manufacturers_id')
            ->leftJoin('images', 'images.id', '=', 'manufacturers.manufacturer_image')
            ->leftJoin('image_categories', 'image_categories.image_id', '=', 'manufacturers.manufacturer_image')
            ->select('manufacturers.manufacturers_id as id', 'manufacturers.manufacturer_image as image',
                'manufacturers.manufacturer_name as name', 'manufacturers_info.manufacturers_url as url',
                'manufacturers_info.url_clicked', 'manufacturers_info.date_last_click as clik_date', 'image_categories.path as path')
            ->where('manufacturers_info.languages_id', '1')
            ->where('image_categories.image_type', '=', 'THUMBNAIL' or 'image_categories.image_type', '=', 'ACTUAL')->get();
        return $manufacturers;
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
        $route = URL::to('admin/manufacturers/add');

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
//                    'scrollX' => true,
                    'searching' => true,
                    'autoWidth' => true,
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
            ['name' => 'id',
                'data' => 'id',
                'title' => trans('labels.ID')],
//            ['name' => 'DT_RowIndex',
//                'data' => 'DT_RowIndex',
//                'title' => '#'],
            [
                'name' => 'name',
                'data' => 'name',
                'title' => trans('labels.Name'),
            ],
            [
                'name' => 'btn_image',
                'data' => 'btn_image',
                'title' => trans('labels.Image'),
            ],
            [
                'name' => 'btn_info',
                'data' => 'btn_info',
                'title' => trans('labels.OtherInfo'),
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
