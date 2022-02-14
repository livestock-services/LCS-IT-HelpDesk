<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\QueryAssignedToTechPersonel;
use App\Models\SubCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*public function showSpecficCategory($id)
    {
        $categories = Category::find($id);
        $subCategories = SubCategory::all();
        $subCategories = DB::table('sub_categories')
            ->where('categoryId','=',$id)
            ->select('*')
            ->orderBy('created_at','desc')
            ->paginate(15);
        return view('queryCategoryManagement.show')->with('categories',$categories)->with('subCategories',$subCategories);        
    }*/

    public function checkIfCategoryHasSubCategory($id){

    }

    public function checkIfQuerieIsAssignedToItStaffMember($id){
                
        $checkQueryAssignment = DB::table('query_assigned_to_tech_personels')
            ->where('queryId','=', $id)
            ->count();
        return $checkQueryAssignment;
    }

    public function mail()
    {
        $data = array('name'=>"Our Code World");
        // Path or name to the blade template to be rendered
        $template_path = 'email_template';
        
        Mail::send(['text'=> $template_path ], $data, function($message) {
            // Set the receiver and subject of the mail.
            $message->to('azwels@livestock.co.zm', 'Receiver Name')->subject('Laravel First Mail');
            // Set the sender
            $message->from('sysmail@livestock.co.zm','Our Code World');
        });

        return "Basic email sent, check your inbox.";
    }


}
