<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Models\EventJoinList;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use DB;
use JWTAuth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\createNewPassword;
use App\Mail\resetPassword;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function __construct(){
        //parent::__construct();
        //$this->user = JWTAuth::parseToken()->authenticate();
        $this->response = $this->error = array();
        $this->response['status'] = "0";
    }
    function index(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        
             $token = $user->createToken('my-app-token')->plainTextToken;
        
            $response = [
                'user' => $user,
                'token' => $token
            ];
        
             return response($response, 201);
    }
    function showAuth()
    {
        // $user= User::find($id);
        $user = Auth::user(); 
        //return response()->json(['success' => $user], $this->response);
        if(!empty($user)){
        
            $this->response['userId'] = $user->id;
            $this->response['status'] = "1";
            $this->response['data']['user'] = $user;
        }
        $this->sendResponse($this->response);
    }
    function showUser($id)
    {
        $user= User::find($id);
        
        if(!empty($user)){
        
            $this->response['userId'] = $user->id;
            $this->response['status'] = "1";
            $this->response['data']['user'] = $user;
        }
        
        return $this->sendResponse($this->response);
    }
    
    function deleteUser($id)
    {
        $user= User::find($id);
       
        
        if ($user) {
            $user->delete();
            $this->response['status'] = "1";
            $this->response['data']['msg'] = $id.' user delete successfully. ';
        
        } else {
            $this->response['status'] = "0";
            $this->response['data']['msg'] = 'Opss !.. something went wrong. ';
        }
        return $this->sendResponse($this->response);
    }
    function userList()
    {
        $user= User::where('role','!=',1)->get();
        
        if(!empty($user)){
        
            $this->response['status'] = "1";
            $this->response['data']['user'] = $user;
        }
        
        return $this->sendResponse($this->response);
    }
    function userSearchList($slug)
    {
        //$user= User::where('role','!=',1)->get();
        $query= User::where('role','!=',1);
        $user= new User;
        $table = $user->getTable();
        $searchable = \DB::getSchemaBuilder()->getColumnListing($table);
        array_splice($searchable,0, 2);
        array_splice($searchable,10, 5);
        //dd($searchable);
        foreach($searchable as $columns) {
            // if($query->where($columns, 'LIKE', "%{$slug}%") ) {

            // }
            $query->orWhere($columns, 'LIKE', "%{$slug}%");
           
        }
        $result = $query->get();
        
       
       
        if(!empty($result)){
        
            $this->response['status'] = "1";
            $this->response['data']['user'] = $result;
        }
        
        return $this->sendResponse($this->response);
    }

    ////////////////
    public function authenticate(Request $request)
    {
       
        $credentials = $request->only('email', 'password');
        //dd($credentials);
        // if ($token = $this->guard()->attempt($credentials)) {
        //     return $this->respondWithToken($token);
        // }

        // return response()->json(['error' => 'Unauthorized'], 401);
        
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required'
            // 'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is validated
        //Crean token
        //dd(JWTAuth::attempt($credentials));
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                	'success' => false,
                	'message' => 'Login credentials are invalid.',
                ], 400);
            }
           
        } catch (JWTException $e) {
            
    	return $credentials;
            return response()->json([
                	'success' => false,
                	'message' => 'Could not create token.',
                ], 500);
        }
       
 		//Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'status' => "1",
            'token' => $token,
            'user' => auth()->user(),
            // 'user' => auth()->user(),
        ]);
    }
 
    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

		//Request is validated, do logout        
        try {
            JWTAuth::invalidate($request->token);
 
            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
 
    public function get_user(Request $request)
    {
        $user = Auth::user(); 
        //dd($user);
        // $this->validate($request, [
        //     'token' => 'required'
        // ]);
        
        // $user = JWTAuth::authenticate($request->token);
        
        return response()->json(['user' => $user]);
    }
    public function user_account_update(Request $request)
    {
        $user = Auth::user(); 
        $data = [];
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'organization' => $request->organization,
            'dob' => $request->dob,
            'position' => $request->position,
            'instagram_name' => $request->instagram_name,
            'insterested_status' => $request->insterested_status,
            'invited_owner' => $request->invited_owner
            
        ];
        if(!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        if(!empty($user)){
        //dd($user);
            
            $this->response['status'] = "1";
            $this->response['data']['user'] = $user;
        }
        else{
            $this->response['data']['error'] = $this->langError(['sorry there is no data to display.']);
        }
        $this->sendResponse($this->response);
        //return response()->json(['user' => $user]);
    }
    public function updateUser(Request $request , $id)
    {
        $user = User::find($id); 
        if($user->role == 1){
            $this->response['data']['error'] = $this->langError(['sorry You can not update this user.']);
        } else {
            $data = [];
            $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'organization' => $request->organization,
            'dob' => $request->dob,
            'position' => $request->position,
            'instagram_name' => $request->instagram_name,
            'insterested_status' => $request->insterested_status,
            'invited_owner' => $request->invited_owner
            // 'password'=>Hash::make($request->password),
            ];
            if(!empty($request->password)) {
                $data['password'] = Hash::make($request->password);
            }
            $user->update($data);
            if(!empty($user)){
            //dd($user);
                
                $this->response['status'] = "1";
                $this->response['data']['user'] = $user;
            }
            else{
                $this->response['data']['error'] = $this->langError(['Sorry there is no data to display.']);
            }
            }
            
            $this->sendResponse($this->response);
        //return response()->json(['user' => $user]);
    }
    public function loginPasswordUser(Request $request , $token)
    {
       
        try {
            $password = $request->password; 

            $confirm_password = $request->confirm_password;  
            if($password == $confirm_password) {
                $tokenData = DB::table('password_resets')
                ->where('token', $token)->first();
                 
                // Redirect the user back to the password reset request form if the token is invalid
                if (!$tokenData) { 
                    return  response()->json([
                        'message' => 'Link has been expired!.',
                        'success' => true,
                        'status' => "0"
                    ]);
                }
                // if (!$tokenData) { dd("tokendata"); return view('auth.passwords.email'); }

                $user = User::where('email', $tokenData->email)->first();
                
                // Redirect the user back if the email is invalid
                if (!$user) { 
                    //dd("jdkkj");
                    return  response()->json([
                        'message' => 'Email not found',
                        'success' => true,
                        'status' => "0"
                    ]);
                }
                //Hash and update the new password
                $user->password = \Hash::make($password);
                $error = false;
                if($user->update()) {
                    $error = true;
                }
                
                DB::table('password_resets')->where('email', $user->email)->delete();
                $this->response['data']['user'] = $user;
                //$this->sendResponse($this->response);
                //////////////////////////
                
                $arr = ['email'=>$user->email, 'password'=>$password];
                $credentials = $arr;
                //dd($credentials);
                try {
                    if (! $token = JWTAuth::attempt($credentials)) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Login credentials are invalid.',
                        ], 400);
                    }
                
                } catch (JWTException $e) {
                    
                return $credentials;
                    return response()->json([
                            'success' => false,
                            'message' => 'Could not create token.',
                        ], 500);
                }
            
                //Token created, return with success response and jwt token
                return response()->json([
                    'success' => true,
                    'status' => "1",
                    'token' => $token,
                    'user' => $user,
                ]);



            }
            else {
                return response()->json(
                    [
                        'email' => trans('Password and Confirm password are not match .'),
                        'status' => '0',
                        'success' => false
                    ]);
                
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

            
       
       // return $this->sendResponse($result);
    }
    public function checkMail(Request $request) {
       
        try{
            
            $email = $request->email;
            $result =  User::where('email', $email)->first();
            if( $result != null) {
                $this->response['data'] = $result;
                $this->response['auth'] = JWTAuth::parseToken()->authenticate();
                $this->response['status'] = "1";
                $this->sendResponse($this->response);
                
            } else {
                $this->response['data'] = '';
                $this->response['status'] = "0";
                $this->response['message'] = "Registration first";
                //dd($this->response);
                $this->sendResponse($this->response);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        

    }
    public function sendMail(Request $request) {
        
        try{
            
            $email = $request->email;
            $result =  User::where('email', $email)->first();
            if( $result != null) {
                $getData = DB::table('password_resets')->where('email', $request->email)->first();
                if($getData == null) {
                    DB::table('password_resets')->insert([
                        'email' => $request->email,
                        'token' => Str::random(60),
                        'created_at' => Carbon::now()
                        ]);
                    $getData = DB::table('password_resets')->where('email', $request->email)->first();
                }
                $link = env('SPA_URL').'/reset-password/'.$getData->token;
                $body = [
                'url' => $link,
                'name' => $email
                ];
            
                Mail::to($email)->send(new resetPassword($body));
                $this->response['status'] = "1";
                $this->response['message'] = "We have sent you a Link on your email.";
                $this->sendResponse($this->response);
                
            } else {
                $this->response['status'] = "0";
                $this->response['message'] = "Registration first";
                //dd($this->response);
                $this->sendResponse($this->response);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        

    }
    public function validateUser(Request $request) {
        try {
            $user_id = $request->user_id;
            // $event_id = $request->event_id;
            // if(!Event::find($request->event_id)) {
            //     $this->response['success'] = true;
            //     $this->response['status'] = "0";
            //     $this->response['message'] = "Event id not match.";
            //     $this->sendResponse($this->response);
            // }
            if(!User::find($request->user_id)) {
            $this->response['success'] = true;
            $this->response['status'] = "0";
            $this->response['message'] = "User id not match.";
            $this->sendResponse($this->response);
            }
            if(User::find($request->user_id)->role != 3) {
            $this->response['success'] = true;
            $this->response['status'] = "0";
            $this->response['message'] = "You have not access to validate this production.";
            $this->sendResponse($this->response);
            }
            // $event = Event::find($request->event_id);
            // $event->validate = 1;
            // $event->save();
            $this->response['success'] = true;
            $this->response['status'] = "1";
            $this->response['message'] = "User is validate successfull .";
            $this->sendResponse($this->response);



        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function validateProduction(Request $request) {
        try {
            $user_id = $request->user_id;
            $event_id = $request->event_id;
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
            if($result != null) {
        
            if($result->is_validate == 1) {
                $this->response['eventList'] = $result;
                $this->response['success'] = true;
                $this->response['status'] = "0";
                $this->response['message'] = "User already validated.";
                $this->sendResponse($this->response);
            }
            $result->is_validate = 1;
            $result->save();
        

        
            $this->response['eventList'] = $result;
            $this->response['success'] = true;
            $this->response['status'] = "1";
            $this->response['message'] = "User is validate successfull .";
            $this->sendResponse($this->response);
            } else {
            $this->response['eventList'] = '';
            $this->response['success'] = false;
            $this->response['status'] = "0";
            $this->response['message'] = "User is not exist in Production join list .";
            $this->sendResponse($this->response);
            }



        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
        if(isset($request->other_position)) {
            $data['other_position'] = $request->other_position;
        }
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

}
