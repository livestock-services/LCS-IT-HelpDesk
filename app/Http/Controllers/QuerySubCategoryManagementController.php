<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class QuerySubCategoryManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('subCategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($categoryId)
    {
        return view('subCategory.create')->with('categoryId',$categoryId);
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
            'categoryId' => 'required',
            'subQueryCategory' => 'required'
        ]);
        $categoryId = $request->input('categoryId');
        $subQuerysubCategories = new  SubCategory();
        $subQuerysubCategories->categoryId = $request->input('categoryId');
        $subQuerysubCategories->subCategoryDescription = $request->input('subQueryCategory');
        $subQuerysubCategories->save();
        //return $this->showSpecficCategory($categoryId);
        return redirect('/queryManagent/indexCategory')->with('success','SubCategory Created');
        //return redirect()->route('category.show', ['id'=>$categoryId])->with('success','SubCategory Created');
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
        $subCategories = SubCategory::find($id);       
        return view("subCategory.edit")->with('subCategories',$subCategories);        
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
            
            'subCategoryDescription' => 'required'
        ]);        
        $subCategories =  SubCategory::find($id);        
        $subCategories->subCategoryDescription = $request->input('subCategoryDescription');        
        $subCategories->save();
        
        return redirect('/queryManagent/indexCategory')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subCategories = SubCategory::find($id);
        $subCategories->delete();
        return redirect('/queryManagent/indexCategory')->with('success', 'SubCategory Deleted');
    }
}
