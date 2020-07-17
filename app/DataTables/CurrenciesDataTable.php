<?php

namespace App\DataTables;

use App\Models\Core\Currency;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Services\DataTable;

class CurrenciesDataTable extends DataTable
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
            ->addColumn('btn_id', 'admin.currencies.btn.id')
            ->addColumn('manage', 'admin.currencies.btn.manage')
            ->addColumn('btn_posisttion', 'admin.currencies.btn.posisttion')
            ->addColumn('posisttion_trans', 'admin.currencies.btn.posisttion_trans')
            ->rawColumns([
                'manage',
                'btn_posisttion',
                'posisttion_trans',
                'btn_id',
            ]);
    }


    public function query()
    {
        $data = Currency::all()->where('is_current', 1);
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
        $route =URL::to('admin/currencies/add');

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
//                    'responsive' => true,
                    'scrollX' => true,
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
            ['name' => 'DT_RowIndex',
                'data' => 'DT_RowIndex',
                'title' => '#'],
            [
                'name' => 'btn_id',
                'data' => 'btn_id',
                'title' => trans('labels.ID'),
            ],
            [
                'name' => 'title',
                'data' => 'title',
                'title' => trans('labels.Title'),
            ],

            [
                'name' => 'code',
                'data' => 'code',
                'title' => trans('labels.code'),
            ],

            [
                'name' => 'btn_posisttion',
                'data' => 'btn_posisttion',
                'title' => trans('labels.symbol'),
            ],

            [
                'name' => 'posisttion_trans',
                'data' => 'posisttion_trans',
                'title' => trans('labels.Position'),
            ],

            [
                'name' => 'decimal_places',
                'data' => 'decimal_places',
                'title' => trans('labels.decimal_places'),
            ],

            [
                'name' => 'value',
                'data' => 'value',
                'title' => trans('labels.value'),
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
