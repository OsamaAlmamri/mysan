<?php

namespace App\DataTables;

use App\Models\Core\Currency;
use App\Models\Core\Manufacturers;
use App\ViewCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Services\DataTable;

class ViewCategoriesDataTable extends DataTable
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
            ->addColumn('manage', 'admin.view_categories.btn.manage')
            ->addColumn('btn_sort', 'admin.sortFiles.btn_sort')
            ->editColumn('imagePath', function ($category) {
                return '<td><img src="' . asset($category->imagePath->imagesTHUMBNAIL->path) . '"  width="100px"></td>';
            })
            ->rawColumns([
                'btn_sort',
                'imagePath',
                'manage',
            ]);
    }


    public function query()
    {
        $data = ViewCategory::with(['imagePath' => function ($query) {
            $query->with(['imagesTHUMBNAIL']);
        }])
            ->orderBy('sort')->get();
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
                    'scrollX' => true,
                    'searching' => true,
                    'autoWidth' => false,
                    "createdRow" => "function (row, data, dataIndex) {
                                     $(row).addClass('row1');
                                     $(row).attr('data-id', data.id);

                                      }",
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
            [
                'name' => 'btn_sort',
                'data' => 'btn_sort',
                'title' => trans('labels.btn_sort')
            ],
            [
                'name' => 'id',
                'data' => 'id',
                'title' => trans('labels.ID')
            ],
//            ['name' => 'DT_RowIndex',
//                'data' => 'DT_RowIndex',
//                'title' => '#'],
            [
                'name' => 'name_ar',
                'data' => 'name_ar',
                'title' => trans('labels.name_ar'),
            ],
//            [
//                'name' => 'imagePath',
//                'data' => 'imagePath',
//                'title' => trans('labels.image'),
//            ],
            [
                'name' => 'name_en',
                'data' => 'name_en',
                'title' => trans('labels.name_en'),
            ],


            ['name' => 'parent',
                'data' => 'parent',
                'title' => trans('labels.parent'),
            ],
            ['name' => 'content',
                'data' => 'content',
                'title' => trans('labels.content'),
            ],
            [
                'name' => 'imagePath',
                'data' => 'imagePath',
                'title' => trans('labels.Image'),
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
