<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Session;
class VisitorController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function getVisitorCount(Request $request)
    {
        if (!$request->cookie('visitorId')) {
            // If no identifier exists, increment the visitor count and set a cookie
            $visitorCount = Cache::remember('visitorCount', now()->addHour(), function () {
                return DB::table('visitors')->count();
            });

            $visitorCount++;
            $response = response()->json(['visitorCount' => $visitorCount]);
            $response->cookie('visitorId', str_random(32), 60); // Cookie expires in 60 minutes

            return $response;
        } else {
            // If the visitor has an identifier, just return the current count
            $visitorCount = Cache::get('visitorCount');
            return response()->json(['visitorCount' => $visitorCount]);
        }
    }
}
