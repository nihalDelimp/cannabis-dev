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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::any('/get_post_list', [App\Http\Controllers\API\PostController::class, 'getPostList']);
Route::any('/get_news_list', [App\Http\Controllers\API\PostController::class, 'getNewsList']);
Route::any('/get_news_detail', [App\Http\Controllers\API\PostController::class, 'getNewsDetail']);
Route::any('/get_news_list_by_tag', [App\Http\Controllers\API\PostController::class, 'getNewsListByTag']);
Route::any('/get_news_list_by_category', [App\Http\Controllers\API\PostController::class, 'getNewsListByCategory']);
Route::any('/get_video_detail', [App\Http\Controllers\API\PostController::class, 'getVideoDetail']);


Route::any('/get_related_videos', [App\Http\Controllers\API\PostController::class, 'relatedVideos']);

/*video play-list */
Route::post('video-play-list', [App\Http\Controllers\API\PlayListController::class, 'categoriesWithVideos']);
