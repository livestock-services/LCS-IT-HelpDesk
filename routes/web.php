<?php

use App\Http\Controllers\QueryCategoryManagementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueryController;
use App\Http\Livewire\CategorySubCategory;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('dynamicDrpdown', CategorySubCategory::class);

Route::prefix('query')->namespace('App\Http\Controllers')->group(function () {
    Route::group(['middleware' => ['auth']], function () { 
        Route::get('createQuery', 'QueryController@create')->name('query.create');
        Route::post('storeQuery', 'QueryController@store')->name('query.store');
        Route::get('showQuery/{id}', 'QueryController@show')->name('query.show');
        Route::post('showPendingQuery', 'QueryController@showCategory')->name('query.showPendingQuery');
        Route::get('createQueryWithinCategory/{id}', 'QueryController@createQueryWithinCategory')->name('query.createQueryWithinCategory');
        Route::get('indexPendingQuery', 'QueryController@indexPendingQueries')->name('query.indexPendingQueries');
        Route::get('indexAssignedorClearedQueries/{id}', 'QueryController@indexAssignedorClearedQueries')->name('query.indexAssignedorClearedQueries');
        Route::get('showAssignedorClearedQueries/{id}', 'QueryController@showAssignedorClearedQueries')->name('query.showAssignedorClearedQueries');
        Route::get('indexClearedQuery', 'QueryController@indexClearedQueries')->name('query.indexClearedQueries');
        Route::get('showQueryCategories','QueryController@showQueryCategories')->name('query.showQueryCategories');
    //Route::resource('categoryManagement','CategoryManagementController');
    });
});

Route::prefix('queryManagent')->namespace('App\Http\Controllers')->group(function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('editCategory/{id}', 'QueryCategoryManagementController@edit')->name('category.edit');  
        Route::get('createCategory', 'QueryCategoryManagementController@create')->name('category.create');
        Route::post('storeCategory', 'QueryCategoryManagementController@store')->name('category.store');
        Route::get('showCategory/{id}', 'QueryCategoryManagementController@show')->name('category.show');
        Route::get('indexCategory', 'QueryCategoryManagementController@index')->name('category.index');
        Route::post('updateCategory/{id}', 'QueryCategoryManagementController@update')->name('category.update');
        Route::get('queryReports', 'QueryCategoryManagementController@queryReports')->name('query.reports');
    });        
    //Route::resource('categoryManagement','CategoryManagementController');
});

Route::prefix('quickSolutions')->namespace('App\Http\Controllers')->group(function () {
    Route::get('createSolutions', 'QuickSolutionsController@create')->name('quick.create');
    Route::post('storeSolutions', 'QuickSolutionsController@store')->name('quick.store');
    Route::post('showSolutions', 'QuickSolutionsController@showCategory')->name('quick.show');
    Route::get('indexSolutions', 'QuickSolutionsController@index')->name('quick.index');
    //Route::resource('categoryManagement','CategoryManagementController');
});

Route::prefix('subQueryManagent')->namespace('App\Http\Controllers')->group(function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('createSubCategory/{id}', 'QuerySubCategoryManagementController@create')->name('subCategory.create');
        Route::post('storeSubCategory', 'QuerySubCategoryManagementController@store')->name('subCategory.store');
        Route::post('showSubCategory', 'QuerySubCategoryManagementController@showCategory')->name('subCategory.show');
        Route::get('indexSubCategory', 'QuerySubCategoryManagementController@index')->name('subCategory.index');
        Route::post('updateSubCategory/{id}', 'QuerySubCategoryManagementController@update')->name('subCategory.update');
        Route::get('editSubCategory/{id}', 'QuerySubCategoryManagementController@edit')->name('subCategory.edit');
        Route::get('deleteSubCategory/{id}', 'QuerySubCategoryManagementController@destroy')->name('subCategory.delete');
    //Route::resource('categoryManagement','CategoryManagementController');
    });
});

