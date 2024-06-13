<?php

namespace App\Exceptions;

use Exception;

class RateLimitExceededException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'error' => 'Too Many Requests',
            'message' => 'You have exceeded the rate limit.',
        ], 429);
    }
}
