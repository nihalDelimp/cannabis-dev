<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use ImageResize;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventController extends Controller{
  public function __construct(){
    parent::__construct();
    //$this->middleware('adminAuth');
  }

  public function index(){
    $pageHeading = "Manage Events";
    $categories = Event::all();
    return view('admin.events.index',compact('pageHeading','categories'));
  }

  public function create(){
    $pageHeading = "Add Events";
    $categories = Event::where(['status'=>'1'])->get();
    return view('admin.events.create',compact('pageHeading','categories'));
  }

  public function edit(Request $request){
    $id = $request->segment(4);
    $pageHeading = "Update Events";
    $news = Event::find($id);
    // $news = Event::where(['id'=>$id,'post_type'=>'1'])->first();
    
    return view('admin.events.edit',compact('pageHeading','news'));
  }

  public function store(Request $request){
    // dd($request->all());
    $image = $request->file('image_path');
    $validate['name'] = 'required';
    // $validate['sub_title'] = 'required';
    // $validate['content'] = 'required';
    // $validate['status'] = 'required';
    // $validate['category_id'] = 'required';
    $validate['image_path'] = 'required|mimes:jpeg,png,jpg|max:51200';
    $messages = [];
    $attributes = [];
    $validator = Validator::make($request->all(),$validate,$messages,$attributes);
    if($validator->fails()){
      return redirect()->back()->withInput()->withErrors($validator->errors());
    }
    $insert = array();
    $insert['name'] = $request->name;
    $insert['start_date'] = $request->start_date;
    $insert['end_date'] = $request->end_date;
    $insert['discription'] = $request->discription;
    $insert['user_id'] = auth()->user()->id;
    //$insert['image_path'] = $request->image_path;
    $insert['status'] = $request->status;
    
    if(!empty($image)){
      $imageHeight = ImageResize::make($image)->height();
      $imageWidth = ImageResize::make($image)->width();
      $destinationPath = public_path('images/events');

      File::makeDirectory($destinationPath, $mode = 0777, true, true);
      $insert['image_path'] = time().'.'.$image->getClientOriginalExtension();
      File::makeDirectory($destinationPath.'/listing', $mode = 0777, true, true);


      $img = ImageResize::make($image->getRealPath());

      $img->orientate();
      $img->resize(360, 180, function ($constraint){
      $constraint->aspectRatio();})->save($destinationPath.'/listing/'.$insert['image_path']);

      //
      File::makeDirectory($destinationPath.'/main/', $mode = 0777, true, true);
      if($imageHeight > 450 || $imageWidth > 760){
        $img = ImageResize::make($image->getRealPath());
        $img->orientate();
        $img->resize(760, 450, function ($constraint){
        $constraint->aspectRatio();})->save($destinationPath.'/main/'.$insert['image_path']);
      }
      else{
        $image->move($destinationPath.'/main/', $insert['image_path']);
      }
      $image->move($destinationPath, $insert['image_path']);
    }
    $news = Event::create($insert);
    // if(!empty($tags_id)){
    //   $tags = Tag::find($tags_id);
    //   $news->tags()->attach($tags);
    // }
    return redirect(route('events.index',app()->getLocale()))->with('success', 'Events added successfully.');
  }

  public function update(Request $request){
    $id = $request->segment(4);
    // echo "id-".$id; 
    // dd($request->all());
    
    $image = $request->file('image_path');
    $validate['name'] = 'required';
    // $validate['sub_title'] = 'required';
    // $validate['content'] = 'required';
    // $validate['status'] = 'required';
    // $validate['category_id'] = 'required';
    if(!empty($image)){
      $validate['image_path'] = 'mimes:jpeg,png,jpg|max:51200';
    }
    $messages = [];
    $attributes = [];
    $validator = Validator::make($request->all(),$validate,$messages,$attributes);
    if($validator->fails()){
      return redirect()->back()->withInput()->withErrors($validator->errors());
    }
    $update = array();
    $update['name'] = $request->name;
    $update['start_date'] = $request->start_date;
    $update['end_date'] = $request->end_date;
    $update['discription'] = $request->discription;
    $update['user_id'] = auth()->user()->id;
    $update['status'] = $request->status;

    if($request->hasFile('image_path'))
    {

    $image = $request->file('image_path');
    $filename = $image->getClientOriginalName();
    $extension = $image->getClientOriginalExtension();
    $destinationPath = public_path('/thumbnail');
    //$destinationPath = Storage::disk('admin')->url($id."/thumbnail");
    
    $base_path = Storage::disk('admin')->put($id, $image);
    $file_path = $image->getRealPath();
    

      //$img = Image::make($image)->resize(320, 240);
    // $ImageUpload = Image::make($image)->resize(320, 240)->encode($extension);
    //$ImageUpload = Image::make($file_path)->resize(320, 240);  
    //local store file
    // $ImageUpload = Image::make($image->path())->resize(320, 240)->save($destinationPath.'/'.$filename);
    // $filePath = $destinationPath.'/'.$ImageUpload->basename;
    // $file = File::get($filePath);
     
    // $thumbnail_path = Storage::disk('admin')->put('thumbnail/',(string) $file);
      
    // dd($thumbnail_path);
    // $img = Image::make($image)->resize(150, 250, function ($constraint) {$constraint->aspectRatio();});
    
    // $img->orientate();
    
    // $cloudpath = Storage::disk('admin')->put($id.'/thumbnail/', (string) $img->encode());
    //   dd($cloudpath);
    // dd(Storage::disk('admin')->url($id.'/thumbnail/'));
    // return Storage::disk('admin')->url($id.'thumbnail/'.$filename);


    //$thumbnail_path = Storage::disk('admin')->putFileAs($image->path(),$ImageUpload, $filename);

    // Storage::disk('admin')->put($id."/thumbnail",$image);
    
    //->save($image->getClientOriginalName());
    //return $update['thumbnail_path']->response('jpg');
    //dd($update['thumbnail_path']);
    //dd($thumbnail_path);

    //$thumbnailPath = Storage::disk('admin')->url($thumbnail_path);
    //dd($thumbnailPath);
  

  
    $update['image_path'] = Storage::disk('admin')->url($base_path);
     
      
      
    } else {
      $events = Event::find($id);
        if($events != null) {
          $update['image_path'] =  $events->image_path;
          $update['thumbnail_path'] =  $events->thumbnail_path;
        }
    }
    
    // if(!empty($image)){
    //   $imageHeight = ImageResize::make($image)->height();
    //   $imageWidth = ImageResize::make($image)->width();
    //   $destinationPath = public_path('images/events');

    //   File::makeDirectory($destinationPath, $mode = 0777, true, true);
    //   $update['image_path'] = time().'.'.$image->getClientOriginalExtension();
    //   File::makeDirectory($destinationPath.'/listing', $mode = 0777, true, true);
    //   $img = ImageResize::make($image->getRealPath());
    //   //dd($img);
    //   $img->orientate();
    //   $img->resize(360, 180, function ($constraint){
    //   $constraint->aspectRatio();})->save($destinationPath.'/listing/'.$update['image_path']);

    //   //
    //   File::makeDirectory($destinationPath.'/main/', $mode = 0777, true, true);
    //   if($imageHeight > 450 || $imageWidth > 760){
    //     $img = ImageResize::make($image->getRealPath());
    //     $img->orientate();
    //     $img->resize(760, 450, function ($constraint){
    //     $constraint->aspectRatio();})->save($destinationPath.'/main/'.$update['image_path']);
    //     //dd("ing-",$img);

    //   }
    //   else{
    //     $image->move($destinationPath.'/main/', $update['image_path']);
    //     //dd("move-",$image);

    //   }
    //   $image->move($destinationPath, $update['image_path']);
    //   $this->removeEventImage($id);
    // }
    // $tags_id = $request->tags_id;
    Event::find($id)->update($update);
   
    return redirect(route('events.index',app()->getLocale()))->with('success', 'News is successfully updated');
  }

  public function getSearchableFields($request){
    //dd($request['status']);
    $search = [];
    $searchableFields = ['name','status','start_date','end_date'];
    foreach($searchableFields as $field){
      if(!empty($request[$field])){
        $search[$field] = $request[$field];
      }
    }
    //dd($search);
    return $search;
  }

  public function getEvents(Request $request){
    $search = $this->getSearchableFields($request->all());
   ;
    $columns = array(0=>'id', 1=>'name', 2=>'date', 3=>'discription', 4=>'special_link', 5=>'status');

    $limit = $request->input('length');
    $start = $request->input('start');
    $order = $columns[$request->input('order.0.column')];
    $dir = $request->input('order.0.dir');

    $temp =  Event::query();
    //dd(count($search));
    if(count($search) > 0){
        $sh = (object)$search;

      // dd($sh);
        if(!empty($sh->name)){
          $temp->where('events.name','LIKE',"%{$sh->name}%");
        }
        if(!empty($sh->status)){
          $temp->where('events.status','=',$sh->status);
        }
        // if(!empty($sh->user_id)){
        //   $temp->where('events.user_id','=',$sh->user_id);
        // }
    }
    //$temp->where('posts.post_type','=','1');
    $temp->offset($start);
    $temp->limit($limit);
    $temp->orderBy($order,$dir);
    $temps = $temp->get();
    // $temps = $temp->get(['events.*']);
    //   $temp =  Event::query();
    //   if(count($search) > 0){
    //     $sh = (object)$search;
    //     if(!empty($sh->name)){
    //       $temp->where('events.name','LIKE',"%{$sh->name}%");
    //     }
    //     if(!empty($sh->user_id)){
    //       $temp->where('events.user_id','=',$sh->user_id);
    //     }
    //   }
      //$temp->where('posts.post_type','=','1');
      $totalData  = $temps->count();
      $totalFiltered = $totalData;
    $data = array();
    
    if(!empty($temps)){
      foreach ($temps as $key=>$temp){
        $qr_code = QrCode::size(100)->generate(route('events.edit', [ app()->getLocale(),$temp->id]));
       //$show =  route('events.show', ['events' => $temp->id, 'locale' => app()->getLocale()]);
        $destroy = "destroy";//route('events.destroy', ['events' => $temp->id, 'locale' => app()->getLocale()]);
        $edit =  route('events.edit', [ app()->getLocale(),$temp->id]);
        
        $nestedData['sn'] = ($start+$key+1);
        $nestedData['name'] = $temp->name;
        $nestedData['start_date'] = $temp->start_date ? Carbon::parse($temp->start_date)->format('m/d/Y H:i:s'): "N/A";
        $nestedData['end_date'] = $temp->end_date ? Carbon::parse($temp->end_date)->format('m/d/Y H:i:s'): "N/A";
        $nestedData['discription'] = $temp->discription;
        $nestedData['image_path'] = $temp->image_path;
        $nestedData['status'] = $temp->status == 1? "Acitve" : "InActive";
        $nestedData['qr_code'] = " $qr_code ";
        $nestedData['special_link'] = $temp->special_link;
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
    $news = Post::findOrFail($id);
    if(!empty($news->image)  && file_exists(public_path('images/posts/news/'.$news->image))){
      @unlink(public_path('images/posts/news/'.$news->image));
      if(getcwd().'images/posts/news/'.$news->image){
        @unlink(getcwd().'/public/images/posts/news/main/'.$news->image);
        @unlink(getcwd().'/public/images/posts/news/listing/'.$news->image);
      }
    }
    $news->tags()->detach();
    $news->delete();
    return redirect(route('news.index',app()->getLocale()))->with('success', 'News is deleted successfully.');
  }

  public function removeNewsImage($news_id){
    $news = Post::findOrFail($news_id);
    if(!empty($news->image)  && file_exists(public_path('images/posts/news/'.$news->image))){
      @unlink(public_path('images/posts/news/'.$news->image));
      if(getcwd().'images/posts/news/'.$news->image){
        @unlink(getcwd().'/public/images/posts/news/main/'.$news->image);
        @unlink(getcwd().'/public/images/posts/news/listing/'.$news->image);
      }
    }
  }
  public function removeEventImage($id){
    $event = Event::findOrFail($id);
    if(!empty($event->image_path)  && file_exists(public_path('images/events/'.$event->image_path))){
      @unlink(public_path('images/events/'.$event->image_path));
      if(getcwd().'images/events/'.$event->image_path){
        @unlink(getcwd().'/public/images/events/main/'.$event->image_path);
        @unlink(getcwd().'/public/images/events/listing/'.$event->image_path);
      }
    }
  }
}
