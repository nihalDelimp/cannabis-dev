<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\createNewPassword;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Event;
use App\Models\EventJoinList;
use DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PostController extends Controller{
  public function __construct(){
    parent::__construct();
    $this->response = $this->error = array();
    $this->response['status'] = "0";
  }
  
  
  public function storeUser(Request $request){
    
    //dd($request->all());
    $name = $request->fname." ".$request->lname;
    $data = [];
    $data = [
      'name' => $name,
      'phone' => $request->phone,
      'organization' => $request->organization,
      'dob' => $request->dob,
      'email' => $request->email,
      'position' => $request->position,
      'instagram_name' => $request->instagram_name,
      'insterested_status' => $request->insterested_status,
      'invited_owner' => $request->invited_owner,
      //'password'=>Hash::make($request->password),
    ];
    if(!empty($request->password)) {
      $data['password'] = Hash::make($request->password);
    }
    $validation['email'] = 'required|email|unique:users';
    //$validation['phone'] = 'required|unique:users';
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
      $user = User::create($data);



      if(!empty($user)){
      //dd($user);
        DB::table('password_resets')->insert([
        'email' => $request->email,
        'token' => Str::random(60),
        'created_at' => Carbon::now()
        ]);
        //Get the token just created above
        $tokenData = DB::table('password_resets')->where('email', $request->email)->first();
        $link = env('SPA_URL').'/create-password/'.$tokenData->token;
        // $link = route('create.password.with.login', $tokenData->token);
        //dd("elkdf->",$link);
        $email = $data['email'];
        $body = [
          'url' => $link,
          'name' => $data['email']
        ];
        
        Mail::to($email)->send(new createNewPassword($body));
        $this->response['userId'] = $user->id;
        $this->response['status'] = "1";
        $this->response['data']['user'] = $user;
        
      }
      else {
        $this->response['data']['error'] = 'Sorry there is no data to display.';
      }
    }
    else{
      $this->response['data']['error'] = 'Email Is Already Registered With Us';
      // $this->response['data']['error'] = $this->langError($this->error);
    }
    
    $this->sendResponse($this->response);
    
    
    // $request->title;
    // $this->sendResponse($post);
  }
  public function getEventJoinLists(){
    $this->response = EventJoinList::get();
    $this->sendResponse($this->response);
  }
  public function eventJoinLists(Request $request){
    $result = EventJoinList::where('event_id',$request->event_id)->where('user_id',$request->user_id)->first();
    // dd($request->all());
    // dd($result);
    if($result === null) {
      $insert = [];
      $insert = [
        'event_id' => $request->event_id,
        'user_id' => $request->user_id,
        'event_status' => 1,
      ];
      $this->response['eventList'] = EventJoinList::create($insert);
      $this->response['status'] = 1;
      // $user = User::find($request->user_id);
      // $user->event_status = 1;
      // $user->save();

    } else {
      $this->response['status'] = 0;
      $this->response['error'] = $this->langError(['Record exist already.']);
    }
    $this->sendResponse($this->response);

  }
 
  
  
  public function getPostList(Request $request){
    $posts = [];

    /*get total count*/
    $post =  Post::query();
    $post->where(['posts.status'=>'1']);
    $totalCount = $post->count();

    /*get data*/
    $post =  Post::query();
    $post->where(['posts.status'=>'1']);
    $post->orderBy('posts.updated_at','desc');
    if(!empty($request->limit)){
      $post->limit($request->limit);
      $post->offset(($request->page - 1) * $request->limit);
    }
    $post->orderBy('posts.created_at','desc');
    $posts = $post->get(['id','title','slug','category_id','image','post_type','content','created_at']);
    if(count($posts)>0){
      foreach($posts as $key=>$post){
        $post->image = ($post->post_type == '1')?url('images/posts/news/listing',$post->image):url('images/posts/video/listing',$post->image);
        $post->user_name = 'Jhone Smith';
        $post->category = $post->category;
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
    // $post->leftJoin('categories', function($join){
    //   $join->on('posts.category_id','=','categories.id');
    // });
    $post->where(['posts.post_type'=>'1','posts.status'=>'1']);
    if(!empty($request->limit)){
      $post->limit($request->limit);
      $post->offset(($request->page - 1) * $request->limit);
    }
    $post->orderBy('posts.created_at','desc');
    $posts = $post->get(['id','title','slug','category_id','image','content','created_at']);
    //$posts = $post->get(['posts.*']);
    if(count($posts)>0){
      foreach($posts as $key=>$post){
        $post->image = url('images/posts/news/listing',$post->image);
        $post->user_name = 'Jhone Smith';
        $post->category = $post->category;
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
      $post = Post::where(['posts.slug'=>$request->slug,'posts.status'=>'1'])
      ->first(['posts.id','posts.title','posts.sub_title','posts.content','posts.slug','posts.image','posts.category_id','posts.created_at']);
      if(!empty($post)){
        $post->image = url('images/posts/news/main',$post->image);
        $post->user_name = 'Jhone Smith';
        $post->tags = $post->tags;
        $post->category = $post->category;
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

  public function getNewsListByTag(Request $request){
    $posts = [];
    $validation['tag_slug'] = 'required|string|exists:tags,slug';
    $attributes = [];
    $messages = [];
    $validator = Validator::make($request->all(), $validation,$messages,$attributes);
    $this->error = $this->validateError($validator);
    if(count($this->error) == 0){
      $slug = $request->tag_slug;
      /*get total count*/
      $post =  Post::query();
      $post->where(['posts.post_type'=>'1','posts.status'=>'1']);
      $post->whereHas('tags', function($q) use($slug){
        $q->where(['slug'=>$slug]);
      });
      $totalCount = $post->count();

      /*get data*/
      $post =  Post::query();
      $post->leftJoin('categories', function($join){
        $join->on('posts.category_id','=','categories.id');
      });
      $post->where(['posts.post_type'=>'1','posts.status'=>'1']);
      $post->whereHas('tags', function($q) use($slug){
        $q->where(['slug'=>$slug]);
      });
      $post->orderBy('posts.updated_at','desc');
      if(!empty($request->limit)){
        $post->limit($request->limit);
        $post->offset(($request->page - 1) * $request->limit);
      }
      $post->orderBy('posts.created_at','desc');
      $posts = $post->get(['posts.id','posts.title as post_title','posts.slug','posts.image','posts.content','posts.category_id','posts.created_at']);
      if(count($posts)>0){
        foreach($posts as $key=>$post){
          $post->image = url('images/posts/news/listing',$post->image);
          $post->user_name = 'Jhone Smith';
          $post->category = $post->category;
        }
        $this->response['status'] = "1";
        $this->response['data']['total_count'] = $totalCount;
        $this->response['data']['posts'] = $posts;
      }
      else{
        $this->response['data']['error'] = $this->langError(["Sorry, there is no data to display."]);
      }
    }
    else{
      $this->response['data']['error'] = $this->langError($this->error);
    }
    $this->sendResponse($this->response);
  }

  public function getNewsListByCategory(Request $request){
    $posts = [];
    $validation['category_slug'] = 'required|string|exists:categories,slug';
    $attributes = [];
    $messages = [];
    $validator = Validator::make($request->all(), $validation,$messages,$attributes);
    $this->error = $this->validateError($validator);
    if(count($this->error) == 0){
      $slug = $request->category_slug;
      /*get total count*/
      $post =  Post::query();
      $post->where(['posts.post_type'=>'1','posts.status'=>'1']);
      $post->whereHas('category', function($q) use($slug){
        $q->where(['slug'=>$slug]);
      });
      $totalCount = $post->count();

      /*get data*/
      $post =  Post::query();
      $post->where(['posts.post_type'=>'1','posts.status'=>'1']);
      $post->whereHas('category', function($q) use($slug){
        $q->where(['slug'=>$slug]);
      });
      $post->orderBy('posts.updated_at','desc');
      if(!empty($request->limit)){
        $post->limit($request->limit);
        $post->offset(($request->page - 1) * $request->limit);
      }
      $post->orderBy('posts.created_at','desc');
      $posts = $post->get(['id','title','slug','category_id','image','content','created_at']);
      if(count($posts)>0){
        foreach($posts as $key=>$post){
          $post->image = url('images/posts/news/listing',$post->image);
          $post->user_name = 'Jhone Smith';
          $post->category = $post->category;
        }
        $this->response['status'] = "1";
        $this->response['data']['total_count'] = $totalCount;
        $this->response['data']['posts'] = $posts;
      }
      else{
        $this->response['data']['error'] = $this->langError(["Sorry, there is no data to display."]);
      }
    }
    else{
      $this->response['data']['error'] = $this->langError($this->error);
    }
    $this->sendResponse($this->response);
  }

  public function getVideoDetail(Request $request){
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
      $post = Post::where(['posts.slug'=>$request->slug,'posts.status'=>'1'])
      ->first(['posts.id','posts.title','posts.sub_title','posts.content','posts.slug','posts.image','posts.link_id','posts.category_id','posts.created_at']);
      if(!empty($post)){
        $post->image = url('images/posts/video/main',$post->image);
        $post->user_name = 'Jhone Smith';
        $post->tags = $post->tags;
        $post->category = $post->category;
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

  public function relatedVideos(Request $request){
    $validation['category_slug'] = 'required|string';
    $attributes = [];
    $messages = [];
    $validator = Validator::make($request->all(), $validation,$messages,$attributes);
    $this->error = $this->validateError($validator);
    if(count($this->error) == 0){
      $slug = $request->category_slug;
      /*get total count*/
      $post =  Post::query();
      $post->where(['posts.post_type'=>'2','posts.status'=>'1']);
      $post->whereHas('category', function($q) use($slug){
        $q->where(['slug'=>$slug]);
      });
      $totalCount = $post->count();

      /*get data*/
      $post =  Post::query();
      $post->where(['posts.post_type'=>'2','posts.status'=>'1']);
      $post->whereHas('category', function($q) use($slug){
        $q->where(['slug'=>$slug]);
      });
      $post->orderBy('posts.updated_at','desc');
      if(!empty($request->limit)){
        $post->limit($request->limit);
        $post->offset(($request->page - 1) * $request->limit);
      }
      $post->orderBy('posts.created_at','desc');
      $posts = $post->get(['id','title','slug','category_id','image','content','created_at']);
      if(count($posts)>0){
        foreach($posts as $key=>$post){
          $post->image = url('images/posts/video/listing',$post->image);
          $post->user_name = 'Jhone Smith';
          $post->category = $post->category;
        }
        $this->response['status'] = "1";
        $this->response['data']['total_count'] = $totalCount;
        $this->response['data']['posts'] = $posts;
      }
      else{
        $this->response['data']['error'] = $this->langError(['Sorry there is no data to display.']);
      }
    }
    else{
       $this->response['data']['error'] = $this->langError($this->error);
    }
    $this->sendResponse($this->response);
  }

}
