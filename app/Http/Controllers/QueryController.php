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
    public function index()
    {
        $userId= auth()->user()->id;
        $queries = Query::find($userId);
        $queries = DB::table('queries')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('query_categories','sub_categories.categoryId','=','query_categories.id')
            ->where('userId','=',$userId)
            ->select('queries.id','queries.priorityCode','queries.queryDetails','query_categories.categoryName','query_categories.categoryDescription','sub_categories.subCategoryDescription')
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

        Controller::mail();

        $userId= auth()->user()->id;

        $query = new  Query();
        $query->queryDetails = $request->input('queryDetails');
        $query->categoryId = $request->input('categorieId');
        $query->subCategory = $request->input('subCategoryId');
        $query->userId = $userId;
        $query->save();
        //Controller::mail();

        return redirect('/home')->with('success','Category Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $checkIfQueryIsAssinged = $this->checkIfQuerieIsAssignedToItStaffMember($id);
        if($checkIfQueryIsAssinged > 0){
            $queries = DB::table('queries')
                ->join('query_assigned_to_tech_personels','queries.id','=','query_assigned_to_tech_personels.queryId')
                ->join('admins','query_assigned_to_tech_personels.itPersonelId','=','admins.id')
                ->join('sub_categories','queries.subCategory','=','sub_categories.id')
                ->where('queries.id','=', $id)
                ->select('admins.name','queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
                ->get();
            return view("query.show")->with('queries',$queries);
        }else{           
            $queries = DB::table('queries')
                //->join('query_assigned_to_tech_personels','queries.id','=','query_assigned_to_tech_personels.queryId')                
                ->join('sub_categories','queries.subCategory','=','sub_categories.id')
                ->where('queries.id','=', $id)
                ->select('queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
                ->get();
            return view("query.showUnAssinged")->with('queries',$queries);            
        }       
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
