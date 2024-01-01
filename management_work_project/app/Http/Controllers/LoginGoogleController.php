<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class LoginGoogleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
        
            $user = Socialite::driver('google')->user();
            // dd($user);
            $finduser = User::where('google_id', (string)$user->id)->first();
         
            if($finduser){
                Auth::login($finduser);         
            } else {
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'google_id'=> (string)$user->id,
                        'password' => encrypt('GiCungDuoc'),
                        'avatar'=> $user->avatar, 
                        'gender' => $user->gender,
                        'birthday' => $user->birthday,
                        'phone' => $user->phone,
                    ]);
                Auth::login($newUser);
            }
            $token = Auth::user()->createToken("authToken")->plainTextToken;
            session(['authToken' => $token]);
            session(['id_user' => Auth::id()]);
            $_COOKIE['bearerToken'] = $token;
            return redirect()->route("homepageAfterLogin");
        
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function logout_home(){
        dd(auth()->user()->currentAccessToken());
        Auth::user()->currentAccessToken()->where("tokenable_id", Auth::id())->delete();
        Auth::logout();
        session()->forget("id_user");
        return redirect()->back();
    }

}
