<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as ControllersController;
use App\Models\Priority;
use App\Models\Query;
use App\Models\QueryAssignedToTechPersonel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
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
    
    public function indexNewQueries(){   
        $getNewQueries = ControllersController::getNewQueries();         
        return view("adminQueryManager.index")->with('queries',$getNewQueries);
    }

    public function indexYourAssignedOrClearedQueries($statusId){
        $adminId = Auth::id();        
        $queries = ControllersController::getAdminAssignedorClearedQueries($statusId,$adminId);        
        return view("adminQueryManager.indexYourAssignedOrClearedQueries")->with('queries',$queries);

    }
   
    public function indexAssignedQueries(){       
        $queries = ControllersController::getAllAssignedorClearedQueries(2);        
        return view("adminQueryManager.assingedAndClearedQueries")->with('queries',$queries);
    }
    
    public function indexClearedQueries(){        
        $queries = ControllersController::getAllAssignedorClearedQueries(3);
        return view("adminQueryManager.assingedAndClearedQueries")->with('queries',$queries);
    }

    public function indexPendingQueries(){
        $adminId = Auth::id();
        $queries = ControllersController::getAdminPendingQueries($adminId);
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

    public function showPendingQueries($queryId){
        $queries = DB::table('queries')
            ->join('query_assigned_to_tech_personels','queries.id','=','query_assigned_to_tech_personels.queryId')
            ->join('admins','query_assigned_to_tech_personels.itPersonelId','=','admins.id')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('users','queries.userId','=','users.id')
            ->where('queries.id','=', $queryId)
            ->select('users.email','users.name','queries.queryType','queries.id','admins.name as adminName','admins.id as adminId','queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
            ->get();
        return view("adminQueryManager.showPendingQueries")->with('queries',$queries);
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
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->where('queries.id','=', $id)
            ->select('queries.queryType','queries.id','queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription','queries.priorityCode')
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
        $newQuery->save();
        $controller = new ControllersController();        
        $updateQueryTypeId = $controller->getQueryDetails($queryId);
        $updateQueryTypeId->queryType = 2;
        $updateQueryTypeId->statusId = 2;
        $updateQueryTypeId->save();        
        $controller->notifyThatQueryAssingedMail($adminId,$queryId);
        return redirect('adminQueryManager/viewNewQueries')->with('success', 'Query Assigned');
    }

    public function clearUserQuery($queryId){         
        $controller = new ControllersController();        
        $updateQueryTypeId = $controller->getQueryDetails($queryId);      
        $updateQueryTypeId->queryType = 3;
        $updateQueryTypeId->statusId = 3;
        $updateQueryTypeId->save();        
        $controller->notifyClearedQueryMail($queryId);
        
        
        return redirect('adminQueryManager/viewNewQueries')->with('success', 'Query Cleared');
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

    public function queryReports(){
        $queries = DB::table('queries')
        ->join('query_assigned_to_tech_personels','queries.id','=','query_assigned_to_tech_personels.queryId')
        ->join('admins','query_assigned_to_tech_personels.itPersonelId','=','admins.id')
        ->join('sub_categories','queries.subCategory','=','sub_categories.id')
        ->join('users','queries.userId','=','users.id')
        ->select('users.email',
                'users.name',
                'queries.queryType',
                'queries.id',
                'queries.priorityCode',
                'admins.name as adminName',
                'admins.id as adminId',
                'queries.queryDetails'
                ,'queries.statusId',
                'sub_categories.subCategoryDescription')
        ->get();
        print($queries);

        return view("adminQueryManager.queryReports")->with('queries',$queries);
    }

    public function getQueryPriority($id){
        $queries = DB::table('queries')
            ->where('queries.id','=', $id)
            ->select('queries.priorityCode')
            ->get();
        return $queries[0]->priorityCode;
    }
    public function getAllPriorities(){
        $allPriorities = Priority::all();
        return $allPriorities;
    }

    public function setQueryPriority($id){
        $queries = Query::find($id);
        $currentQueryPriority = $this->getQueryPriority($id);
        $getPriorities = $this->getAllPriorities();
        /*$queries = DB::table('queries')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('priorities','queries.priorityCode','=','priorities.priorityCode')
            ->where('queries.id','=', $id)
            ->select('priorities.priorityName','queries.id','queries.queryType','queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription','queries.priorityCode')
            ->get();*/
        #print($queries);
        return view('adminQueryManager.setQueryPriority')->with('queries',$queries)->with('getPriorities',$getPriorities)->with('currentQueryPriority',$currentQueryPriority);
        #return $currentQueryPriority;
    }

    public function assignPriority(Request $request, $id){        
        /*$this->validate($request, [
            'queryPriority' => 'required'
        ]);*/
        $query = Query::find($id); 
        $query->priorityCode = $request->input('queryPriority'); 
        $query->save();

        return redirect()->back()->with('success','Priority Updated Successfully');
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
