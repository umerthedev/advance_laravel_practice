<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Multipic;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeAboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserConController;
use App\Http\Controllers\ChangePassController;



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
    $homeabout = DB::table('home_abouts')->first();
    $images = Multipic::all();
    return view('user_profile.index', compact('brand','homeabout','images'));
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


//Home About
//Home.AboutIndex
Route::get('/home/about', [HomeAboutController::class, 'HomeAbout'])->name('Home.AboutIndex');
//Add.About
Route::get('/add/about', [HomeAboutController::class, 'AddAbout'])->name('add.about');
//Store.About
Route::post('/store/about', [HomeAboutController::class, 'StoreAbout'])->name('store.about');
///about/edit/
Route::get('/about/edit/{id}', [HomeAboutController::class, 'Edit']);
//about/edit/
Route::post('update/about/{id}', [HomeAboutController::class, 'Updateabout']);
//about/delete/
Route::get('/about/delete/{id}', [HomeAboutController::class, 'DeleteAbout']);


//Contact Page
//home.con
Route::get('/communicat', [ContactController::class, 'communicat'])->name('communicat');

//contact.profile
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact.profile');
//add.contact
Route::get('/add/contact', [ContactController::class, 'AddContact'])->name('add.contact');
//store.contact
Route::post('/store/contact', [ContactController::class, 'StoreContact'])->name('store.contact');

//EditContact
Route::get('contact/edit/{id}', [ContactController::class, 'EditContact']);
//update.contact
Route::post('update/contact/{id}', [ContactController::class, 'UpdateContact']);

//contact/delete/
Route::get('/contact/delete/{id}', [ContactController::class, 'DeleteContact']);
//u_contact form save
Route::post('/u_contact', [UserConController::class, 'u_contact'])->name('u_contact');
//u_contact form view   
Route::get('/u_contact', [UserConController::class, 'u_contact_view'])->name('u_contact_view');
//msg/delete/
Route::get('/msg/delete/{id}', [UserConController::class, 'DeleteMsg']);

//change.password
Route::get('/change/password', [ChangePassController::class, 'ChangePass'])->name('change.password');
//password.update
Route::post('/update/password', [ChangePassController::class, 'UpdatePass'])->name('password.update');





