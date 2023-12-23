<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function getlogin(){
        return view('login');
    }
    public function postSignup(Request $request){
       
        $request->merge(['password'=> Hash::make($request->password)]);
        try{
            User::create($request->all());
        }catch(\Throwable $th){dd($th);}

        return redirect()->route('login');
    }
    public function postLogin(Request $request){
        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/workspace');
        } else return redirect()->back()->with('error','Dữ liệu không chính xác !');
    }

}
