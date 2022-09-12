<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /*if(Auth::user()->changed_password == 1){   
            return redirect()->route('userChangePassword.edit')->with('success','Please Update Your Password');         
            /*if(['auth']){
                return redirect()->route('userChangePassword.edit')->with('success','Please Update Your Password');
            }else{
                return redirect()->route('/adminChangePassword/edit')->with('success','Please Update Your Password');
            }         
        }*/       
        return $next($request);
    }
}
