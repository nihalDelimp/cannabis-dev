<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use File;
use Image;
use ImageResize;

class VideoController extends Controller{
  public function __construct(){
    parent::__construct();
    //$this->middleware('adminAuth');
  }

  public function index(){
    $pageHeading = "Manage Video";
    $categories = Category::where(['post_type'=>'2','status'=>'1'])->get();
    return view('admin.video.index',compact('pageHeading','categories'));
  }

  public function create(){
    $pageHeading = "Add Video";
    $categories = Category::where(['post_type'=>'2','status'=>'1'])->get();
    $tags = Tag::where(['post_type'=>'2','status'=>'1'])->get();
    return view('admin.video.create',compact('pageHeading','categories','tags'));
  }

  public function edit(Request $request){
    $id = $request->segment(4);
    $pageHeading = "Update Video";
    $video = Post::where(['id'=>$id,'post_type'=>'2'])->first();
    $video->tags = $video->tags->pluck('id')->toArray();
    $categories = Category::where(['post_type'=>'2','status'=>'1'])->get();
    $tags = Tag::where(['post_type'=>'2','status'=>'1'])->get();
    return view('admin.video.edit',compact('pageHeading','video','categories','tags'));
  }

  public function store(Request $request){
    //dd($request->all());
    $image = $request->file('image');
    $validate['title'] = 'required|unique:posts';
    $validate['sub_title'] = 'required';
    $validate['content'] = 'required';
    $validate['status'] = 'required';
    $validate['link_id'] = 'required';
    $validate['category_id'] = 'required';
    $validate['image'] = 'required|mimes:jpeg,png,jpg|max:51200';
    $messages = [];
    $attributes = ['category_id'=>'category','sub_title'=>'Sub Title','link_id'=>'Youtube Link Id'];
    $validator = Validator::make($request->all(),$validate,$messages,$attributes);
    if($validator->fails()){
      return redirect()->back()->withInput()->withErrors($validator->errors());
    }
    $insert = array();
    $insert['title'] = $request->title;
    $insert['slug'] = Str::slug($request->title, '-');
    $insert['sub_title'] = $request->sub_title;
    $insert['content'] = $request->content;
    $insert['status'] = $request->status;
    $insert['link_id'] = $request->link_id;
    $insert['category_id'] = $request->category_id;
    $insert['post_type'] = 2;
    $tags_id = $request->tags_id;
    if(!empty($image)){
      $image_path = Storage::disk('admin')->put('images/posts/video',$image);
      $video_image_url = Storage::disk('admin')->url($image_path);
      $insert['image'] = basename($video_image_url);
      $thumb_bassename_image = basename($video_image_url);
      $file_name = time().".".$image->getClientOriginalExtension();

      $destinationPath = public_path('/thumbnail');
      File::makeDirectory($destinationPath, $mode = 0777, true, true);
      $imageUpload = Image::make($image)->resize(320,240)->save($destinationPath.'/'.$file_name);
      $thumbnail_image_path = Storage::disk('admin')->put('images/posts/video/listing/'.$thumb_bassename_image,$imageUpload, 'public');
      $deletefile_path = $destinationPath.'/'.$file_name;  
      File::delete($deletefile_path);
      // $video_thumbnail_image_url = Storage::disk('admin')->url('images/posts/video/thumbnail/'.$thumb_bassename_image);
      
    }
    // if(!empty($image)){
    //   $imageHeight = ImageResize::make($image)->height();
    //   $imageWidth = ImageResize::make($image)->width();
    //   $destinationPath = public_path('images/posts/video');

    //   File::makeDirectory($destinationPath, $mode = 0777, true, true);
    //   $insert['image'] = time().'-'.$insert['slug'].'.'.$image->getClientOriginalExtension();
    //   File::makeDirectory($destinationPath.'/listing', $mode = 0777, true, true);


    //   $img = ImageResize::make($image->getRealPath());

    //   $img->orientate();
    //   $img->resize(360, 180, function ($constraint){
    //   $constraint->aspectRatio();})->save($destinationPath.'/listing/'.$insert['image']);

    //   //
    //   File::makeDirectory($destinationPath.'/main/', $mode = 0777, true, true);
    //   if($imageHeight > 450 || $imageWidth > 760){
    //     $img = ImageResize::make($image->getRealPath());
    //     $img->orientate();
    //     $img->resize(760, 450, function ($constraint){
    //     $constraint->aspectRatio();})->save($destinationPath.'/main/'.$insert['image']);
    //   }
    //   else{
    //     $image->move($destinationPath.'/main/', $insert['image']);
    //   }
    //   $image->move($destinationPath, $insert['image']);
    // }
    if($request->is_feature) {
      $videos = Post::where('is_feature', '1')->get();
      $videos->map(function($item, $key) {
        $item->is_feature = '0';
        $item->save();
      });

      $insert['is_feature'] =  '1';
    }

    $video = Post::create($insert);
    if(!empty($tags_id)){
      $tags = Tag::find($tags_id);
      $video->tags()->attach($tags);
    }

    return redirect(route('video.index',app()->getLocale()))->with('success', 'Video added successfully.');
  }

