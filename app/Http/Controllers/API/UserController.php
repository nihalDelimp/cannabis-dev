<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;

class UserController extends Controller
{
    public function __construct(){
        parent::__construct();
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
    function view()
    {
        // $user= User::find($id);
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus);
        // if(!empty($user)){
        
        //     $this->response['userId'] = $user->id;
        //     $this->response['status'] = "1";
        //     $this->response['data']['user'] = $user;
        // }
        // $this->sendResponse($this->response);
    }
}
