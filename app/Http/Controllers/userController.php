<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    function store(Request $request){

        $request -> validate([

            'name' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required',

        ]);

       $User = new User();
       $User -> name = $request -> name;
       $User -> email  = $request -> email;
       $User -> password =Hash::make($request -> password);
       $User -> save();
       return redirect('/')->with("success",'Registered Successfully');

    }

    function login(Request $request){

        $request -> validate([

            'name' => 'required',
            'password' => 'required',

        ]);

        $user = User::where('name',$request->name)->first();

        if($user){
            $credentials = $request->only('name', 'password');

            if (Auth::attempt($credentials)){
                return redirect('/layout')->with('success','logged in successfully');
            }
            else{
                return redirect('/')->with('fail','Invalid Password or Email');
            }
        }

        else{

            return redirect("/")->with('fail', "User name does not matched");
        }


    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    function viewLogin(){
        return view("login");
    }
}
