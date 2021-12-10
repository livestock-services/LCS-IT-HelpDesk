<?php

namespace App\Http\Controllers;

use App\Models\Query;
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
            ->join('categories','sub_categories.categoryId','=','categories.id')
            ->where('queries.queryType','=', 1 )
            ->select('queries.id','queries.priorityCode','queries.queryDetails','categories.categoryName','categories.categoryDescription','sub_categories.subCategoryDescription')
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
                ->where('queries.queryType','=', 2 )
                ->select('admins.name','queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
                ->get();
        return view("query.show")->with('queries',$queries);
    }

    public function indexClearedQueries()
    {
        //$userId= auth()->user()->id;
        //$queries = Query::find($userId);
        $queries = DB::table('queries')
            ->join('query_assigned_to_tech_personels','queries.id','=','query_assigned_to_tech_personels.queryId')
            ->join('admins','query_assigned_to_tech_personels.itPersonelId','=','admins.id')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->where('queries.queryType','=', 3 )
            ->select('admins.name','queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
            ->get();
        return view("query.show")->with('queries',$queries);
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
        ->select('queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
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
