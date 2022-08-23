<?php

namespace App\Http\Middleware;
use App;

use Closure;
use Illuminate\Http\Request;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $language = \Session::get('website_language',config('app.locale'));
        if ($language) {
            config(['app.locale' => $language]);
        }
        
        $response =  $next($request);    
        
        // Chuyển ứng dụng sang ngôn ngữ được chọn
        return $response;
    }
}
