<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkTypeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FreemanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('/');


Auth::routes();
Route::any('/register', function(){
    return view('auth.login');
});

Route::get('/home', [MainController::class, 'index'])->name('home');

Route::get('/aboutus', [MainController::class, 'about_us'])->name('about_us');
Route::get('/vehicles', [MainController::class, 'vehicles'])->name('vehicles');
Route::get('/ro_machine', [MainController::class, 'ro_machine'])->name('ro_machine');
Route::get('/contactus', [MainController::class, 'contact_us'])->name('contact_us');

Route::get('/change_language/{lan}', [MainController::class, 'change_language']);

Route::get('/consultency', [MainController::class, 'consultency'])->name('consultency');
Route::get('/languagetraining', [MainController::class, 'languagetraining'])->name('languagetraining');
Route::get('/softwaredevelopment', [MainController::class, 'softwaredevelopment'])->name('softwaredevelopment');






Route::group(['middleware'=>['Admin','auth']],function(){

    

});


