<?php


namespace App\Services;


class SmsSender
{
    public function sendSMS($mobile, $message)
    {
        return ['success' => true, 'message' => 'SMS Send Successfully'];
    }
}
