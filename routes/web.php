<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;

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