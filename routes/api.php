<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::any('/get_post_list', [App\Http\Controllers\API\PostController::class, 'getPostList']);
Route::any('/get_news_list', [App\Http\Controllers\API\PostController::class, 'getNewsList']);
Route::any('/get_news_detail', [App\Http\Controllers\API\PostController::class, 'getNewsDetail']);
Route::any('/get_news_list_by_tag', [App\Http\Controllers\API\PostController::class, 'getNewsListByTag']);
Route::any('/get_news_list_by_category', [App\Http\Controllers\API\PostController::class, 'getNewsListByCategory']);
Route::any('/get_video_detail', [App\Http\Controllers\API\PostController::class, 'getVideoDetail']);


Route::any('/get_related_videos', [App\Http\Controllers\API\PostController::class, 'relatedVideos']);

/*video play-list */
Route::post('video-play-list', [App\Http\Controllers\API\PlayListController::class, 'categoriesWithVideos']);
Route::get('featured-video', [App\Http\Controllers\API\PlayListController::class, 'featuredVideo']);

Route::post("login",[App\Http\Controllers\API\UserController::class,'authenticate'])->name('login');
Route::group(['middleware' => 'jwt.verify'], function(){
    
    //All secure URL's
    
    Route::get("auth-detail-show",[App\Http\Controllers\API\UserController::class,'showAuth']);
    Route::get("get-user",[App\Http\Controllers\API\UserController::class,'get_user']);
    Route::post("edit-auth-account",[App\Http\Controllers\API\UserController::class,'user_account_update']);
    Route::post('create-event', [App\Http\Controllers\API\EventApiController::class, 'storeEvent'])->middleware('adminRole');;
    Route::post('edit-event/{id}', [App\Http\Controllers\API\EventApiController::class, 'eidtEvent'])->middleware('adminRole');;
    Route::delete('delete-event/{id}', [App\Http\Controllers\API\EventApiController::class, 'deleteEvent'])->middleware('adminRole');;
    
    Route::delete("delete-user/{id}",[App\Http\Controllers\API\UserController::class,'deleteUser'])->middleware('adminRole');;
    
    
    
    
    Route::get('event-join-list', [App\Http\Controllers\API\EventJoinListController::class, 'getEventJoinLists']);

    Route::get('user-join-list/{id?}', [App\Http\Controllers\API\EventJoinListController::class, 'UserJoinLists']);
    Route::post("check-email",[App\Http\Controllers\API\UserController::class,'checkMail'])->middleware('adminRole');
    //->middleware('adminRole');
});


Route::post('store-event-join-list', [App\Http\Controllers\API\EventJoinListController::class, 'eventJoinLists']);
Route::post("edit-user-detail/{id}",[App\Http\Controllers\API\UserController::class,'updateUser']);
Route::post('register-users', [App\Http\Controllers\API\PostController::class, 'storeUser'])->name('register-users');
Route::post("user-password-with-login/{token}",[App\Http\Controllers\API\UserController::class,'loginPasswordUser'])->name('create.password.with.login');

Route::get('event-list', [App\Http\Controllers\API\EventApiController::class, 'listEvent']);
Route::post('event-show/{id}', [App\Http\Controllers\API\EventApiController::class, 'showEvent']);
Route::get("user-detail-show/{id}",[App\Http\Controllers\API\UserController::class,'showUser']);
Route::get("user-list",[App\Http\Controllers\API\UserController::class,'userList']);
Route::get("search-user/{slug}",[App\Http\Controllers\API\UserController::class,'userSearchList']);


