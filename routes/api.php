<?php

use Illuminate\Http\Request;

use App\Models\PostCategory;
use App\Http\Resources\PostCategory as PostCategoryResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//route resource

    // Route::resources([
    // '/api/manage-post-category' => 'Backend\PostCategoryController',
    
    // ]);
    
    //api
    
    //get list of post category
    // Route::get('manage-post-category', function() {
    //     $categories = PostCategory::where('parent_id', '=', 0)->get();
    //     $allCategories = PostCategory::all();
    //     // return view('backend.PostCategory',compact('categories','allCategories'));
    //     return $categories;
    // });
    
    // //get detail of category of post
    // Route::get('post-category/{id}', function($id) {
    //     return PostCategory::find($id);
    // });
    
    // // create new category of post
    // Route::post('manage-post-category', function(Request $request) {
    //     return PostCategory::create($request->all);
    // });
        
    //     //update category
    // Route::patch('manage-post-category/{id}', function(Request $request, $id) {
    //     $cate = PostCategory::findOrFail($id);
    //     $cate->update($request->all());

    //     return $cate;
    // });
        
        
    // //delete category
    // Route::delete('manage-post-category/{id}', function($id) {
    //     PostCategory::find($id)->delete();
    //     return 204;
    // });
    Route::get('manage-post-category', 'Backend\PostCategoryController@index')->name('post-category');
    Route::get('manage-post-category/{id}', 'Backend\PostCategoryController@show');
    Route::post('manage-post-category', 'Backend\PostCategoryController@store');
    Route::patch('manage-post-category/{id}', 'Backend\PostCategoryController@update');
    Route::delete('manage-post-category/{id}', 'Backend\PostCategoryController@destroy');