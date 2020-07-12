<?php

namespace App\Http\Controllers;

use App\Models\Core\Device;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;


class FireBaseController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {

        $factory = (new Factory)->withServiceAccount(__DIR__ . '/aldarobi-3a625-firebase-adminsdk-v49yq-e9f27e8aa3.json');
        $messaging = $factory->createMessaging();
//        $messaging = app('firebase.messaging');


//        $message = CloudMessage::withTarget(/* see sections below */)
//            ->withNotification(Notification::create('Title', 'Body'))
//            ->withData(['key' => 'value']);

        $topic = 'a-topic';
        $notification = ['d' => 'd'];
        $data = ['ddd' => 'd'];
        $message = CloudMessage::withTarget('topic', $topic)
            ->withNotification($notification) // optional
            ->withData($data) // optional
        ;
//
//        $message = CloudMessage::fromArray([
//            'topic' => $topic,
//            'notification' => [/* Notification data as array */], // optional
//            'data' => [/* data array */], // optional
//        ]);

        $messaging->send($message);

//        $condition = "'TopicA' in topics && ('TopicB' in topics || 'TopicC' in topics)";
//
//        $message = CloudMessage::withTarget('condition', $condition)
//            ->withNotification($notification) // optional
//            ->withData($data) // optional
//        ;
//
//        $message = CloudMessage::fromArray([
//            'condition' => $condition,
//            'notification' => [/* Notification data as array */], // optional
//            'data' => [/* data array */], // optional
//        ]);

        $messaging->send($message);


        $messaging->send($message);

    }


    public function oneDevice()
    {
        $deviceToken = 'cZSwh1vyZ_VcUJHNYCaE9U:APA91bHPzsOKesAw5coYfZaAhEDS9v3bLTP4lCA1qu2PWVuathmOvKoxo_BN-Hjt66H2Z8MjamHAQaoUTGc8U1piLmU8m8nEPeuWVzCCF3V_y4F-uJWT3Mk6zRrofeY15de7L4HTUfwk';
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/aldarobi-3a625-firebase-adminsdk-v49yq-e9f27e8aa3.json');
        $messaging = $factory->createMessaging();
        $title = 'My Notification Title';
        $body = 'My Notification Body';
        $imageUrl = 'http://lorempixel.com/400/200/';
        $notification = Notification::fromArray([
            'title' => $title,
            'body' => $body,
            'image' => $imageUrl,
            'image3' => $imageUrl,
            'image7' => $imageUrl,
        ]);

        $data = [
            'first_key' => 'First Value',
            'second_key' => 'Second Value',
        ];

        $notification = Notification::create($title, $body);

        $changedNotification = $notification
            ->withTitle('Changed title')
            ->withBody('Changed body')
            ->withImageUrl('http://lorempixel.com/200/400/');
        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification($notification) // optional
            ->withData($data) // optional
        ;

//        $message = CloudMessage::fromArray([
//            'token' => $deviceToken,
//            'notification' => [/* Notification data as array */], // optional
//            'data' => [/* data array */], // optional
//        ]);

        $messaging->send($message);
    }

    public function getNotifiableUsers($user = 0, $customer = 0, $admins = [])
    {
        $tokens = [];
        $devices = DB::table('devices')
            ->where(function ($query) use ($user) {
                $query->where('user_type', 'like', 'user')
                    ->where('user_id', $user);
            })
            ->orWhere(function ($query) use ($customer) {
                $query->where('user_type', 'like', 'customer')
                    ->where('user_id', $customer);
            })->orWhere(function ($query) use ($admins) {
                $query->where('user_type', 'like', 'admin')
                    ->whereIn('user_id', $admins);
            })->get();
        foreach ($devices as $device)
            $tokens[] = $device->device_token;
        return $tokens;


    }

    public function multi($deviceTokens, $dataToNotification)
    {
        $factory = (new Factory)->withServiceAccount(__DIR__ . '/aldarobi-3a625-firebase-adminsdk-v49yq-e9f27e8aa3.json');
        $messaging = $factory->createMessaging();
        $title = 'My Notification Title';
        $body = 'My Notification Body';
        $imageUrl = 'http://lorempixel.com/400/200/';
        $notification = Notification::fromArray([
            'title' => $dataToNotification['sender_name'],
            'body' => $dataToNotification['message'],
            'image' => HostUrl('images\s_logo.png'),
        ]);
//        $notification = Notification::create($dataToNotification['sender_name'], $body);
        $changedNotification = $notification
            ->withTitle('Changed title')
            ->withBody('Changed body')
            ->withImageUrl(HostUrl('images\s_logo.png'));
        $message = CloudMessage::new()->withNotification($notification) // optional
        ->withData($dataToNotification);
        $sendReport = $messaging->sendMulticast($message, $deviceTokens);
    }

}

