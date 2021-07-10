<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Exception;
class AuthController extends Controller
{
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
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone_number' => $request['phone_number'],
                'password' => bcrypt($request['password']),
                'email_verification_token' => uniqid(time(),true).Str::random(80),
            ]);

            
        }
        catch(Exception $e){
            session()->flash('type','warning');
            session()->flash('message',$e->getMessage());
        }
        
        return redirect()->back();
    

    }
}
