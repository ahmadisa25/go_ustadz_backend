<?php

namespace App\Http\Middleware;

use Closure;
use Response;

class CORS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        header("Access-Control-Allow-Origin: http://localhost:3000");
        $headers = [
            'Access-Control-Allow-Methods' => 'GET, OPTIONS, POST',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Accept, Authorization, X-Requested-With'
        ];
        if($request->getMethod() === "OPTIONS"){
            return Response::make('OK', 200, $headers);
        }

        /*$response = $next($request);
        foreach($headers as $key => $value){
            $response->header($key, $value);
        }*/
        return $next($request);
    }
}
