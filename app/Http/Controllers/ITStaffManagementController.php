<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ITStaffManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function showITStaffMember($staffMemberId){

        $staffMemberQueries = DB::table('admins')
            ->join('query_assigned_to_tech_personels','admins.id','=','query_assigned_to_tech_personels.itPersonelId')
            ->join('queries','query_assigned_to_tech_personels.queryId','=','queries.id')
            ->join('users','queries.userId','=','users.id')
            ->where('admins.id','=',$staffMemberId)
            //->where('','=','')
            ->select('admins.name as admin','users.name','queries.queryDetails','queries.subCategory')
            ->get();
        //return $staffMemberQueries;

        return view("iTStaffManagement.showItStaffMember")->with('staffMemberQueries', $staffMemberQueries);
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
    public function show($id)
    {
        //
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
