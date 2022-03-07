<?php

namespace App\Http\Controllers;

use Berkayk\OneSignal\OneSignalClient;
use Illuminate\Http\Request;
use Modules\Product\Service\TestService;
use OneSignal;
class NotificationController extends Controller
{
    protected $oneSignalService;

    public function __construct(TestService $oneSignalService)
    {
        $this->oneSignalService = $oneSignalService;
    }

    public function sendNotiToAll()
    {
        $msg = "New message add image";
        $url = "https://zingnews.vn/";
        $data = array(
            "foo" => "bar"
        );
        $buttons = [
            [
                "id" => "like-button-2",
                "text" => "1sk Button",
                "icon" => "http://i.imgur.com/N8SN8ZS.png",
                "url" => "https://kenh14.vn/"
            ]
        ];
        $headings = "Elcom headings";
        $this->oneSignalService->sendNotificationToAllUsers($msg, $url, $data, $buttons,"", $headings, "");
        dd("sent!");
    }
}
