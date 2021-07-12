<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Exception;
use App\Notifications\RegistrationEmailNotification;
class AuthController extends Controller
{

    public function showLoginForm(){
        
        return view('frontend.auth.login');

    }
    public function processLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only(['email','password']);
        if(auth()->attempt($credentials)){
            if(auth()->user()->email_verified_at == null){
                session()->flash('type','warning');
                session()->flash('message','Invalid User');
                return redirect()->route('login');

            }

            session()->flash('type','success');
            session()->flash('message','You are logged in!');
            return redirect()->intended();
        }
        session()->flash('type','warning');
        session()->flash('message','Invalid credentials');
        return redirect()->route('login');

    }



    public function showRegisterForm(){
        
        return view('frontend.auth.register');

    }
    public function processRegister(Request $request){
       
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'min:11', 'numeric', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],

            
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try{
            $userdata = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone_number' => $request['phone_number'],
                'password' => bcrypt($request['password']),
                'email_verification_token' => uniqid(time(),true).Str::random(16),
            ]);
            
            $userdata->notify(new RegistrationEmailNotification($userdata));
            
            session()->flash('type','success');
            session()->flash('message','Information recorded! Please check your email');
            return redirect()->back();
            
        }
        catch(Exception $e){
            session()->flash('type','warning');
            session()->flash('message',$e->getMessage());

            
        }
        return redirect()->back();
        
    

    }

    public function activate($token=null){
        if($token==null){
            return redirect()->route('/');
        }
        $user=User::where('email_verification_token',$token)->firstOrFail();

        if($user){
            $user->update([
                'email_verified_at'=>now(),
                'email_verification_token'=>null,
            ]);

            session()->flash('type','success');
            session()->flash('message','Account activated. You can login now!');
            return redirect()->route('login');
        }
        session()->flash('type','warning');
        session()->flash('message','Invalid token');

        return redirect()->back();

    }
}
