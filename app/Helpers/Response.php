<?php

use Illuminate\Support\Str;

if (!function_exists('abortJson')) {
    function abortJson(int $code = 401, string $message, $data = []) : object
    {
        return jsonPlug($code, "error", $message, $data);
    }
}

if (!function_exists('sendJson')) {
    function sendJson(string $message, $data) : object
    {
        return jsonPlug(200, "success", $message, $data);
    }
}

if (!function_exists('jsonPlug')) {
    function jsonPlug(int $code, string $status, string $message, $data ) : object
    {
        return response()->json([
            'status'    => $status,
            'message'   => $message,
            'data'      => $data
        ], $code);
    }
}

if (!function_exists('defaultSlug')) {
    function defaultSlug($text, $seperator = '-') : string
    {
        return str_slug($text, $seperator) .'-'. Str::random(15);
    }
}




