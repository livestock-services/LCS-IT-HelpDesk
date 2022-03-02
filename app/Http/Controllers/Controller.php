<?php

namespace App\Http\Controllers;

use App\Mail\NotifyMail;
use App\Mail\NotifyThatQueryAssingedMail;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Query;
use App\Models\QueryAssignedToTechPersonel;
use App\Models\SubCategory;
use App\Models\User;
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

    public function notifyMail($categoryId, $subCategoryId, $queryDetails)
    {    
        $email= auth()->user()->email;
        $getCategoryDetails = $this->getCategoryDetails($categoryId);
        $getSubCategoryDetails = $this->getSubCategoryDetails($subCategoryId);
        
        $categoryDetails = $getCategoryDetails->categoryName;
        $subCategoryDetails = $getSubCategoryDetails->subCategoryDescription;

        $data = array(
            'categoryDetails' => $categoryDetails,
            'subCategoryDetails' => $subCategoryDetails,
            'queryDetails' =>  $queryDetails
            //'message' => $request->message
        );
        //$emails = array("itsupport@livestock.co.zm", $email);
        Mail::to('itsupport@livestock.co.zm')->cc($email)->send(new NotifyMail($data)); 
    
        if (Mail::failures()) {
            return 'FAILURE';
        }else{
            return view('home');
        }
    }

    private function getCategoryDetails($categoryId){       
        $categoryDetails = Category::find($categoryId);        
        return $categoryDetails;
    }

    private function getSubCategoryDetails($subCategoryId){
        $subCategoryDetails = SubCategory::find($subCategoryId);
        return $subCategoryDetails;
    }

    public function getItPersonelDetails($adminId){
        $iTPersonelDetails = Admin::find($adminId);
        return $iTPersonelDetails;
    }

    public function getUserDetails($userId){
        $userDetails = User::find($userId);
        return $userDetails;
    }

    private function getQueryDetails($queryId){
        $queryDetails = Query::find($queryId);
        return $queryDetails;
    }    

    public function notifyThatQueryAssingedMail($adminId,$queryId)
    {           
        $getAdminDetails = $this->getItPersonelDetails($adminId);        
        $adminName = $getAdminDetails->name;
        $adminEmail = $getAdminDetails->email;
        
        $getQueryDetails = $this->getQueryDetails($queryId);
        $getQuerySenderUserId = $getQueryDetails->userId;

        $getQueryCategoryId = $getQueryDetails->categoryId;
        $getQuerySubCategoryId = $getQueryDetails->subCategory;

        $getCategoryDetails = $this->getCategoryDetails($getQueryCategoryId);
        $getSubCategoryDetails = $this->getSubCategoryDetails($getQuerySubCategoryId);
        
        $categoryDetails = $getCategoryDetails->categoryName;
        $subCategoryDetails = $getSubCategoryDetails->subCategoryDescription;

        $getSenderDetails = $this->getUserDetails($getQuerySenderUserId);
        $querySenderEmail = $getSenderDetails->email;
        $querySenderName = $getSenderDetails->name;

        $email = $querySenderEmail;

        //$email = $this->getUserDetails($queryId);
        $data = array(
            'categoryDetails' => $categoryDetails,
            'subCategoryDetails' => $subCategoryDetails,
            'querySenderName' => $querySenderName,
            'querySenderEmail' => $querySenderEmail,
            'adminEmail'=> $adminEmail,
            'adminName' => $adminName,            
        );
        //$emails = array("itsupport@livestock.co.zm", $email);
        Mail::to('itsupport@livestock.co.zm')->cc($email)->send(new NotifyThatQueryAssingedMail($data));        
    
        if (Mail::failures()) {
            return 'FAILURE';
        }else{
            return view('home');
        }
    }  

}
