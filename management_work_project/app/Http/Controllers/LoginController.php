<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Session;
use Mail;
use App\Mail\ForgetPasswordMailable;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function getlogin()
    {
        return view('login');
    }
    public function postSignup(Request $request)
    {

        $request->merge(['password' => Hash::make($request->password)]);
        try {
            User::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
        }

        return redirect()->route('login');
    }


    public function postLogin(Request $request)
    {


        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        //     return redirect('/workspace');
        // } else return redirect()->back()->with('error', 'Dữ liệu không chính xác !');



        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $id_user = Auth::id();
            // Lưu giá trị $id_user vào flash session
            session(['id_user' => $id_user]);
            return redirect()->route('homepageAfterLogin');
        } else return redirect()->back()->with('error', 'Dữ liệu không chính xác !');
    }
    public function logout()
    {
        Auth::logout();
        session()->forget('id_user');
        return view('login');
    }

    public function forgetPass(){
        return view('forgetPass');
    }

    public function postForgetPass(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users',
        // ],[
        //     'email.exists' => 'Email không tồn tại',
        //     'email.required' => 'Vui lòng nhập dịa chỉ email hợp lệ'
        ]);
        $token = strtoupper(Str::random(10));
        $user = User::where('email', $request->email)->first();
        $user->update(['token'=>$token]);
        Mail::send('check_email_forget', compact('user'), function($email) use($user) {
            $email->subject('Dira - Lấy lại mật khẩu');
            $email->to($user->email,$user->name); });
            return redirect()->back()->with('yes', 'Please Check your email to change your password');
    }

    public function getPass(User $user, $token){
        if($user->token === $token){
            $id = $user->id;
            return view('getPass', compact('id','token'));
        } else return view('404');
    }

    public function postGetPass(Request $request,User $user, $token){
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);
        $password_h = Hash::make($request->password);
        // $user->update(['password'=>$password_h,'token' => null]);
        $user->password = $password_h;
        $user->token = null;
        $user->save();
        return redirect()->route('login')->with('yes','Change password successfully, please log in again');
    }
}



   
    