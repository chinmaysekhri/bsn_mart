<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
   
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('auth.forgetPassword');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          //dd( $request);
          $request->validate([
              'email' => 'required|email|exists:users',
          ]);
  
          $remember_token = Str::random(64);
          
          User::where('email','=',$request->email)->update(['remember_token'=>$remember_token]);
          
  
          //$user = User::where('id','=',$request->id)->first();
          
          $data = Mail::send('emails.forgetPassword', ['remember_token' => $remember_token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Your Password Traders Mart');
          });
         
  
          return back()->with('success', 'Forget Password Link Share Your Email Address');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($remember_token) { 
         return view('auth.forgetPasswordLink', ['remember_token' => $remember_token]);
        
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
         // dd($request);
         
         $request->validate([
              // 'email' => 'required|email|exists:users',
               'password' => 'required|string|min:6|confirmed',
               'password_confirmation' => 'required',
               'remember_token' => 'required',
           ]);
  
          $updatePassword = DB::table('users')
                              ->where([
                               //  'email' => $request->email 
                               'remember_token' => $request->remember_token
                               ])
                               ->first();
  
           if(empty($updatePassword)){
               
               //return back()->withInput()->with('error', 'Invalid remember_token!');
               
               return back()->withErrors(['remember_token' => ['Your Password Resset Link Is Invalid !']]);
           }
 
           $user = User::where('remember_token','=', $request->remember_token)
                       ->update(['password' => Hash::make($request->password), 'remember_token'=>'NULL']);
 
         
           return redirect('/login')->with('success', 'Your password has been changed!');
    
      }
}
