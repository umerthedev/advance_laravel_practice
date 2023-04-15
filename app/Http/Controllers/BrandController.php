<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Carbon\Carbon;
use Image;
use Auth;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $brands = brand::latest()->paginate(5);
        return view('admin.brand.Bindex',compact('brands'));
    }

    //store.brand

    public function storeBrand(Request $request){
        $validatedData = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_image.required' => 'Please Input Brand Image',
        ]
    );

        $brand_image = $request->file('brand_image');

        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location,$img_name);

        //use image intervention
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);
        $last_img = 'image/brand/'.$name_gen;



        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );
        

        return Redirect()->back()->with($notification);
    }

    //brand/edit/
    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }

    //brands/update/
    public function Brandupdate(Request $request, $id){
        $validatedData = $request->validate([
            'brand_name' => 'required|min:4',
        
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_image.required' => 'Please Input Brand Image',
        ]
    );

        $old_image = $request->old_image;
        $brand_image = $request->file('brand_image');

        if($brand_image){

        // $name_gen = hexdec(uniqid());
        // $img_ext = strtolower($brand_image->getClientOriginalExtension());
        // $img_name = $name_gen.'.'.$img_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$img_name;
        // $brand_image->move($up_location,$img_name);

        //laravel intervention image
        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,200)->save('image/brand/'.$name_gen);
        $last_img = 'image/brand/'.$name_gen;

        unlink($old_image);

        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('Brand')->with('success','Brand Updated Successfully');
        }else{

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,                
                'created_at' => Carbon::now()
            ]);
    
            return Redirect()->route('Brand')->with('success','Brand Updated Successfully');

        }   
                  

    }
    //brand/delete/
    public function Delete($id){
        $image = Brand::find($id);
        $old_image = $image->brand_image;
        unlink($old_image);
        Brand::find($id)->delete();
        return Redirect()->back()->with('success','Brand Deleted Successfully');
    }



    //multi Image strat feom here

    public function MultiPic(){
        
        $images = MultiPic::latest()->paginate(5);
        return view('admin.multipic.index', compact('images'));
    }


    //multipic.store
    public function StoreImg(Request $request){
        $image = $request->file('image');

        foreach($image as $multi_img){           

                $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
                Image::make($multi_img)->resize(300,200)->save('image/multi/'.$name_gen);
                $last_img = 'image/multi/'.$name_gen;



                MultiPic::insert([        
                    'image' => $last_img,
                    'created_at' => Carbon::now()
                ]);
         } //end foreach

        return Redirect()->back()->with('success','Images Inserted Successfully');


    }

    //user logout
    public function Logout(){
        Auth::logout();
        return Redirect()->route('login')->with('success','User Logout');
    }








}
