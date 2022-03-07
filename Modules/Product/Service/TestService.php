<?php

namespace Modules\Product\Service;

use OneSignal;
class TestService {

    /**
     * @param $message
     * @param null $url
     * @param null $data
     * @param null $buttons
     * @param null $schedule
     * @param null $headings
     * @param null $subtitle
     */
    public function sendNotificationToAllUsers($message, $url = null, $data = null, $buttons = null, $schedule = null, $headings = null, $subtitle = null)
    {
        $params = [];
        $params['small_icon'] = "https://avatar-ex-swe.nixcdn.com/song/share/2020/04/07/2/4/d/d/1586256326775.jpg";
        $params['chrome_web_icon'] = "https://avatar-ex-swe.nixcdn.com/song/share/2020/04/07/2/4/d/d/1586256326775.jpg";
        OneSignal::addParams($params)->sendNotificationToAll(
            $message,
            $url,
            $data,
            $buttons,
            $schedule,
            $headings,
            $subtitle
        );
    }

    public function sendNotificationToSpecificUser($message, $userID, $url = null, $data = null, $buttons = null, $schedule = null)
    {
        OneSignal::sendNotificationToExternalUser(
            $message,
            $userID,
            $url,
            $data,
            $buttons,
            $schedule
        );
    }
}
