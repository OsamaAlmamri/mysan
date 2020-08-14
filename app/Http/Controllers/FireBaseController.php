<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Support\Facades\DB;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Laravel\Firebase\Facades\FirebaseAuth;


class FireBaseController extends Controller
{
    public function __construct()
    {
        $this->factory = (new Factory)->withServiceAccount(__DIR__ . '/halaalmadi-e8464-firebase-adminsdk-pbdkt-04d363344c.json');

    }

    public function index()
    {
        $messaging = $this->factory->createMessaging();
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


    public function oneDevice($deviceToken,$dataToNotification)
    {

        $messaging = $this->factory->createMessaging();
        $data =$dataToNotification;
          $notification = Notification::fromArray([
            'title' => $dataToNotification['sender_name'],
            'body' => $dataToNotification['message'],
            'image' => $dataToNotification['sender_image'],
        ]);
        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification($notification) // optional
            ->withData($data) // optional
        ;
//        return dd($dataToNotification);
        $sendReport = $messaging->sendMulticast($message, [$deviceToken]);

//       $r= $messaging->send($message);
    }

    public function getNotifiableUsers($user = 0,  $admins = [])
    {
        $tokens = [];
        $devices = DB::table('devices')
            ->where(function ($query) use ($user) {
                $query->where('user_type', 'like', 'user')
                    ->where('user_id', $user);
            })
            ->orWhere(function ($query) use ($admins) {
                $query->where('user_type', 'like', 'admin')
                    ->whereIn('user_id', $admins);
            })->get();
        foreach ($devices as $device)
            $tokens[] = $device->device_token;
        return $tokens;


    }

    public function multi($deviceTokens, $dataToNotification)
    {
        $messaging = $this->factory->createMessaging();
        $title = 'My Notification Title';
        $body = 'My Notification Body';
        $imageUrl = 'http://lorempixel.com/400/200/';
        $notification = Notification::fromArray([
            'title' => $dataToNotification['sender_name'],
            'body' => $dataToNotification['message'],
            'image' => $dataToNotification['sender_image'],
        ]);
        $message = CloudMessage::new()->withNotification($notification) // optional
        ->withData($dataToNotification);
        if (count($deviceTokens) > 0)
            $sendReport = $messaging->sendMulticast($message, $deviceTokens);
    }

//
//    public function getToken()
//    {
////        $factory = (new Factory)->withServiceAccount(__DIR__ . '/aldarobi-3a625-firebase-adminsdk-v49yq-e9f27e8aa3.json');
//
//        /** @var \Kreait\Firebase\Auth $auth */
//        $auth = app('firebase.auth');
////        $uid = $authz;
//        return $auth->createCustomToken("ali2");
//        $customToken = $auth->createCustomToken($uid);
//        return response()->json($customToken);
//    }
}

