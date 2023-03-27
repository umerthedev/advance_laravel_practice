<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index(){
        $brands = brand::latest()->paginate(5);
        return view('admin.brand.Bindex',compact('brands'));
    }
}
