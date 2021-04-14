<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Auth;
use App\User;
use App\Setting;
use App;

class DashboardController extends Controller{
  public function __construct(){
    parent::__construct();
    //$this->middleware('auth');
  }

  public function index(Request $request){
    
  }


}
