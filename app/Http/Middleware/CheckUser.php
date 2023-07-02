<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
//        this one return array
//        dd(func_get_args()); access to the $role parameter without declare $role or any variable
//        func_get_args return our parameter and some useless data so we dont need them
//          so that we use array_slice with offset 2, to slice that 2 junk data
//        dd(array_slice(func_get_args(), 2));
        if (auth()->user()->id != 1){
            if ($role == "bill"){
                $response = $next($request);
                $content = $response->getContent();

                return $response->setContent($content);
            }

        }
        return response()->json('eres amir, no puedes entrar!!!');
    }

}
