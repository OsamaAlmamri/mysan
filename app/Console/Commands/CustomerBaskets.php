<?php

namespace App\Console\Commands;

use App\Http\Controllers\FireBaseController;
use App\tempStorage;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CustomerBaskets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'basketNotification:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send notification to customer to remember it ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $data = DB::table('devices')
            ->leftJoin('users', 'devices.user_id', '=', 'users.id')
            ->select('devices.*',
                DB::raw("(CONCAT( COALESCE(users.first_name,' ') , ' ' ,COALESCE(users.last_name,' ') )) as customer"),
                DB::raw("(SELECT sum(customers_basket_quantity) FROM customers_basket WHERE customers_basket.customers_id=devices.user_id  ) as all_quantity"),
                DB::raw("(SELECT (Reports.customers_basket_date_added) FROM customers_basket as Reports WHERE Reports.customers_id=devices.user_id ORDER BY  Reports.customers_basket_date_added DESC LIMIT 1  ) as last_date_added"),
                )
            ->whereIn('user_id', function ($query) {
                $query->select('customers_id')
                    ->from('customers_basket')
                    ->whereDate('customers_basket_date_added', '<=', Carbon::today()->addDays(-4)->toDateString());
                // if product in basket more than ... day
            })
            ->whereDate('last_basket_notification_date', '>=', Carbon::today()->addDays(-3)->toDateString())
            //repate notification all week
            ->get();
        $fireBase = new FireBaseController();
        foreach ($data as $device) {
            $message = '  مرحبا ' . $device->customer . ' يوجد لديك  ' . $device->all_quantity . ' منتجات متواجدة بالسلة منذ  ' . $device->last_date_added;
            $dataToNotification = array(
                'sender_name' => setting('app_name', trans('labels.get_site_name')),
                'user_id' => $device->user_id,
                'sender_image' => HostUrl(setting('website_logo', ('images\logo.png'))),
                'message' => $message,
                'date' => Carbon::today()->toDateString()
            );
            $fireBase->oneDevice($device->device_id, $dataToNotification);
        }

        $this->info('send notification sucessfuly');
    }
}
