<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/master', function () {
    return view('admin.dashboard');
});

Auth::routes();
//redirect to dashboard after login
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//change language
Route::get('lang-change/{language}', [App\Http\Controllers\HomeController::class, 'change'])->name('langChange');


Route::group(['middleware' => 'auth'], function()
{
    //company routes
    Route::resource('company', 'App\Http\Controllers\CompanyController');
    //employee routes
    Route::resource('employee', 'App\Http\Controllers\EmployeeController');
});




