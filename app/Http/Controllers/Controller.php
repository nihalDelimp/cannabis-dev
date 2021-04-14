<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $login_account;
    public $response = [];
    public $error = [];
    public function __construct(){
      $this->middleware(function ($request, $next) {
      if(Auth::check()){
        $this->login_account = Auth::user();
      }
      return $next($request);
      });
    }

    public function sendResponse($data=array()){
      header('Content-Type: application/json');
      echo json_encode($data);
      exit();
    }

    public function langMessage($message = ''){
      return __(strtolower($message));
    }

    public function langError($array = []){
      if(count($array) > 0){
        foreach($array as $key=>$arr){
          $array[$key]= __(strtolower($arr));
        }
      }
      return $array;
    }

    public function getDateTime($datetime='',$format='Y-m-d H:i:s') {
    	$format = trim($format)=='' ? 'Y-m-d H:i:s' : $format;
    	$datetime = (trim($datetime)=='') ? date($format) : $datetime;
    	return date($format,strtotime($datetime));
    }

    public function validateError($validator){
      $errorArray = [];
      if($validator->fails()){
       $errors = json_decode($validator->errors()->toJson(), true);
       if (!empty($errors)){
          foreach($errors as $k => $v) {
            foreach($v as $error){
              $errorArray[] = $error;
            }
          }
       }
      }
      return $errorArray;
    }
}
