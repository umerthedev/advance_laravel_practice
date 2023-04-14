<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Image;

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
    //MyProfile
    public function MyProfile(){
        if(Auth::User()){
            $user = User::find(Auth::id());
            if($user){
                return view('admin.pass.Myprofile', compact('user'));
            }
        }
    }

    //UpdateProfile
    public function UpdateProfile(Request $request){
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
        ]);
        
        $user = User::find(Auth::id());
        if($user){
            $user->name = $request['name'];
            $user->email = $request['email'];
            //add user image
            if($request->hasFile('profile_photo_path')){
                $image = $request->file('profile_photo_path');
                $filename = date('YmdHi').$image->getClientOriginalName();
                $image->move(public_path('upload/user_images'), $filename);
                $user['profile_photo_path'] = $filename;
            }
            $user->save();  

            return Redirect()->route('my.profile')->with('success', 'Profile Updated Successfully');
        }
        else{
            return Redirect()->back()->with('success', 'Profile Not Updated');
        }
    }

}
