<?php

namespace App\DataTables;

use App\Models\Core\Reviews;
use Yajra\DataTables\Services\DataTable;

class ReviewsDataTable extends DataTable
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
            ->addColumn('manage', 'admin.reviews.btn.manage')
            ->addColumn('btn_id', 'admin.reviews.btn.id')
            ->rawColumns(['manage', 'btn_id']);
    }


    public function query()
    {

//        $data = Reviews::all();
//
//        return dd($data)  ;
//
        $reviews = Reviews::sortable(['reviews_id' => 'desc'])
            ->leftJoin('reviews_description', 'reviews.reviews_id', 'reviews_description.review_id')
            ->leftJoin('products_description', 'reviews.products_id', 'products_description.products_id')
            ->select('reviews.*', 'products_description.products_name')
            ->groupBy('reviews.reviews_id');
        return $reviews;

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
//
            [
                'name' => 'btn_id',
                'data' => 'btn_id',
                'title' => trans('labels.ID'),
            ], [
                'name' => 'products_name',
                'data' => 'products_name',
                'title' => trans('labels.products_name'),
            ], [
                'name' => 'reviews_text',
                'data' => 'reviews_text',
                'title' => trans('labels.reviews_text'),
            ], [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => trans('labels.Date'),
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
