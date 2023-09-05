<?php
namespace App\Helpers;

class AlertFormatter{
    public static $data =
    ["alert" => [
        "type" => "danger",
        "message" => null
    ]];

    public static function success(string $message) : array
    {
        self::$data['alert']['type'] = "success";
        self::$data['alert']['message'] = $message;
        return self::$data;
    }
    public static function danger(string $message) : array
    {
        self::$data['alert']['type'] = "danger";
        self::$data['alert']['message'] = $message;
        return self::$data;
    }
}
