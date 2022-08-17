<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        $isAdmin=$this->isAdmin($request);
        $requestUrl=$request->path();
        if( !$isAdmin ) return redirect("/customerLogin");
        return $next($request);
    }

    private function isAdmin(Request $request):bool{
        if($request->cookie('userEmail') && $request->cookie('rememberToken') ){
            $email=$request->cookie('userEmail');
            $rememberToken=$request->cookie('rememberToken');
            $customer=Customer::where("email",$email)->first();
            if($customer->rememberToken==$rememberToken && $customer->isAdmin) return true;
        }
        return false;
    }
}
