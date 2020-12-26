<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ConfirmRegister;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Socialite;
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
    protected $redirectTo = '/home';
    
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->username = $this->findUsername();
    }
    public function index()
    {
        
        return view('frontend.index');
    }
    public function findUsername()
    {
        $login = request()->input('login');
        
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        request()->merge([$fieldType => $login]);
        
        return $fieldType;
    }
    
    public function authenticate(Request $request)
    {

        $email = $request->input('login');
        $username = $request->input('login');
        $password = $request->input('password');
        
        if (Auth::attempt(['email' => $email, 'password' => $password, 'role' => 1, 'status' => 1])||Auth::attempt(['username' => $username, 'password' => $password, 'role' => 1, 'status' => 1])) {
            return redirect()->intended('index');
        }elseif(Auth::attempt(['email' => $email,'password' => $password,'role' => 0, 'status' => 1])||Auth::attempt(['username' => $username,'password' => $password, 'role' => 0, 'status' => 1])){
            return redirect()->intended('home');
        }
        else{
            return redirect()->back()->with('error',"Sai tên tài khoản hoặc mật khẩu");
        }
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderFacebookCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        // var_dump($user->getId());
        
        $checkId = User::where('provider_id',$user->getId())->first();
        $checkMail = User::where('email',$user->getEmail())->first();
        if($checkId === null && $checkMail === null){
      
            $createdUser = User::create([
                'name' => $user->getName(),
                'username' => $user->getNickname(),
                'email' => $user->getEmail(),
                'avatar' => $user->getAvatar(),
                'provider_id' => $user->getId(),
            ]);
            Auth::login($createdUser);

            return redirect('index');
        }else{
            if($checkId === null){
                Auth::loginUsingId($checkMail->id);
                return redirect('index');
            }
            Auth::loginUsingId($checkId->id);
            return redirect('index');
        }
    }

/**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderGoogleCallback()
    {
        $getUser = Socialite::driver('google')->user();

        $checkId = User::where('provider_id',$getUser->getId())->first();
       
        $checkMail = User::where('email',$getUser->getEmail())->first();
        if($checkId === null && $checkMail === null){
        
            $user = User::create([
                'name' => $getUser->getName(),
                'username' => $getUser->getNickname(),
                'email' => $getUser->getEmail(),
                'avatar' => $getUser->getAvatar(),
                'provider_id' => $getUser->getId(),
            ]);
            Mail::to($getUser->getEmail())->send(new ConfirmRegister($user));
            Auth::login($user);

            return redirect('index');
        }else{
            if($checkId === null){
                Auth::loginUsingId($checkMail->id);
                return redirect('index');
            }
            Auth::loginUsingId($checkId->id);
            return redirect('index');
        }
    }
    
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/index');
    }
}
