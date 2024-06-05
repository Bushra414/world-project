<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
//admincontroller


Route::get('/login-form', function(){
    return view('login');
});


Route::get('/', function () {
    return view('welcome');

});

Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/register-form', function(){
    return view('register');
})->name('register-form')->middleware('worldLogin');


Route::post('/login', [AdminController::class, 'login'])->name('login');

Route::get('/dash', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('worldLogin');

Route::post('/adding', [AdminController::class, 'store'])->name('add');

Route::delete('/delete-country/{code}', [AdminController::class, 'deleteCountry'])->name('delete-country');

Route::put('/edit-country/{code}', [AdminController::class, 'editCountry'])->name('editCountry');

Route::get('/login-out', [AdminController::class, 'logout'])->name('logout');

Route::post('/create-user', [AdminController::class, 'createUser'])->name('create-user');

Route::get('/addcountry', function () {
    return view('addcountry');
})->name('addcountry')->middleware('worldLogin');




