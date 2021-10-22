<?php

use App\Http\Controllers\QueryCategoryManagementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueryController;


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

Route::prefix('query')->namespace('App\Http\Controllers')->group(function () {
    Route::get('createQuery', 'QueryController@create')->name('query.create');
    Route::post('storeQuery', 'QueryController@store')->name('query.store');
    Route::post('showQuery', 'QueryController@showCategory')->name('query.show');
    //Route::resource('categoryManagement','CategoryManagementController');
});

Route::prefix('queryManagent')->namespace('App\Http\Controllers')->group(function () {
    Route::get('createCategory', 'QueryCategoryManagementController@create')->name('category.create');
    Route::post('storeCategory', 'QueryCategoryManagementController@store')->name('category.store');
    Route::post('showCategory', 'QueryCategoryManagementController@showCategory')->name('category.show');
    Route::get('indexCategory', 'QueryCategoryManagementController@index')->name('category.index');

    //Route::resource('categoryManagement','CategoryManagementController');
});


Route::prefix('quickSolutions')->namespace('App\Http\Controllers')->group(function () {
    Route::get('createSolutions', 'QuickSolutionsController@create')->name('quick.create');
    Route::post('storeSolutions', 'QuickSolutionsController@store')->name('quick.store');
    Route::post('showSolutions', 'QuickSolutionsController@showCategory')->name('quick.show');
    Route::get('indexSolutions', 'QuickSolutionsController@index')->name('quick.index');
    //Route::resource('categoryManagement','CategoryManagementController');
});

Route::resources([    
    'query' => QueryController::class,
    'queryManagent' => QueryCategoryManagementController::class,
    'quickSolutions' => QuickSolutionsController::class,
]);


