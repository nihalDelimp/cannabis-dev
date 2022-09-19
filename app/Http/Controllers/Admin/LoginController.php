<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\ForgotMail;
use Illuminate\Support\Facades\Mail;
use App;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
      $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(){
      $goto = (isset($_GET['goto']) && trim($_GET['goto'])!="")?trim($_GET['goto']):'';
      $account = Auth::user();
      return view('admin.login.index',compact('goto'));
    }

    public function login(Request $request)
    {
        //dd($request->all());
        $user = User::where('email',$request->email)->first();
        $this->validateLogin($request);
       

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
          
            $account = Auth::user();
            //dd("return lsjfd", $account);
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
         dd("ljsdflk");
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    // protected function validateLogin(Request $request)
    // {
    //     $request->validate([
    //         $this->username() => 'required|string',
    //         'password' => 'required|string',
    //     ]);
    // }

    protected function validateLogin(Request $request)
    {
            //dd($this->username());
            $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
        return $request;
    }

    protected function attemptLogin(Request $request)
    {
      
      return $this->guard()->attempt(
        $this->credentials($request), $request->filled('remember')
      );

     
      //dd($return);
       
    }

    protected function credentials(Request $request)
    {
     
      // $us = $request->only($this->username(), 'password');
      //  dd("credentials",$us);
        return $request->only($this->username(), 'password');
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        
        
        $this->clearLoginAttempts($request);
        
        $account = Auth::user();
        //dd("hello user",$account);
        //print_this($request,1);
        if($request->goto!=NULL){
          dd("goto if");
          $redirecUrl = $request->goto;
        }
        else{
           dd("else");
          $redirecUrl = route('dashboard',app()->getLocale());
        }
        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($redirecUrl);
    }

    protected function authenticated(Request $request, $user)
    {
        //
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    public function username()
    {
        return 'email';
    }

    public function logout(Request $request){
      $this->guard()->logout();
      $request->session()->invalidate();
      return $this->loggedOut($request) ?: redirect(route('admin',app()->getLocale()));
    }

    protected function loggedOut(Request $request)
    {
        //
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function forgotpassword(){
      return view('admin.login.forgot');
    }

    public function processforgotpass(Request $request){
      $validate['email'] = 'required|email|exists:users';
      $request->validate($validate);
      $user = User::where('email','=',$request->email)->first();
      $password = Str::random(8);
      User::whereId($user->id)->update(array('password'=>Hash::make($password)));
      $data = array(
        'name' => $user->name,
        'password' => $password
      );
      Mail::to($request->email)->send(new ForgotMail($data));
      return back()->with('success', 'Thanks we have sent your password!');
    }
}
