<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
//use Intervention\Image\ImageManagerStatic as Image;
use URL;
use File;
use Image;
use ImageResize;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
//use Intervention\Image\ImageManager;

class EventApiController extends Controller{
  public function __construct(){
    parent::__construct();
    $this->response = $this->error = array();
    $this->response['status'] = "0";
    //$this->middleware('adminAuth');
  }

  public function listEvent() {
    $event = Event::paginate(6);
    
    if(!empty($event)) {
        $this->response['status'] = "1";
        $this->response['data']['event'] = $event;
        $this->response['data']['count'] = Event::get()->count();
      }
      else {
        $this->response['data']['error'] = $this->langError(['sorry there is no data to display.']);
      }
      $this->sendResponse($this->response);
  }
  function showEvent($id)
  {
      //$event= Event::find($id);
      $event= Event::where('slug',$id)->first();
      
      if(!empty($event)){
      
          $this->response['status'] = "1";
          $this->response['data']['event'] = $event;
      } else {
        $this->response['status'] = "0";
        $this->response['data']['msg'] = "Sorry Invalid event..";
      }
      
      return $this->sendResponse($this->response);
  }
  function deleteEvent($id)
  {
    
      $Event= Event::find($id);
    
    
    if ($Event) {
      $Event->delete();
      $this->response['status'] = "1";
      $this->response['data']['msg'] = $id.' Event delete successfully. ';
    
    }else {
    $this->response['status'] = "0";
    $this->response['data']['msg'] = 'Opss !.. somthing wrong. ';
    }
    return $this->sendResponse($this->response);
  }
  public function eidtEvent(Request $request, $id){
    $data = [];
     $data = [
       'name' => $request->name,
       'discription' => $request->discription,
       'start_date' => $request->start_date,
       'end_date' => $request->end_date,
       'status' => $request->status,
       //'qr_code' => $request->qr_code,
       //'special_link' => $request->special_link,
     ];
     if($request->image_path){
       $data['image_path'] = $request->image_path;
     }
     if($id != null){
       $event = Event::find($id);
       if($request->status == 1) {
        $update_event = Event::where('id','!=',$id)->update(['status' => '0']);
       
        }
       $event->update($data);
      
       if(!empty($event)){
       //dd($user);
         
         $this->response['status'] = "1";
         $this->response['data']['event'] = $event;
       }
       else{
         $this->response['data']['error'] = $this->langError(['sorry there is no data to display.']);
       }
       $this->sendResponse($this->response);
 
     }
     else{
       $this->response['data']['error'] = $this->langError($this->error);
     }
     $this->sendResponse($this->response);
     
  }
  public function storeEvent(Request $request){
    
    //dd($request->all());
   
    //$QrCode = QrCode::generate('scan to me');
    
    $data = [];
    $data = [
      'name' => $request->name,
      'discription' => $request->discription,
      'start_date' => $request->start_date,
      'end_date' => $request->end_date,
      'image_path' => $request->image_path,
      'status' => $request->status,
      //'qr_code' => $request->qr_code,
      
    ];
    
    //dd($data);
    // $validation['email'] = 'required|email|unique:users';
    // $validation['phone'] = 'required|unique:users';
    //$validation['user_id'] = 'required';
    
    $validation = [];
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
      $event = Event::create($data);
      if($request->status == 1) {
        $update_event = Event::where('id','!=',$event->id)->update(['status' => '0']);
      }
      if(!empty($event)){
      //dd($user);
        $event->special_link = $event->id."_".strtr($event->name,[' '=>'_']).'_'.md5(time());
        $event->save();
        
        $this->response['status'] = "1";
        $this->response['data']['event'] = $event;
      }
      else{
        $this->response['data']['error'] = $this->langError(['sorry there is no data to display.']);
      }
    }
    else{
      $this->response['data']['error'] = $this->langError($this->error);
    }
    $this->sendResponse($this->response);
    
    
    // $request->title;
    // $this->sendResponse($post);
  }

}
