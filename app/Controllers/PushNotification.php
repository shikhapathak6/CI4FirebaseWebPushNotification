<?php

namespace App\Controllers;

class PushNotification extends BaseController
{
    public function index()
    {
        return view('push_notification');
    }
    public function sendPushNotification()
    {
        $token = $this->request->getPost('token');
        $url = 'https://fcm.googleapis.com/fcm/send';

        /*api_key available in:
        Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/
        //change api key with your api key
        $api_key = '<YOUR SERVER KEY';

        $fields = array(
            'to' => $token,
            'notification' => array(
                "title" => "Hello World !",
                "body" => "This is my First Notification."
            ),

        );

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $api_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        return $result;
        curl_close($ch);
    }
}
