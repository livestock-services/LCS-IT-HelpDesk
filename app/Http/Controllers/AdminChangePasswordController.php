<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminChangePasswordController extends Controller
{
   
    public function edit()
    {
        $userId= auth()->user()->id;
        $userDetails = Admin::find($userId);
        //print($userDetails);
        return view('adminUpdatePassword.edit')->with('userDetails',$userDetails);
    }
   
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed'
        ]);
        //print($request->input('password'));
        //Controller::updateOwnPassword($request->input('password'), $id);
        $updateUserDetails = Admin::find($id);
        $updateUserDetails->password = bcrypt($request->input('password'));
        $updateUserDetails->changed_password = False;
        $updateUserDetails->save();

        return redirect()->back()->with('success','Updated Successfully');
    }    
}
