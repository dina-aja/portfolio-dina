<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Models\Project;


/*
|--------------------------------------------------------------------------
| USER / HALAMAN PORTFOLIO
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $projects = Project::latest()->get();

    return view('welcome', compact('projects'));

});


/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/

// Halaman login
Route::get('/login', [AuthController::class, 'login'])->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $projects = Project::latest()->get();

    return view('dashboard', compact('projects'));

})->middleware('auth');


/*
|--------------------------------------------------------------------------
| CRUD PROJECT ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::resource('projects', ProjectController::class);

});