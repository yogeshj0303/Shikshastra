<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class RecordVisitor
{
    public function handle($request, Closure $next)
    {
        // Check if the visitor has a unique identifier in the session.
        $visitorIdentifier = Session::get('visitor_identifier');

        if (!$visitorIdentifier) {
            // Generate a unique identifier for the visitor.
            $visitorIdentifier = Str::uuid()->toString();

            // Store the identifier in the session.
            Session::put('visitor_identifier', $visitorIdentifier);

            // Record the unique visitor in the database.
            Visitor::create([
                'ip_address' => $visitorIdentifier,
            ]);
        }

        return $next($request);
    }
}
