<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $brand = DB::table('brands')->get();
    return view('user_profile.index', compact('brand'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {

        $users = user::all();
        return view('admin.index', compact('users'));
    })->name('dashboard');
});

//All Category
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('All.cat');
//Store Category
Route::post('/category/Store', [CategoryController::class, 'AddCat'])->name('Store.Cat');
//edit
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
//update
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
//soft delete
Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
//category/restore/
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
//category/pdelete/
Route::get('/Pdelete/category/{id}', [CategoryController::class, 'Pdelete']);


//Brand Controller
Route::get('/brand/all', [BrandController::class, 'index'])->name('Brand');
//store.brand
Route::post('/brand/store', [BrandController::class, 'storeBrand'])->name('store.brand');
//brand/edit/
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
//brands/update/
Route::post('/brands/update/{id}', [BrandController::class, 'Brandupdate']);
//brand/delete/
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);

//Multi Image
Route::get('/multi/image', [BrandController::class, 'Multipic'])->name('MImage');
//store.image
Route::post('/multi/image', [BrandController::class, 'StoreImg'])->name('multipic.store');


//Admin Controller
//Log Out 
Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');


//Admin Part
Route::get('/slider', [HomeController::class, 'Homeslider'])->name('slider');

//Add slider view
Route::get('/add/slider', [HomeController::class, 'Addslider'])->name('add.slider');
//store.slide
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');
//slider/edit/
Route::get('/slider/edit/{id}', [HomeController::class, 'Edit']);
//slider/update/
Route::post('/update/slider{id}', [HomeController::class, 'Update']);
//slider/delete/
Route::get('/slider/delete/{id}', [HomeController::class, 'Delete']);