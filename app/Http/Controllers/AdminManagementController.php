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
        $userId  = Controller::getUserIdFromManNumber($request->input('manNumber')); 
        $userRole = 'Admin';      
        $this->assignAdminRole($userId,$userRole);

        return redirect()->back();
    }

    private function deleteUserRole($userId){
        $user = Admin::find($userId);
        DB::table('model_has_roles')
            ->where('model_id',$userId)
            ->delete();        
        return $user;
    }

    private function assignAdminRole($userId,$userRole){
        $getUser = Admin::find($userId);
        $getUser->assignRole($userRole);
        return $getUser;
    }

    /*private function getUserIdFromManNumber($manNumber){
        $getUserId = DB::table('admins')
            ->where('manNumber','=',$manNumber)
            ->select('id')
            ->get();
        $userId = $getUserId[0]->id;
        return $userId;
    }*/

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
        $adminDetails = Admin::find($id);        
        $userAssignedQueries = Controller::getAdminAssignedorClearedQueries(2,$id);
        $countUserAssignedQueries = count($userAssignedQueries);     
                
        return view('adminManagement.show')->with('userAssignedQueries', $userAssignedQueries)->with('adminDetails',$adminDetails)->with('userAssignedQueries', $userAssignedQueries)->with('countUserAssignedQueries',$countUserAssignedQueries);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adminDetails = Admin::find($id);
        $usersRole = $adminDetails->getRoleNames()[0];       
        $roles = Controller::getAllRoles();
        return view('adminManagement.edit')->with('usersRole',$usersRole)->with('roles',$roles)->with('adminDetails',$adminDetails);
    }

    public function resetAdminPassword($id){
        $adminDetails = Admin::find($id);
        //print($adminDetails);
        return view('adminManagement.adminChangePassword')->with('adminDetails',$adminDetails);
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
        $this->validate($request, [
            'name' => 'required',
            'manNumber' => 'required',
            'email' => 'required|email|max:255',
            'userRole' => 'required'
        ]);        
        $updateAdminDetails = Admin::find($id);
        $updateAdminDetails->name = $request->input('name');
        $updateAdminDetails->manNumber = $request->input('manNumber');
        $updateAdminDetails->email = $request->input('email');
        $updateAdminDetails->save();
        $this->deleteUserRole($id);
        $this->assignAdminRole($id,$request->input('userRole'));
        return redirect()->back();
    }

    public function updatePassword(Request $request, $id){

        $this->validate($request, [
            'password' => 'required|min:6|confirmed'
        ]);   
        
        $updateAdminDetails = Admin::find($id);
        $updateAdminDetails->password = bcrypt($request->input('password'));
        $updateAdminDetails->changed_password = True;
        $updateAdminDetails->save();

        return redirect()->back();
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