  public function update(Request $request){
    $id = $request->segment(4);
    $image = $request->file('image');
    $validate['title'] = 'required|unique:posts,title,'.$id;
    $validate['sub_title'] = 'required';
    $validate['content'] = 'required';
    $validate['status'] = 'required';
    $validate['category_id'] = 'required';
    if(!empty($image)){
      $validate['image'] = 'mimes:jpeg,png,jpg|max:51200';
    }
    $messages = [];
    $attributes = ['category_id'=>'category','sub_title'=>'Sub Title'];
    $validator = Validator::make($request->all(),$validate,$messages,$attributes);
    if($validator->fails()){
      return redirect()->back()->withInput()->withErrors($validator->errors());
    }
    $update = array();
    $update['title'] = $request->title;
    $update['slug'] = Str::slug($request->title, '-');
    $update['sub_title'] = $request->sub_title;
    $update['status'] = $request->status;
    $update['content'] = $request->content;
    $update['category_id'] = $request->category_id;
    // if(!empty($image)){
    //   $imageHeight = ImageResize::make($image)->height();
    //   $imageWidth = ImageResize::make($image)->width();
    //   $destinationPath = public_path('images/posts/video');

    //   File::makeDirectory($destinationPath, $mode = 0777, true, true);
    //   $update['image'] = time().'-'.$update['slug'].'.'.$image->getClientOriginalExtension();
    //   File::makeDirectory($destinationPath.'/listing', $mode = 0777, true, true);


    //   $img = ImageResize::make($image->getRealPath());

    //   $img->orientate();
    //   $img->resize(360, 180, function ($constraint){
    //   $constraint->aspectRatio();})->save($destinationPath.'/listing/'.$update['image']);

    //   //
    //   File::makeDirectory($destinationPath.'/main/', $mode = 0777, true, true);
    //   if($imageHeight > 450 || $imageWidth > 760){
    //     $img = ImageResize::make($image->getRealPath());
    //     $img->orientate();
    //     $img->resize(760, 450, function ($constraint){
    //     $constraint->aspectRatio();})->save($destinationPath.'/main/'.$update['image']);
    //   }
    //   else{
    //     $image->move($destinationPath.'/main/', $update['image']);
    //   }
    //   $image->move($destinationPath, $update['image']);
    //   $this->removeNewsImage($id);
    // }
    if(!empty($image)){
      $image_path = Storage::disk('admin')->put('images/posts/video',$image);
      $video_image_url = Storage::disk('admin')->url($image_path);
      $update['image'] = basename($video_image_url);
      $thumb_bassename_image = basename($video_image_url);
      $file_name = time().".".$image->getClientOriginalExtension();

      $destinationPath = public_path('/thumbnail');
      File::makeDirectory($destinationPath, $mode = 0777, true, true);
      $imageUpload = Image::make($image)->resize(320,240)->save($destinationPath.'/'.$file_name);
      $thumbnail_image_path = Storage::disk('admin')->put('images/posts/video/listing/'.$thumb_bassename_image,$imageUpload, 'public');
      $deletefile_path = $destinationPath.'/'.$file_name;  
      File::delete($deletefile_path);

      // $video_thumbnail_image_url = Storage::disk('admin')->url('images/posts/video/thumbnail/'.$thumb_bassename_image);
      
    }
    $tags_id = $request->tags_id;

    if($request->is_feature) {
      $videos = Post::where('is_feature', '1')->get();
      $videos->map(function($item, $key) {
        $item->is_feature = '0';
        $item->save();
      });

      $update['is_feature'] =  '1';
    }
    Post::whereId($id)->update($update);
    if(!empty($tags_id)){
      $news = Post::find($id);
      $news->tags()->sync($tags_id);
    }
    return redirect(route('video.index',app()->getLocale()))->with('success', 'Video is successfully updated');
  }

