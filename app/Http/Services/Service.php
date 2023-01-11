<?php

namespace App\Http\Services;

use App\Http\Utils\ResponseUtil;
use Illuminate\Http\JsonResponse;

class Service
{
    public function sendSuccess($result, $message,$code = 200): JsonResponse
    {
        return response()->json(ResponseUtil::makeResponse($message, $result), $code);
    }

    public function sendError($error, $code = 404) : JsonResponse
    {
        return response()->json(ResponseUtil::makeError($error), $code);
    }

}
