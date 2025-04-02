<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;


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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        
        
    }
    
   //Date: 10-05-2024 
   
   
 /*  public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $userData = User::where('email','=',$request->email)->first();
       
        if(!empty($userData) && $userData->status =='1'){
            
            $credentials = $request->only('email', 'password');
            
            if (Auth::attempt($credentials)) {
                
            return redirect()->route('dashboard')
                        ->withSuccess('success','You have successfully logged in');
        } 
            
        }

        return redirect()->route("login")->withErrors(['password' => ['Oppes! You have entered invalid credentials !']]);
    }
    
    */
    
    
    	public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $userData = User::where('email','=',$request->email)->first();
       
        if(!empty($userData) && $userData->status =='1'){
            
            $credentials = $request->only('email', 'password');
            
            if (Auth::attempt($credentials)) {
                
            return redirect()->route('dashboard')
                        ->withSuccess('success','You have successfully logged in');
        } 
		else{
		
        return redirect()->route("login")->withErrors(['password' => ['Oppes! You have entered invalid credentials !']]);
       
	   }
       
       }else{
		
	   return redirect()->route("login")->withErrors(['password' => ['Oppes! Your account is suspended please contact administrator!!']]); 	
	 }
	
   }
    
    
    
}
