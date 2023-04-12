<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChangePassController extends Controller
{
    //Change.password
    public function ChangePass(){
        return view('admin.pass.change_password');
    }

    //password.update
    public function UpdatePass(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return Redirect()->route('login')->with('success', 'Password Changed Successfully');
        }else{
            return Redirect()->back()->with('success', 'Current Password Not Matched');
        }
    }

}
