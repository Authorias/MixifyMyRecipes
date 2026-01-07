<?php

namespace App\Http\Controllers\Api;

use Symfony\Component\HttpFoundation\Response;

class JsonResponse
{
    public static function success($data, $statusCode = Response::HTTP_OK) {
        return $data !== null && self::isArrayOrCollection($data)
            ? response()->json(
                [
                    'data' => $data,
                    'total' => count($data),
                ], 
                $statusCode
              )
            : response()->json(['data' => $data], $statusCode);
    }

    public static function error($message, $statusCode, $errorCode = 0) {
        return response()->json(
            ['error' => $message, 'code' => $errorCode], 
            $statusCode
        );
    }

    private static function isArrayOrCollection($data) {
        return (is_array($data) && array_is_list($data)) 
            || is_a($data, 'Illuminate\Database\Eloquent\Collection');
    }   
}