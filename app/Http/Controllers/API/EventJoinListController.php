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
use App\Mail\sendQR_CodeNotification;
use Illuminate\Support\Str;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class EventJoinListController extends Controller{
  public function __construct(){
    // parent::__construct();
    //$this->user = JWTAuth::parseToken()->authenticate();
    //dd($this->user);
    $this->response = $this->error = array();
    $this->response['status'] = "0";
  }
  
  public function getEventJoinLists(){
    $this->response = EventJoinList::get();
    $this->sendResponse($this->response);
  }
  public function UserJoinLists($id = null){
    if($id != null) {
      //$this->response['eventList'] = EventJoinList::where('user_id',$id)->get();
       $evm = EventJoinList::where('user_id',$id)->paginate(6);
       $evm_count = EventJoinList::where('user_id',$id)->get()->count();
      // $this->response['events'] = EventJoinList::where('user_id',$id)->select('event_id')->get();
      foreach($evm as $key => $val) {
        $this->response['event'][$key] = Event::find($val->event_id);
      } 
      //dd($this->response['event']);

      $this->response['status'] = "1";
      $this->response['count'] = $evm_count;
      $this->response['message'] = "Data received successfully ";
      

    } else {
      $this->response['status'] = "0";
      $this->response['message'] = "You are not join any event. ";
    }
    
    $this->sendResponse($this->response);
  }
  public function eventJoinLists(Request $request) {
    try{
      if(!Event::find($request->event_id)) {
        $this->response['success'] = true;
        $this->response['status'] = "0";
        $this->response['message'] = "Event id not match.";
        $this->sendResponse($this->response);
      }
      if(!User::find($request->user_id)) {
        $this->response['success'] = true;
        $this->response['status'] = "0";
        $this->response['message'] = "User id not match.";
        $this->sendResponse($this->response);
      }
      $result = EventJoinList::where('event_id',$request->event_id)->where('user_id',$request->user_id)->first();
      //dd($request->all());
      //dd($result);
      if($result === null) {
        if (!is_int($request->event_id) || !is_int($request->user_id) ){
          $this->response['success'] = true;
          $this->response['status'] = "0";
          $this->response['message'] = "something went wrong!.";
          $this->sendResponse($this->response);
        }
        $insert = [];
        $insert = [
          'event_id' => $request->event_id,
          'user_id' => $request->user_id,
          'event_status' => 1,
        ];
        EventJoinList::where('user_id', $request->user_id)->update(['event_status' => 0]);
      

        $eventList = EventJoinList::create($insert);
        $this->response['eventList'] = $eventList;
        $this->response['status'] = 1;
        
        $user = User::find($request->user_id);
        $event = Event::find($request->event_id);
        // $user->event_status = 1;
        // $user->save();
        $email = $user->email;
        $body = [
          'qr_code' =>  QrCode::size(100)->generate(env('SPA_URL').'/rsvp/'.$event->special_link.'-'.$request->user_id),
          'name' => $user->name,
          'email' => $user->email,
          'event_name' => $event->name,
          'event_time' => Carbon::parse($event->start_date)->format('m-d-Y'),
        ];
        Mail::to($email)->send(new sendQR_CodeNotification($body));

      } else {

        $this->response['status'] = 0;
        $this->response['message'] = "You are already exist in this Event.";//$this->langError(['Record exist already.']);
      }
      $this->sendResponse($this->response);
    } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
    }

  }
 

  

}
