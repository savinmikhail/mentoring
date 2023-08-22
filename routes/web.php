<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompilerController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\AuthController;
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

Route::get('/signin', function ()
{
    return view('signIn');
})->name('signin');

Route::get('/signup', function ()
{
    return view('signUp');
});
Route::post('/signup', [AuthController::class, 'signUp'])->name('signUp');
Route::post('/signin', [AuthController::class, 'signIn'])->name('signIp');


Route::middleware(['auth'])->group(function () {
    Route::get('/logout', function (){
        Auth::logout();
        return redirect('/signin');
    })->name('logout');

    Route::get('/lessons/{id}', [CompilerController::class, 'showLesson'])->name('showLesson');
    Route::get('/', [ModuleController::class, 'index'])->name('showModule');
    Route::post('/com', [CompilerController::class, 'compile'])->name('compile');
});

