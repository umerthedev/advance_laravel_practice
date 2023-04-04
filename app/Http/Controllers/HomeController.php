<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Slider;
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
}
