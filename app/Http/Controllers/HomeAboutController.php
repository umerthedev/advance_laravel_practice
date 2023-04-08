<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\HomeAbout;
use Carbon\Carbon;



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
    //about/edit/
    public function Edit($id){
        $about = HomeAbout::find($id);
        return view('admin.about.edit',compact('about'));
    }
    //about/update/
    public function Updateabout (Request $request, $id){
        $update = HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des
            
        ]);
        return Redirect()->route('Home.AboutIndex')->with('success','About Updated Successfully');
    }
    //about/delete/
    public function DeleteAbout($id){
        HomeAbout::find($id)->delete();
        return Redirect()->back()->with('success','About Deleted Successfully');
    }
    
}
