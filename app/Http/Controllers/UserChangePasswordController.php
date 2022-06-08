<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\False_;

class UserChangePasswordController extends Controller
{
    
    public function edit()
    {
        $userId= auth()->user()->id;
        $userDetails = User::find($userId);
        //print($userDetails);
        return view('userUpdatePassword.edit')->with('userDetails',$userDetails);
        //
    }
  
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|min:6|confirmed'
        ]);
        //print($request->input('password'));
        //Controller::updateOwnPassword($request->input('password'), $id);
        $updateUserDetails = User::find($id);
        $updateUserDetails->password = bcrypt($request->input('password'));
        $updateUserDetails->changed_password = False;
        $updateUserDetails->save();

        return redirect()->back()->with('success','Updated Successfully');
    }
    
}
