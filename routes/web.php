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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('dynamicDrpdown', CategorySubCategory::class);

Route::prefix('query')->namespace('App\Http\Controllers')->group(function () {
    Route::get('createQuery', 'QueryController@create')->name('query.create');
    Route::post('storeQuery', 'QueryController@store')->name('query.store');
    Route::post('showQuery', 'QueryController@showCategory')->name('query.show');
    Route::get('createQueryWithinCategory/{id}', 'QueryController@createQueryWithinCategory')->name('query.createQueryWithinCategory');
    Route::get('indexQuery', 'QueryController@index')->name('query.index');
    Route::get('showQueryCategories','QueryController@showQueryCategories')->name('query.showQueryCategories');
    //Route::resource('categoryManagement','CategoryManagementController');
});

Route::prefix('queryManagent')->namespace('App\Http\Controllers')->group(function () {
    Route::get('createCategory', 'QueryCategoryManagementController@create')->name('category.create');
    Route::post('storeCategory', 'QueryCategoryManagementController@store')->name('category.store');
    Route::post('showCategory', 'QueryCategoryManagementController@showCategory')->name('category.show');
    Route::get('indexCategory', 'QueryCategoryManagementController@index')->name('category.index');
    Route::post('updateCategory', 'QueryCategoryManagementController@update')->name('category.update');

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
    Route::get('createSubCategory/{id}', 'QuerySubCategoryManagementController@create')->name('subCategory.create');
    Route::post('storeSubCategory', 'QuerySubCategoryManagementController@store')->name('subCategory.store');
    Route::post('showSubCategory', 'QuerySubCategoryManagementController@showCategory')->name('subCategory.show');
    Route::get('indexSubCategory', 'QuerySubCategoryManagementController@index')->name('subCategory.index');
    Route::post('updateSubCategory/{id}', 'QuerySubCategoryManagementController@update')->name('subCategory.update');
    Route::get('editSubCategory/{id}', 'QuerySubCategoryManagementController@edit')->name('subCategory.edit');
    Route::get('deleteSubCategory/{id}', 'QuerySubCategoryManagementController@destroy')->name('subCategory.delete');
    //Route::resource('categoryManagement','CategoryManagementController');
});

Route::view('states-city','livewire.home');
Route::resources([    
    'query' => QueryController::class,
    'queryManagent' => QueryCategoryManagementController::class,
    'quickSolutions' => QuickSolutionsController::class,
    'subQueryManagent' => QuerySubCategoryManagementController::class,
    'adminQueryManagement' => AdminQueryController::class,
]);

Route::prefix('adminQueryManager')->namespace('App\Http\Controllers')->group(function () {
    Route::get('indexOfQueries', 'AdminQueryController@index')->name('adminQueries.index');
    Route::get('showUserQuery/{id}', 'AdminQueryController@show')->name('adminQueries.show');

    //Route::post('adminShowQuery', 'AdminQueryController@show')->name('admin.showQuery');

});




Route::get('getCategories', 'DynamicCategoryController@getCategories');
Route::get('getSubCategories', 'DynamicCategoryController@getSubCategories');

Route::group(['middleware' => ['auth:admin']], function() {
    Route::get('/users', [UserController::class, 'users']);
  });

Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    //Login Routes
    /*Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', 'Auth\AdminLoginController@showAdminLoginForm')->name('admin.login');
        Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    });*/   
    //Forgot Password Routes
    Route::get('/adminDashboard','HomeController@index')->name('home');
    Route::namespace('Auth')->group(function(){
        
        //Login Routes
        Route::get('/login','LoginController@showLoginForm')->name('admin.login');
        Route::post('/login','LoginController@login')->name('admin.login.submit');
        Route::post('/logout','LoginController@logout')->name('admin.logout');
    
        //Forgot Password Routes
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    
        //Reset Password Routes
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update');
    
    });
});