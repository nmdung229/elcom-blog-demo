<?php

namespace Modules\Product\Service;

interface NotificationService
{
    public function sendNotificationToAllUsers();

    public function sendNotificationToSpecificUser();

}
