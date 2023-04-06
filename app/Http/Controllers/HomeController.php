<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
use App\Models\HomeAbout;

use Carbon\Carbon;
use Image;
use Auth;


class HomeController extends Controller
{
    public function Homeslider(){
        $slider = Slider::latest()->paginate(5);
        return view('admin.slider.index', compact('slider'));
    }

    // add slider view 
    public function Addslider(){
        return view('admin.slider.addSlider');
    }
    //StoreSlider
    public function StoreSlider(Request $request){
        $validated = $request->validate([
            'title' => 'required|unique:sliders|max:255',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'title.required' => 'Please Input Slider Title',
            'description.required' => 'Please Input Slider Description',
            'image.required' => 'Please Input Slider Image',
        ]
    );

        $slider_image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, 1088)->save('image/slider/'.$name_gen);
        $last_img = 'image/slider/'.$name_gen;

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('slider')->with('success','Slider Added Successfully');
    }


    //slider/edit/
    public function Edit($id){
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }
    //slider update
    public function Update(Request $request, $id){
        $validated = $request->validate([
            'title' => 'max:255',
            
            'image' => 'mimes:jpg,jpeg,png',
        ],
        [
            'title.max' => 'Please Input Slider Title',
            'description.required' => 'Please Input Slider Description',
        ]
    );

        $old_image = $request->old_image;

        $slider_image = $request->file('image');
        if($slider_image){
            $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
            Image::make($slider_image)->resize(1920, 1088)->save('image/slider/'.$name_gen);
            $last_img = 'image/slider/'.$name_gen;

            unlink($old_image);
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
            return Redirect()->route('slider')->with('success','Slider Updated Successfully');
        }else{
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'created_at' => Carbon::now()
            ]);
            return Redirect()->route('slider')->with('success','Slider Updated Successfully');
        }
    }


    //slider/delete/
    public function Delete($id){
        $image = Slider::find($id);
        $old_image = $image->image;
        unlink($old_image);
        Slider::find($id)->delete();
        return Redirect()->back()->with('success','Slider Deleted Successfully');
    }


    //Home About Start from Here

    public function homeIndex (){
        $about = DB::table('home_abouts')->first();
        return view('admin.about.index', compact('about'));
    }

    







}
