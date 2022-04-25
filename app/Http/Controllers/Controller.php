<?php

namespace App\Http\Controllers;

use App\Mail\NotifyClearedQuery;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    
    public function checkIfCategoryHasSubCategory($id){

    }

    public static function getUsersUnassignedQueries(){
        
    }

    public static function getNewQueries(){
        $queries = DB::table('queries')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('query_categories','sub_categories.categoryId','=','query_categories.id')
            ->join('users','queries.userId','=','users.id')
            ->where('queries.queryType','=', 1 )
            ->select('users.email','users.name','queries.id','queries.priorityCode','queries.queryDetails','query_categories.categoryName','query_categories.categoryDescription','sub_categories.subCategoryDescription')
            ->get();
        return $queries;
    }

    public function hasPasswordBeenChanged()
    {   
        if ((Auth::user()->changed_password == null)) {
           return redirect(route('change-password'));
        }        
    }

    public static function getAssignedQueries(){
        $queries = DB::table('queries')
            ->join('query_assigned_to_tech_personels','queries.id','=','query_assigned_to_tech_personels.queryId')
            ->join('admins','query_assigned_to_tech_personels.itPersonelId','=','admins.id')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('users','queries.userId','=','users.id')
            ->where('queries.queryType','=', 2 )                
            ->select('users.email','users.name','queries.id','queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
            ->get();
        return $queries;
    }

    public static function getAdminAssignedorClearedQueries($statusId,$adminId){
        $queries = DB::table('queries')
            ->join('query_assigned_to_tech_personels','queries.id','=','query_assigned_to_tech_personels.queryId')
            ->join('admins','query_assigned_to_tech_personels.itPersonelId','=','admins.id')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('users','queries.userId','=','users.id')
            ->where('queries.queryType','=', $statusId )
            ->where('admins.id','=', $adminId )               
            ->select('users.email','users.name','queries.id','queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
            ->get();
        return $queries;
    }
    

    public static function getAssignedorClearedQueries($statusId,$userId){
        $queries = DB::table('queries')
            ->join('query_assigned_to_tech_personels','queries.id','=','query_assigned_to_tech_personels.queryId')
            ->join('admins','query_assigned_to_tech_personels.itPersonelId','=','admins.id')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('users','queries.userId','=','users.id')
            ->where('queries.queryType','=', $statusId )
            ->where('queries.userId','=', $userId )               
            ->select('users.email','users.name','queries.id','queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
            ->get();
        return $queries;
    }

    public static function getAdminPendingQueries($adminId){        
        $queries = DB::table('queries')
                ->join('query_assigned_to_tech_personels','queries.id','=','query_assigned_to_tech_personels.queryId')
                ->join('admins','query_assigned_to_tech_personels.itPersonelId','=','admins.id')
                ->join('sub_categories','queries.subCategory','=','sub_categories.id')
                ->join('users','queries.userId','=','users.id')
                ->where('queries.queryType','=', 2 )
                ->where('admins.id','=',$adminId)
                ->select('users.email','users.name','queries.id','queries.queryDetails','queries.statusId','sub_categories.subCategoryDescription')
                ->get();
        return $queries;
        //return view("adminQueryManager.assingedAndClearedQueries")->with('queries',$queries);
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
        );
        
        Mail::to('itsupport@livestock.co.zm')->cc($email)->send(new NotifyMail($data)); 
    
        if (Mail::failures()) {
            return 'FAILURE';
        }else{
            return view('home');
        }
    }

    public function notifyClearedQueryMail($queryId){                
        $getQueryDetails = $this->getQueryDetails($queryId);
        $getQueryCategoryId = $getQueryDetails->categoryId;        
        $getQuerySenderUserId = $getQueryDetails->userId;        
        $getQuerySubCategoryId = $getQueryDetails->subCategory;
        $getCategoryDetails = $this->getCategoryDetails($getQueryCategoryId);
        $categoryDetails = $getCategoryDetails->categoryName;        
        $getSubCategoryDetails = $this->getSubCategoryDetails($getQuerySubCategoryId);
        $subCategoryDetails = $getSubCategoryDetails->subCategoryDescription;
        $getSenderDetails = $this->getUserDetails($getQuerySenderUserId);
        $querySenderEmail = $getSenderDetails->email;
        $querySenderName = $getSenderDetails->name;
        $email = $querySenderEmail;
        $data = array(
            'categoryDetails' => $categoryDetails,
            'subCategoryDetails' => $subCategoryDetails,
            'querySenderName' => $querySenderName,
            'querySenderEmail' => $querySenderEmail,                        
        );

        Mail::to('itsupport@livestock.co.zm')->cc($email)->send(new NotifyClearedQuery($data));        

        if (Mail::failures()) {
            return 'FAILURE';
        }else{
            return view('home');
        }
    }

    public function notifyThatQueryAssingedMail($adminId,$queryId)
    {           
        $getAdminDetails = $this->getItPersonelDetails($adminId);        
        $adminName = $getAdminDetails->name;
        $adminEmail = $getAdminDetails->email;
        
        $getQueryDetails = $this->getQueryDetails($queryId);
        $getQueryCategoryId = $getQueryDetails->categoryId;
        
        $getQuerySenderUserId = $getQueryDetails->userId;        
        $getQuerySubCategoryId = $getQueryDetails->subCategory;

        $getCategoryDetails = $this->getCategoryDetails($getQueryCategoryId);
        $categoryDetails = $getCategoryDetails->categoryName;
        
        $getSubCategoryDetails = $this->getSubCategoryDetails($getQuerySubCategoryId);
        $subCategoryDetails = $getSubCategoryDetails->subCategoryDescription;        

        $getSenderDetails = $this->getUserDetails($getQuerySenderUserId);
        $querySenderEmail = $getSenderDetails->email;
        $querySenderName = $getSenderDetails->name;

        $email = $querySenderEmail;
        
        $data = array(
            'categoryDetails' => $categoryDetails,
            'subCategoryDetails' => $subCategoryDetails,
            'querySenderName' => $querySenderName,
            'querySenderEmail' => $querySenderEmail,
            'adminEmail'=> $adminEmail,
            'adminName' => $adminName,            
        );
        
        Mail::to('itsupport@livestock.co.zm')->cc($email)->send(new NotifyThatQueryAssingedMail($data));        
    
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

    public function getQueryDetails($queryId){
        $queryDetails = Query::find($queryId);
        return $queryDetails;
    }

    public function getQueryAssignedToTechPersonelDetails($assignmentId){
        $queryAssignedToTechPersonelDetails = QueryAssignedToTechPersonel::find($assignmentId);
        return $queryAssignedToTechPersonelDetails;
    }

    public function getPendingQueries($userId){
        $queries = DB::table('queries')
            ->join('sub_categories','queries.subCategory','=','sub_categories.id')
            ->join('query_categories','sub_categories.categoryId','=','query_categories.id')
            ->where('userId','=',$userId)
            ->where('queries.statusId','!=',3)
            ->select('queries.statusId','queries.id','queries.priorityCode','queries.queryDetails','query_categories.categoryName','query_categories.categoryDescription','sub_categories.subCategoryDescription')
            ->get();
        return $queries;
    }
}
