<?php

namespace App\Http;

class Response
{
    public static function getData(array $data, int $code = 200): string
    {
        return json_encode(['data' => $data, 'code' => $code], JSON_PRETTY_PRINT);
    }
}