Route::prefix('userRoleManagement')->namespace('App\Http\Controllers')->group(function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::group(['middleware' => ['role:Super Admin']], function () {
            Route::get('create', 'UserRolesController@create')->name('userRole.create');
            Route::post('store','UserRolesController@store')->name('userRole.store');
            Route::get('index','UserRolesController@index')->name('userRole.index');
        });
    });
});
Route::group(['middleware' => ['auth']], function () {
    Route::prefix('userChangePassword')->namespace('App\Http\Controllers')->group(function(){    
        Route::get('edit', 'UserChangePasswordController@edit')->name('userChangePassword.edit');
        Route::post('update/{id}', 'UserChangePasswordController@update')->name('userChangePassword.update');
    });
});

Route::prefix('adminChangePassword')->namespace('App\Http\Controllers')->group(function(){
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::get('edit', 'AdminChangePasswordController@edit')->name('adminChangePassword.edit');
        Route::post('update/{id}', 'AdminChangePasswordController@update')->name('adminChangePassword.update');
    });
});

Route::prefix('userManagement')->namespace('App\Http\Controllers')->group(function () {
    Route::group(['middleware' => ['auth:admin']], function () {    
        Route::get('create', 'UserManagementController@create')->name('userManagement.create');
        Route::post('store','UserManagementController@store')->name('userManagement.store');
        Route::get('index','UserManagementController@index')->name('userManagement.index');
        Route::get('show/{id}', 'UserManagementController@show')->name('userManagement.show');
        Route::get('edit/{id}', 'UserManagementController@edit')->name('userManagement.edit');
        Route::get('activateAndDeactivateUserAccount/{userId}/{status}','UserManagementController@activateAndDeactivateUserAccount')->name('userManagement.activateAndDeactivateUserAccount');
        Route::get('resetUserPassword/{id}', 'UserManagementController@resetUserPassword')->name('userManagement.resetPassword');
        Route::post('updateUser/{id}', 'UserManagementController@update')->name('userManagement.updateUserCredentials');
        Route::post('updateUserPassword/{id}', 'UserManagementController@updatePassword')->name('userManagement.updateUserPassword');
    });
});

Route::prefix('adminManagement')->namespace('App\Http\Controllers')->group(function () {
    Route::group(['middleware' => ['auth:admin']], function () { 
        Route::group(['middleware' => ['role:Super Admin']], function () {
            Route::get('create', 'AdminManagementController@create')->name('adminManagement.create');
            Route::get('register', 'AdminManagementController@register')->name('adminManagement.register');
            Route::post('registerAdmin', 'AdminManagementController@registerAdmin')->name('adminManagement.registerAdmin');
            Route::post('store','AdminManagementController@store')->name('adminManagement.store');
            Route::get('activateAndDeactivateAdminAccount/{adminId}/{status}','AdminManagementController@activateAndDeactivateAdminAccount')->name('adminManagement.activateAndDeactivateAdminAccount');
            Route::get('index','AdminManagementController@index')->name('adminManagement.index');
            Route::get('show/{id}', 'AdminManagementController@show')->name('adminManagement.show');
            Route::get('edit/{id}', 'AdminManagementController@edit')->name('adminManagement.edit');
            Route::get('resetUserPassword/{id}', 'AdminManagementController@resetAdminPassword')->name('adminManagement.resetPassword');
            Route::post('updateUser/{id}', 'AdminManagementController@update')->name('adminManagement.updateUserCredentials');
            Route::post('updateUserPassword/{id}', 'AdminManagementController@updatePassword')->name('adminManagement.updateUserPassword');
        });
    });
});

Route::view('states-city','livewire.home');

Route::group(['middleware' => ['auth']], function () {
    Route::resources([ 
        #'query' => QueryController::class
    ]);
});

Route::group(['middleware' => ['auth:admin']], function () { 
    Route::resources([         
        #'queryManagent' => QueryCategoryManagementController::class,
        #'quickSolutions' => QuickSolutionsController::class,
        #'subQueryManagent' => QuerySubCategoryManagementController::class,
        'adminQueryManagement' => AdminQueryController::class,
        #'itStaffManagement' => ITStaffManagementController::class,
        //'assignITStaff' => AssignITStaffMemberController::class,
    ]);
});

