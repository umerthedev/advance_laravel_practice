<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function AllCat()
    {
        //query buidler
        // $categories = DB::table('categories')
        // ->join('users', 'categories.user_id', 'users.id')
        // ->select('categories.*', 'users.name')
        // ->latest()->paginate(5);

        //ORM
        $trushCat = Category::onlyTrashed()->latest()->paginate(3);
        $categories = Category::latest()->paginate(5);
        return view('admin.category.index' , compact('categories', 'trushCat'));
    }

    public function AddCat(Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',            
        ],
        [
            'category_name.required' => 'Please Input Category Name',
            'category_name.max' => 'Category Less Than 255 Characters',
        ]);

        
        //ORM
        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);

        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();

        //sql query Builder
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        DB::table('categories')->insert($data);


        return Redirect()->back()->with('success', 'Category Inserted Successfully');
    }

    //edit
    public function Edit($id){

        //query builder
        // $categories = DB::table('categories')->where('id', $id)->first();

        $categories = Category::find($id);
        return view('admin.category.edit', compact('categories'));
    }
    //update categories
    public function Update(request $request, $id){

        //query builder
        // $update = DB::table('categories')->where('id', $id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        // ]);     



        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
        ]);
        return Redirect()->route('All.cat')->with('success', 'Category Updated Successfully');
    }

    //soft delete
    public function SoftDelete($id){
        $delete = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Category Move to Treshed Successfully');
    }

    //category/restore/
    public function Restore($id){
        $restore = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Category Restore Successfully');
    }

    //category/pdelete/
    public function Pdelete($id){
        $pdelete = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category Permanently Deleted Successfully');
    }
}
