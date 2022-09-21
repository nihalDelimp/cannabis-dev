<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Auth;
use App\Models\User;
use App;

class DashboardController extends Controller{
  public function __construct(){
    parent::__construct();
    //$this->middleware('auth');
  }

  public function index(Request $request){
    //dd("user", $request->all());
    //dd(auth()->user());
    $pageHeading = "dashboard";
    $user = $this->login_account;
    // dd($user);
    return view('admin.dashboard.index', compact('pageHeading','user'));
  }

  public function editProfile(Request $request){
    $pageHeading = "Profile Edit";
    $account = Auth::user();
    $employee  = User::findOrFail($account->id);
    return view('admin.dashboard.profile_edit', compact('pageHeading','employee'));
  }

  public function updateProfile(Request $request){
    $validate['name'] = 'required';
    //$validate['email'] = 'required|unique:users,email,'.$account->id;
    if(!empty($request->password)){
      $validate['password'] = 'required|min:6|confirmed';
      $validate['password_confirmation'] = 'required|min:6';
    }
    if(!empty($validate)){
      $request->validate($validate);
    }
    $update = array();
    if(!empty($request->password)){
      $update['password'] = Hash::make($request->password);
    }
    $update['name'] = $request->name;
    User::whereId($this->login_account->id)->update($update);
    return redirect()->back()->with('success', 'Profile Data saved successfully.');
  }

}
