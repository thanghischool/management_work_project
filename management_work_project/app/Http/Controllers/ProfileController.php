<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class ProfileController extends Controller
{
    public function index(){
        return view('profile');
    }

    public function edit(User $user)
    {
       return view('edit',compact('user'));
    }
    public function update(Request $request){
        $request->validate([
            'gender' => 'string',
            'phone' => 'numeric|min:0',
            // 'address' =>'string',
            'birthday' =>'date',
            'bio' =>'string',
            // 'avatar' =>'string',
            // 'name' =>'string',
        ]);
        $user = Auth::user();
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->bio = $request->bio;
        // $user->avatar = $request->avatar;
        // $user->name = $request->name;
        $user->save();
        return redirect()->route('profile')->with('thongbao', 'Update Successful');
    }
}
