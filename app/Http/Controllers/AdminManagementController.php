<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminUsers = Admin::all();
        return view("adminManagement.index")->with('adminUsers', $adminUsers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function register(){
        return view('admin.auth.register');
    }

    public function registerAdmin(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'manNumber' => 'required',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed'
        ]);

        $adminUser = new Admin();
        $adminUser->name = $request->input('name');
        $adminUser->email= $request->input('email');
        $adminUser->manNumber = $request->input('manNumber');
        $adminUser->password = bcrypt($request->input('password'));
        $adminUser->save();        
        
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userDetails = Admin::find($id);        
        $userAssignedQueries = Controller::getAdminAssignedorClearedQueries(2,$id);
        $countUserAssignedQueries = count($userAssignedQueries);     
                
        return view('adminManagement.show')->with('userAssignedQueries', $userAssignedQueries)->with('userDetails',$userDetails)->with('userAssignedQueries', $userAssignedQueries)->with('countUserAssignedQueries',$countUserAssignedQueries);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
