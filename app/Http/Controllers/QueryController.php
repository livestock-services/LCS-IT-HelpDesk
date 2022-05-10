<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Query;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    private function getUnclearedUserQueries($userId){
        $queries = DB::table('queries')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('query_categories','sub_categories.categoryId','=','query_categories.id')
            ->where('userId','=',$userId)
            ->where('queries.statusId','!=',3)
            ->select('queries.statusId','queries.id','queries.priorityCode','queries.queryDetails','query_categories.categoryName','query_categories.categoryDescription','sub_categories.subCategoryDescription')
            ->get();        
        return $queries;
    }

    private function getAssignedUserQueries($userId){
        $queries = DB::table('queries')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('query_categories','sub_categories.categoryId','=','query_categories.id')
            ->where('userId','=',$userId)
            ->where('queries.statusId','!=',3)
            ->select('queries.statusId','queries.id','queries.priorityCode','queries.queryDetails','query_categories.categoryName','query_categories.categoryDescription','sub_categories.subCategoryDescription')
            ->get();        
        return $queries;

        $queries = DB::table('queries')
            ->join('query_assigned_to_tech_personels','queries.id','=','query_assigned_to_tech_personels.queryId')
            ->join('admins','query_assigned_to_tech_personels.itPersonelId','=','admins.id')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('users','queries.userId','=','users.id')
            ->where('queries.queryType','=', 3 )
            ->where('userId','=',$userId)
            ->select('users.email','users.name','queries.id','admins.id','admins.name as adminName','queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
            ->get();
        return $queries;
    }

    public function indexPendingQueries()
    {
        $userId= auth()->user()->id;
        $queries = DB::table('queries')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('query_categories','sub_categories.categoryId','=','query_categories.id')
            ->join('users','queries.userId','=','users.id')
            ->where('userId','=',$userId)
            ->where('queries.statusId','=',1)
            ->select('queries.statusId','queries.id','queries.priorityCode','queries.queryDetails','query_categories.categoryName','query_categories.categoryDescription','sub_categories.subCategoryDescription')
            ->get();
        return view("query.indexPendingQueries")->with('queries',$queries);
    }

    public function showAssignedorClearedQueries($queryId){
        $userId= auth()->user()->id;
        $queries = DB::table('queries')
            ->join('query_assigned_to_tech_personels','queries.id','=','query_assigned_to_tech_personels.queryId')
            ->join('admins','query_assigned_to_tech_personels.itPersonelId','=','admins.id')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('users','queries.userId','=','users.id')
            ->where('queries.id','=', $queryId)
            ->where('users.id','=', $userId)                
            ->select('users.email','users.name','queries.queryType','queries.id','admins.name as adminName','admins.id as adminId','queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
            ->get();
            
       //print($queries);
       return view("query.showAssignedOrClearedQueries")->with('queries',$queries);

    }

    public function indexAssignedorClearedQueries($statusId){
        #print($statusId);
        $userId= auth()->user()->id;

        $queries = Controller::getAssignedorClearedQueries($statusId,$userId);
        return view("query.indexAssignedorClearedQueries")->with('queries',$queries);
    }

    public function indexClearedQueries()
    {
        $userId= auth()->user()->id;
        $queries = Query::find($userId);
        $queries = DB::table('queries')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('query_categories','sub_categories.categoryId','=','query_categories.id')
            ->where('userId','=',$userId)
            ->where('queries.statusId','=',3)
            ->select('queries.statusId','queries.id','queries.priorityCode','queries.queryDetails','query_categories.categoryName','query_categories.categoryDescription','sub_categories.subCategoryDescription')
            ->get();
        return view("query.index")->with('queries',$queries);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("query.create");
    }


    public function showQueryCategories(){
        $categories = Category::all();
        return view("query.showQueryCategories")->with('categories',$categories);
    }

    public function createQueryWithinCategory($id)
    {
        $categories = Category::find($id);
        $subCategories = SubCategory::all();
        $subCategories = DB::table('sub_categories')
            ->where('categoryId','=',$id)
            ->select('*')
            ->orderBy('created_at','desc')
            ->get();
        return view("query.create")->with('categories',$categories)->with('subCategories',$subCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'subCategoryId' => 'required',
            'queryDetails' => 'required',
            'categorieId' => 'required'
        ]);
        //Controller::notifyThatQueryAssingedMail($request->input('categorieId'),$request->input('subCategoryId'));
        //Controller::mail();
        Controller::notifyMail($request->input('categorieId'),$request->input('subCategoryId'), $request->input('queryDetails'));
        $userId= auth()->user()->id;
        $query = new  Query();
        $query->queryDetails = $request->input('queryDetails');
        $query->categoryId = $request->input('categorieId');
        $query->subCategory = $request->input('subCategoryId');
        $query->userId = $userId;
        $query->save();
        //Controller::mail();

        return redirect('/home')->with('success','Your Query has been submitted succesfully');
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
            #->join('query_assigned_to_tech_personels','queries.id','=','query_assigned_to_tech_personels.queryId')
            #->join('admins','query_assigned_to_tech_personels.itPersonelId','=','admins.id')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->where('queries.id','=', $id)
            ->select('queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
            ->get();            
        #print(($queries)); 
        return view("query.show")->with('queries',$queries);              
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
