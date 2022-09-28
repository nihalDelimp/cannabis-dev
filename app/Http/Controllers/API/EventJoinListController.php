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
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class EventJoinListController extends Controller{
  public function __construct(){
    // parent::__construct();
    $this->user = JWTAuth::parseToken()->authenticate();
    //dd($this->user);
    $this->response = $this->error = array();
    $this->response['status'] = "0";
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

  

}