  public function getSearchableFields($request){
    $search = [];
    $searchableFields = ['title','category_id','from_date','to_date'];
    foreach($searchableFields as $field){
      if(!empty($request[$field])){
        $search[$field] = $request[$field];
      }
    }
    return $search;
  }

  public function getVideo(Request $request){
    $search = $this->getSearchableFields($request->all());
    $columns = array(0=>'id', 1=>'title', 2=>'category_id', 3=>'status', 4=>'created_at', 5=>'id');

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    $temp =  Post::query();
    if(count($search) > 0){
        $sh = (object)$search;
        if(!empty($sh->title)){
          $temp->where('posts.title','LIKE',"%{$sh->title}%");
        }
        if(!empty($sh->category_id)){
          $temp->where('posts.category_id','=',$sh->category_id);
        }
    }
    $temp->where('posts.post_type','=','2');
    $temp->offset($start);
    $temp->limit($limit);
    $temp->orderBy($order,$dir);
    $temps = $temp->get(['posts.*']);
      $temp =  Post::query();
      if(count($search) > 0){
        $sh = (object)$search;
        if(!empty($sh->title)){
          $temp->where('posts.title','LIKE',"%{$sh->title}%");
        }
        if(!empty($sh->category_id)){
          $temp->where('posts.category_id','=',$sh->category_id);
        }
      }
      $temp->where('posts.post_type','=','2');
      $totalData  = $temp->count();
      $totalFiltered = $totalData;
    $data = array();
    if(!empty($temps)){
      foreach ($temps as $key=>$temp){
        $show =  route('video.show', ['video' => $temp->id, 'locale' => app()->getLocale()]);
        $edit =  route('video.edit', ['video' => $temp->id, 'locale' => app()->getLocale()]);
        $destroy = route('video.destroy', ['video' => $temp->id, 'locale' => app()->getLocale()]);
        $nestedData['sn'] = ($start+$key+1);
        $nestedData['name'] = $temp->title;
        $nestedData['category'] = $temp->category;
        $nestedData['status'] = ($temp->status == '1')?langMessage('Active'):langMessage('Inactive');
        $nestedData['created_at'] = $this->getDateTime($temp->created_at,'Y, F d');
        $nestedData['options'] = "";
        $nestedData['options'] .= "&nbsp;&nbsp;<a href='{$edit}' class='btn btn-warning'><i class='fa fa-pencil' aria-hidden='true'></i></a>";
        $nestedData['options'] .= "&nbsp;&nbsp;<form style='display:inline-block;' action='{$destroy}' method='post'>
          <input type='hidden' name='_token' value='".csrf_token()."'>
          <input type='hidden' name='_method' value='DELETE'>
          <button type='submit' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'><i class='fa fa-trash' aria-hidden='true'></i></button>
        </form>";
        $data[] = $nestedData;
      }
    }

    $json_data = array(
    "draw"            => intval($request->input('draw')),
    "recordsTotal"    => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data"            => $data
    );
    echo json_encode($json_data);
  }

  public function destroy(Request $request){
    $id = $request->segment(4);
    $video = Post::findOrFail($id);
    if(!empty($video->image)  && file_exists(public_path('images/posts/video/'.$video->image))){
      @unlink(public_path('images/posts/video/'.$video->image));
      if(getcwd().'images/posts/video/'.$video->image){
        @unlink(getcwd().'/public/images/posts/video/main/'.$video->image);
        @unlink(getcwd().'/public/images/posts/video/listing/'.$video->image);
      }
    }
    $video->tags()->detach();
    $video->delete();
    return redirect(route('video.index',app()->getLocale()))->with('success', 'Video is deleted successfully.');
  }

  public function removeNewsImage($news_id){
    $news = Post::findOrFail($news_id);
    if(!empty($news->image)  && file_exists(public_path('images/posts/video/'.$news->image))){
      @unlink(public_path('images/posts/video/'.$news->image));
      if(getcwd().'images/posts/video/'.$news->image){
        @unlink(getcwd().'/public/images/posts/video/main/'.$news->image);
        @unlink(getcwd().'/public/images/posts/video/listing/'.$news->image);
      }
    }
  }
}
