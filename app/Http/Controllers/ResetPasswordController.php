<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reminder;
use App\User;
use Mail;
use Alert;

class ResetPasswordController extends Controller
{

	public function getResetToken(Request $request){
        // dump($request->email);
        // exit();
        $user = User::where('email', $request->input('email'))->first();
        $credentials = ["login"=> $request->input('email')];
      //  $sentinelUser = Sentinel::findByCredentials($credentials);

      
        if (!$user){
            return response('Email is not registered', 500);
        }

        // return response($user);
            $token =  str_random(16);
            $reminder = Reminder::create(['user_id'=>$user->user_id, 'code'=>$token,'completed'=>0]);
            $this->sendEmail($user,$token);
            return response()->json(['token' => 'ok']);
    }

    	private function sendEmail($user, $token){
            Mail::send('email.forgot-password', [
                'email'=>$user->email,
                'token'=> $token,
                'user'=>$user->name

            ], function($message) use ($user){
                $message->to($user->email);
                $message->subject("Hello ".$user->name.", reset your password");
            });
        }

    public function resetPasswordFromEmail($email, $resetCode){
        
        $user = User::where('email',$email)->first();
        $reminder = Reminder::where('user_id',$user->user_id)->where('completed', '=', 0)->orderBy('code','desc')->first();
        if ($reminder) {
            if ($reminder->code == $resetCode){
            return view('authentication.reset-password', compact('email', 'resetCode'));
            }
            else{
            alert()->warning('Code not similar')->persistent("OK");
                
                return redirect('/password-error');
            }
        }
        else {
            alert()->success('Data not found')->persistent("OK");
            return redirect('/password-error');
        }

    }

    public function successPassword(Request $request){
        return view('authentication.reset-success');
    }
    
    public function errorPassword(Request $request){
        return view('authentication.reset-error');
    }

    public function postResetPassword(Request $request){

        $this->validate($request, [
            'password'=>'required|min:6|confirmed'
        ]);

        if($request->ajax()){
            $email = $request->email;
            $password = $request->password;
            $resetCode = $request->resetCode;
            $user = User::where('email',$email)->first();
            if (!$user){
                abort(404);
            }
            $reminder = Reminder::where('user_id',$user->user_id)->where('completed', '=', 0)->first();
            if ($reminder){
                if ($reminder->code == $resetCode){
                    $user->password = bcrypt($request->password);
                    $user->save();

                    $reminder->completed = 1;
                    $reminder->save();
                    
                    return response()->json(['status'=>'ok']);
                }
                else {
                    return response()->json(['status'=>'error']);
                }
            }else{
                    abort(404);
            }
        }
    }
}
