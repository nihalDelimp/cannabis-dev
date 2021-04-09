<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller{
  public function __construct(){
    parent::__construct();
    $this->response = $this->error = array();
    $this->response['status'] = "0";
  }

  public function getPostList(Request $request){
    $posts = [];

    /*get total count*/
    $post =  Post::query();
    $post->where(['posts.status'=>'1']);
    $totalCount = $post->count();

    /*get data*/
    $post =  Post::query();
    $post->leftJoin('categories', function($join){
      $join->on('posts.category_id','=','categories.id');
    });
    $post->where(['posts.status'=>'1']);
    $post->orderBy('posts.updated_at','desc');
    if(!empty($request->limit)){
      $post->limit($request->limit);
      $post->offset(($request->page - 1) * $request->limit);
    }
    $post->orderBy('posts.created_at','desc');
    $posts = $post->get(['posts.id','posts.title as post_title','posts.post_type','posts.image','posts.content','categories.title as category_title','posts.created_at']);
    if(count($posts)>0){
      foreach($posts as $key=>$post){
        $post->image = url('images/posts/news',$post->image);
        $post->user_name = 'Jhone Smith';
      }
      $this->response['status'] = "1";
      $this->response['data']['total_count'] = $totalCount;
      $this->response['data']['posts'] = $posts;
    }
    else{
      $this->response['data']['error'] = $this->langError(["Sorry, there is no data to display."]);;
    }
    $this->sendResponse($this->response);
  }

  public function getNewsList(Request $request){
    $posts = [];

    /*get total count*/
    $post =  Post::query();
    $post->where(['posts.post_type'=>'1','posts.status'=>'1']);
    $totalCount = $post->count();

    /*get data*/
    $post =  Post::query();
    $post->leftJoin('categories', function($join){
      $join->on('posts.category_id','=','categories.id');
    });
    $post->where(['posts.post_type'=>'1','posts.status'=>'1']);
    $post->orderBy('posts.updated_at','desc');
    if(!empty($request->limit)){
      $post->limit($request->limit);
      $post->offset(($request->page - 1) * $request->limit);
    }
    $post->orderBy('posts.created_at','desc');
    $posts = $post->get(['posts.id','posts.title as post_title','posts.image','posts.content','categories.title as category_title','posts.created_at']);
    if(count($posts)>0){
      foreach($posts as $key=>$post){
        $post->image = url('images/posts/news',$post->image);
        $post->user_name = 'Jhone Smith';
      }
      $this->response['status'] = "1";
      $this->response['data']['total_count'] = $totalCount;
      $this->response['data']['posts'] = $posts;
    }
    else{
      $this->response['data']['error'] = $this->langError(["Sorry, there is no data to display."]);;
    }
    $this->sendResponse($this->response);
  }

  public function getNewsDetail(Request $request){
    $validation['slug'] = 'required|string';
    $attributes = [];
    $messages = [];
    $validator = Validator::make($request->all(), $validation,$messages,$attributes);
    if($validator->fails()){
     $errors = json_decode($validator->errors()->toJson(), true);
     if (!empty($errors)){
        foreach($errors as $k => $v) {
          foreach($v as $error){
            $this->error[] = $error;
          }
        }
     }
    }
    if(count($this->error) == 0){
      $post = Post::leftJoin('categories', function($join){
        $join->on('posts.category_id','=','categories.id');
      })
      ->where(['posts.slug'=>$request->slug,'posts.status'=>'1'])
      ->first(['posts.*','categories.title as category_title']);
      if(!empty($post)){
        $post->image = url('images/posts/news',$post->image);
        $post->user_name = 'Jhone Smith';
        $post->tags_are = $post->tags;
        $this->response['status'] = "1";
        $this->response['data']['post'] = $post;
      }
      else{
        $this->response['data']['error'] = $this->langError(['sorry there is no data to display.']);
      }
    }
    else{
      $this->response['data']['error'] = $this->langError($this->error);
    }
    $this->sendResponse($this->response);
  }


}
