<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;

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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {

        $users = user::all();
        return view('dashboard', compact('users'));
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