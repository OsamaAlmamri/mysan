<?php

namespace App\DataTables;

use App\Models\Core\Reviews;
use App\Models\Core\User;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Services\DataTable;

class CustomersDataTable extends DataTable
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
            ->addColumn('manage', 'admin.customers.btn.manage')
            ->addColumn('info', 'admin.customers.btn.info')
//            ->addColumn('image', 'admin.customers.btn.image')
            ->addColumn('address', 'admin.customers.btn.address')
            ->rawColumns(['manage', 'info', 'address']);
    }


    public function query()
    {

        $user = DB::table('users')
            ->LeftJoin('user_to_address', 'user_to_address.user_id', '=', 'users.id')
            ->LeftJoin('address_book', 'address_book.address_book_id', '=', 'user_to_address.address_book_id')
            ->LeftJoin('countries', 'countries.countries_id', '=', 'address_book.entry_country_id')
            ->LeftJoin('zones', 'zones.zone_id', '=', 'address_book.entry_zone_id')
            ->where('role_id', 2)
            ->select('users.*', 'address_book.entry_company as entry_company',
                'address_book.name as name',
                'address_book.entry_street_address as entry_street_address', 'address_book.entry_suburb as entry_suburb',
                'address_book.entry_city as entry_city',
                'address_book.entry_state as entry_state', 'countries.*', 'zones.*')
            ->groupby('users.id')->get();
        $result = array();
        $index = 0;
        foreach ($user as $customers_data) {
            array_push($result, $customers_data);
            $devices = DB::table('devices')->where('user_id', '=', $customers_data->id)->orderBy('created_at', 'DESC')->take(1)->get();
            $result[$index]->devices = $devices;
            $index++;
        }
        return $user;

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
            [
                'name' => 'id',
                'data' => 'id',
                'title' => trans('labels.ID'),
            ],
            [
                'name' => 'first_name',
                'data' => 'first_name',
                'title' => trans('labels.Full Name'),
            ],
            [
                'name' => 'email',
                'data' => 'email',
                'title' => trans('labels.Email'),
            ], [
                'name' => 'info',
                'data' => 'info',
                'title' => trans('labels.Additional info'),
            ], [
                'name' => 'address',
                'data' => 'address',
                'title' => trans('labels.Address'),
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
