<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;
use Illuminate\Http\Request;

class IsSubscriber
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
        $isSubscribed=$this->verifyCookie($request);
        $requestUrl=$request->path();
        if( !$isSubscribed ) return redirect("/customerLogin");
        return $next($request);
    }

    private function verifyCookie(Request $request):bool{
        if($request->cookie('userEmail') && $request->cookie('rememberToken') ){
            $email=$request->cookie('userEmail');
            $rememberToken=$request->cookie('rememberToken');
            $customer=Customer::where("email",$email)->first();
            if($customer->rememberToken==$rememberToken) return true;
        }
        return false;
    }
}
