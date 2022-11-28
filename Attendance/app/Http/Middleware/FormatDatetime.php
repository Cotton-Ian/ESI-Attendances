<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FormatDatetime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $date_name = 'date')
    {
        $response = $next($request);

        $content = $response -> getOriginalContent();
        foreach($content -> lessons as $lesson){
            $date = date_create($lesson -> date);
            $lesson -> date = $date -> format('d F Y - G\h i');
        }
        $response -> setContent($content);

        return $response;
    }
}
