<?php

namespace Modules\Product\Http\Controllers;

use Berkayk\OneSignal\OneSignalClient;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Service\TestService;

class NotificationController extends Controller
{

    public function sendNotificationToAll()
    {
        $onesignal = new OneSignalClient(config("ONESIGNAL_APP_ID"), config("ONESIGNAL_REST_API_KEY"), "");;
        dd($onesignal);
        (new \Modules\Product\Service\TestService($onesignal))->sendNotificationToAllUsers();
    }
}
