<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUsers = User::all();
        return view('userManagement.index')->with('allUsers', $allUsers);
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

    private function getUserQueries($userId){
        $queries = DB::table('queries')           
            ->where('userId','=', $userId)
            ->where('queryType','=', 1 )
            ->limit(5)               
            ->select('*')
            ->get();
        return $queries;
    }
    
    public function show($id)
    {
        $userDetails = User::find($id);        
        $userQueries = $this->getUserQueries($id);
        
        return view('userManagement.show')->with('userDetails',$userDetails)->with('userQueries', $userQueries);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userDetails = User::find($id);
        return view('userManagement.edit')->with('userDetails',$userDetails);
    }

    public function resetUserPassword($id){
        $userDetails = User::find($id);
        //print($userDetails);
        return view('userManagement.userChangePassword')->with('userDetails',$userDetails);
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
