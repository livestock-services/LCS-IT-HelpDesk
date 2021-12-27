<?php

namespace App\Http\Controllers;

use App\Models\Query;
use App\Models\QueryAssignedToTechPersonel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminQueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function indexNewQueries()
    {
        //$userId= auth()->user()->id;
        //$queries = Query::find($userId);
        $queries = DB::table('queries')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('query_categories','sub_categories.categoryId','=','query_categories.id')
            ->join('users','queries.userId','=','users.id')
            ->where('queries.queryType','=', 1 )
            ->select('users.email','users.name','queries.id','queries.priorityCode','queries.queryDetails','query_categories.categoryName','query_categories.categoryDescription','sub_categories.subCategoryDescription')
            ->get();
        return view("adminQueryManager.index")->with('queries',$queries);
    }

    public function indexAssingedQueries()
    {
        //$userId= auth()->user()->id;
        //$queries = Query::find($userId);
        $queries = DB::table('queries')
                ->join('query_assigned_to_tech_personels','queries.id','=','query_assigned_to_tech_personels.queryId')
                ->join('admins','query_assigned_to_tech_personels.itPersonelId','=','admins.id')
                ->join('sub_categories','queries.subCategory','=','sub_categories.id')
                ->join('users','queries.userId','=','users.id')
                ->where('queries.queryType','=', 2 )
                ->select('users.email','users.name','queries.id','admins.id','queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
                ->get();
        return view("adminQueryManager.assingedAndClearedQueries")->with('queries',$queries);
    }

    public function indexClearedQueries()
    {
        //$userId= auth()->user()->id;
        //$queries = Query::find($userId);
        $queries = DB::table('queries')
            ->join('query_assigned_to_tech_personels','queries.id','=','query_assigned_to_tech_personels.queryId')
            ->join('admins','query_assigned_to_tech_personels.itPersonelId','=','admins.id')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('users','queries.userId','=','users.id')
            ->where('queries.queryType','=', 3 )
            ->select('users.email','users.name','queries.id','admins.id','queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
            ->get();
        return view("adminQueryManager.assingedAndClearedQueries")->with('queries',$queries);
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

        $queries = DB::table('queries')
        //->join('query_assigned_to_tech_personels','queries.id','=','query_assigned_to_tech_personels.queryId')                
        ->join('sub_categories','queries.subCategory','=','sub_categories.id')
        ->where('queries.id','=', $id)
        ->select('queries.queryType','queries.id','queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
        ->get();
    
        return view("adminQueryManager.show")->with('queries',$queries);
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

    public function assignQuery($queryId, $adminId){
        $newQuery = new QueryAssignedToTechPersonel;
        $newQuery->queryId = $queryId;
        $newQuery->itPersonelId = $adminId;
        //$newQuery->queryType = 2;
        $newQuery->save();

        $updateQueryTypeId = Query::find($queryId);
        $updateQueryTypeId->queryType = 2;
        $updateQueryTypeId->save();

        return redirect('adminQueryManager/viewNewQueries')->with('success', 'Query Assigned');
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
