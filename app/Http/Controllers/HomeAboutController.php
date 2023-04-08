<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\HomeAbout;

use Carbon\Carbon;
use Image;
use Auth;


class HomeAboutController extends Controller
{
   //HomeAbout
    public function HomeAbout(){
        $about = HomeAbout::all();
         return view('admin.about.index',compact('about'));
    }

    //AddAbout
    public function AddAbout(){
        return view('admin.about.create');
    }
    //StoreAbout
    public function StoreAbout(Request $request){
        HomeAbout::insert([
            'title' => $request->title,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('Home.AboutIndex')->with('success','About Inserted Successfully');
    }
    
}
