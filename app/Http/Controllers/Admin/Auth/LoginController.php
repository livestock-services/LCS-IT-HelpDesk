<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.adminLogin');
    }

    /**
     * Login the admin.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $this->validator($request);
    
        /*if(Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember'))){
            //Authentication passed...
            return redirect()
                ->intended(route('admin.home'))
                ->with('status','You are Logged in as Admin!');
        }    
        return $this->loginFailed();*/

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
            return redirect('admin/adminDashboard')->with('success', 'Welcome');   
        }
   
        return redirect()->back()->withInput($request->only('email', 'remember'));
        }
    }

    /**
     * Logout the admin.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
      //logout the admin...
        Auth::logout();
        return redirect()
            ->route('admin.login')
            ->with('status','Admin has been logged out!');
    }

    /**
     * Validate the form data.
     * 
     * @param \Illuminate\Http\Request $request
     * @return 
     */
    private function validator(Request $request)
    {
        $rules = [
            'email'    => 'required|email|exists:admins|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];    
        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];    
        //validate the request.
        $request->validate($rules,$messages);
    }

    /**
     * Redirect back after a failed login.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed()
    {
        return redirect()
            ->back()
            ->withInput()
            ->with('error','Login failed, please try again!');
        //Login failed...
    }
}