Route::prefix('assignITStaff')->namespace('App\Http\Controllers')->group(function () {    
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::group(['middleware' => ['role:Super Admin']], function () {
            Route::get('viewITStaffMembers/{id}', 'AssignITStaffMemberController@showITStaffMembers')->name('viewITStaffMembers.index');
        });
    });
});

Route::prefix('adminQueryManager')->namespace('App\Http\Controllers')->group(function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::group(['middleware' => ['role:Super Admin']], function () {
            Route::get('viewClearedQueries', 'AdminQueryController@indexClearedQueries')->name('clearedQueriesAdmin.index');
            Route::get('viewAssignedQueries', 'AdminQueryController@indexAssignedQueries')->name('assignedQueries.index');
            Route::get('viewNewQueries', 'AdminQueryController@indexNewQueries')->name('newQueriesAdmin.index');
            Route::get('showUserQuery/{id}', 'AdminQueryController@show')->name('adminQueries.show');
            Route::post('assignQueryPriority/{queryId}','AdminQueryController@assignPriority')->name('assignPriority.set');
            Route::get('assingItQuery/{query}/{adminId}', 'AdminQueryController@assignQuery')->name('assignQuery.select');
            Route::get('showClearedOrAssignedQueries/{id}', 'AdminQueryController@showPendingQueries')->name('adminQueries.showPendingQueries');
            Route::get('clearUserQuery/{query}', 'AdminQueryController@clearUserQuery')->name('adminQueries.clearUserQuery');
            Route::get('setQueryPriority/{query}', 'AdminQueryController@setQueryPriority')->name('adminQueries.setQueryPriority');
            Route::get('queryReports', 'AdminQueryController@queryReports')->name('adminQueries.reports');
        });
        Route::get('viewAssingedQueries', 'AdminQueryController@indexPendingQueries')->name('yourPendingQueriesAdmin.index');    
        Route::get('viewYourAssignedQueriesOrClearedQueries/{id}', 'AdminQueryController@indexYourAssignedOrClearedQueries')->name('assignedQueries.indexYourAssignedOrClearedQueries');
    });
    //Route::post('adminShowQuery', 'AdminQueryController@show')->name('admin.showQuery');
});

Route::prefix('itStaffManagement')->namespace('App\Http\Controllers')->group(function () {
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::group(['middleware' => ['role:Super Admin']], function () {
            Route::get('showITStaffMember/{id}','ITStaffManagementController@showITStaffMember')->name('showITStaffMember.show');
        });
    });
});

use App\Http\Controllers\SendEmailController;
use TCG\Voyager\Facades\Voyager;

Route::get('send-email', [SendEmailController::class, 'index']);

/*Route::get('getCategories', 'DynamicCategoryController@getCategories');
Route::get('getSubCategories', 'DynamicCategoryController@getSubCategories');*/

Route::group(['middleware' => ['auth:admin']], function() {
    Route::get('/users', [UserController::class, 'users']);
  });

Route::prefix('adminUser')->namespace('App\Http\Controllers\Admin')->group(function () {
    //Login Routes
    /*Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', 'Auth\AdminLoginController@showAdminLoginForm')->name('admin.login');
        Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    });*/   
    //Forgot Password Routes
    Route::group(['middleware' => ['auth:admin']], function() {
        Route::get('/adminDashboard','HomeController@index')->name('admin.home');
    });
    Route::namespace('Auth')->group(function(){        
        //Login Routes
        Route::get('/login','LoginController@showLoginForm')->name('admin.login');
        Route::post('/login','LoginController@login')->name('admin.login.submit');
        Route::post('/logout','LoginController@logout')->name('admin.logout');    
        //Forgot Password Routes
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/resetsubmit','ForgotPasswordController@showLinkRequestForm')->name('reset.password.submit');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');    
        //Reset Password Routes
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');    
    });
});



/*Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});*/
