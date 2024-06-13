<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EncryptUrls
{
    public function handle($request, Closure $next)
    {
          // Check if the current URL should not be encrypted
        if ($request->fullUrl() === 'https://spiresrecruit.com/find_jobs') {
            return $next($request);
        }

        // Encrypt the URL for all other requests
        $encryptedUrl = Crypt::encrypt($request->fullUrl());

        // Modify the request to use the encrypted URL
        $request->server->set('REQUEST_URI', $encryptedUrl);

        return $next($request);
    }
}
