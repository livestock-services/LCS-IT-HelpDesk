<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryCategoryManagementController extends Controller
{
    /**QueryCategoryManagementController
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(){
        $categories = Category::all();
        return view("queryCategoryManagement.index")->with('categories',$categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("queryCategoryManagement.create");
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
            'categoryName' => 'required',
            'categoryDescription' => 'required'
        ]);

        $categories = new  Category();
        $categories->categoryName = $request->input('categoryName');
        $categories->categoryDescription = $request->input('categoryDescription');
        $categories->save();

        return redirect('/queryManagent/indexCategory')->with('success','Category Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::find($id);
        $subCategories = SubCategory::all();
        $subCategories = DB::table('sub_categories')
            ->where('categoryId','=',$id)
            ->select('*')
            ->orderBy('created_at','desc')
            ->paginate(15);
        return view('queryCategoryManagement.show')->with('categories',$categories)->with('subCategories',$subCategories);        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::find($id);
         
         /*if(auth()->user()->id !==$categories->user_id){
            return redirect('categoriess')->with('error','Unauthorized Page');
         }*/
        
        return view("queryCategoryManagement.edit")->with('categories',$categories);
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
            'categoryName' => 'required',
            'categoryDescription' => 'required'
        ]);        
        $categories =  Category::find($id);
        $categories->categoryName = $request->input('categoryName');
        $categories->categoryDescription = $request->input('categoryDescription');        
        $categories->save();
        
        return redirect('/queryManagent/indexCategory')->with('success', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $checkIfCategoryHasSubCategory = $this->checkIfCategoryHasSubCategory($id);
        
        $subCategories = SubCategory::find($id);
        $subCategories->delete();
        return redirect('/queryManagent/indexCategory')->with('success', 'SubCategory Deleted');
        
        //
    }


    public function deleteCategory($id){

        $checkIfCategoryHasSubCategory = $this->checkIfCategoryHasSubCategory($id);
        print($checkIfCategoryHasSubCategory);
        /*if($checkIfCategoryHasSubCategory > 0){
            return redirect()->back()->with('error','Please ensure there are no sub categories under the Category');
        }else{
            $categories =  Category::find($id);
            $categories->delete();

            return redirect('/queryManagent/indexCategory')->with('success', 'Category Deleted');
        }*/
    }
}
