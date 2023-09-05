<?php
namespace App\Helpers;

class JsonFormatter{
    public static $format = [
        "meta" => [
            "code" => 200,
            "status" => true,
            "message" => null,
        ],
        "data" => null
    ];

    public static function success($data, ?String $message = "", ?int $code = 200)
    {
        self::$format["meta"]["code"] = $code;
        self::$format["meta"]["status"] = true;
        self::$format["meta"]["message"] = $message;
        self::$format["data"] = $data;
        return response()->json(self::$format, $code);
    }
    public static function error(String $message = "", $data=null, ?int $code = 400)
    {
        self::$format["meta"]["code"] = $code;
        self::$format["meta"]["status"] = false;
        self::$format["meta"]["message"] = $message;
        self::$format["data"] = $data;
        return response()->json(self::$format, $code);
    }
}
