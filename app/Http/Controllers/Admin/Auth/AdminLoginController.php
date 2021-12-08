<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    
    protected $redirectTo = '/';

    public function showAdminLoginForm()
    {        
        return view('admin.auth.adminLogin');
    }

    public function login(Request $request)
    {

        if ((Auth::guard('web')->check())) {
            return redirect('/mistake')->with('error', 'Please logout first');       
         }else{
        $this->validate($request, [
            'email' => 'required|email',
            'password'=>'required|min:6',
        ]);
   
        if (Auth::guard('admin')->attempt([   
            'email'=>$request->email,   
            'password'=>$request->password   
        ], $request->remember)){            
            return redirect('/home')->with('success', 'Welcome');   
        }
   
        return redirect()->back()->withInput($request->only('email', 'remember'));
        }
    }

    public function logout(){
   
        Auth::guard('council')->logout();
        //die;
        return redirect('council/login');
   
    }
}
