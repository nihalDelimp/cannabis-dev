<?php
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;
function ip_address(){
  return $_SERVER['REMOTE_ADDR'];
}

function from_device(){
  return $_SERVER['HTTP_USER_AGENT'];
}

function print_this($array,$flag=0){
	echo '<pre>';
	print_r($array);
	if($flag == 1){
		die;
	}
}

function getDateTime($datetime='',$format='Y-m-d H:i:s') {
	$format = trim($format)=='' ? 'Y-m-d H:i:s' : $format;
	$datetime = (trim($datetime)=='') ? date($format) : $datetime;
	return date($format,strtotime($datetime));
}

function dateDiffInDays($date1, $date2){
  $diff = strtotime($date2) - strtotime($date1);
  return abs(round($diff / 86400));
}

function getDatesFromRange($start, $end, $format = 'Y-m-d') {
  $array = array();
  $interval = new DateInterval('P1D');
  $realEnd = new DateTime($end);
  $realEnd->add($interval);
  $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
  foreach($period as $date) {
    $array[] = $date->format($format);
  }
  return $array;
}

function validateAccessToken($user_id, $access_token = ''){
  $tokens = App\User::where('access_token',$access_token)->where('id',$user_id)->get();
  return $tokens->count();
}

function createAccessToken($user){
  do {
    $access_token = Hash::make(time().rand().$user->id);
  }
  while(accessTokenExists($access_token));
  return $access_token;
}


function isLanguageWordExist($word=''){

  $lang = App\Language::where('word','=',strtolower($word))->first();
  if(!empty($lang)){
    return $lang;
  }
  return false;
}

function lang($array = [], $field=''){
  if(count($array) > 0){
    foreach($array as $key=>$arr){
      $array[$key]->$field = __(strtolower($arr->$field));
    }
  }
  return $array;
}

function langError($array = []){
  if(count($array) > 0){
    foreach($array as $key=>$arr){
      $array[$key]= __(strtolower($arr));
    }
  }
  return $array;
}

function langData($array = [], $fields=[]){
  if(count($array) > 0 && count($fields) > 0){
    foreach($array as $key=>$arr){
      foreach($fields as $field){
        $array[$key]->$field = __(strtolower($arr->$field));
      }
    }
  }
  return $array;
}

function langSingleData($data,$fields=[]){
  if(count((array)$data) > 0){
    foreach($fields as $field){
      $data->$field = __(strtolower($data->$field));
    }
  }
  return $data;
}

function langMessage($message = ''){
  return ucfirst($message);
  //return __(strtolower($message));
}

function getLatLongByAddress($address){
		$latlong = array();
    $url = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyA3lp_UtCAE2SFYcsW5QyqAcEiEdbvDEv8&address=".urlencode($address);
  	$ch = curl_init();
  	curl_setopt($ch, CURLOPT_URL, $url);
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
  	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  	 $response = curl_exec($ch);
  	curl_close($ch);
  	$geometry_detail = json_decode($response);
    if(isset($geometry_detail->status) && ($geometry_detail->status=="OK") && isset($geometry_detail->results[0])) {
		$latlong['latitude'] = $geometry_detail->results[0]->geometry->location->lat;
		$latlong['longitude'] = $geometry_detail->results[0]->geometry->location->lng;
		}
	return $latlong;
}

function getEmailTemplate($slug){
  if(trim($slug)!=""){
    $locale = app()->getLocale();
    $template = App\Models\Template::where('slug',$slug)->first(['subject','name','message_'.$locale.' as message'])->toArray();
    return $template;
  }
  return false;
}

function superAdminPermissionList(){
  $permissions = [
    'a'=>'Users',
    'b'=>'Language',
    'c'=>'Vehicle',
    'd'=>'Warehouse',
    'e'=>'Metrics',
    'f'=>'Certification',
    'g'=>'Email Templates',
    'h'=>'Sub Admin',
    'i'=>'Reviews',
  ];
  return $permissions;
}

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}

function sendMessage($recipient, $message){
  $flag= 0;
  $countries = ['+966'];
  foreach($countries as $code){
    $index =  strpos($recipient,$code);
    if($index === 0){
      $flag = 1;
    break;
    }
    else{
      $flag = 0;
    }
  }
  if($flag == 1){
    $account_sid = env("TWILIO_SID");
    $auth_token = env("TWILIO_AUTH_TOKEN");
    $twilio_number = env("TWILIO_NUMBER");
    $client = new Client($account_sid, $auth_token);
    try {
        $res = $client->messages->create($recipient, ['from' => $twilio_number, 'body' => $message]);
    }
    catch (Exception $e){
      return false;
    }
  }
}
?>
