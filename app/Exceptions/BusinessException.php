<?php

namespace App\Exceptions;

use Exception;

class BusinessException extends Exception
{
    public function BusinessException(string $message): Response
    {
        $status = 500;
        return response(["error" => $message], $status);
    }
}
