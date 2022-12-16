<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\YearsController;
use App\Http\Controllers\NameController;
use App\Models\Language;
use App\Models\Name;
use App\Http\Controllers\API\FileUploadController;

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
    return view('home.index');
});
Route::get('/about', [AboutController::class,'about']);
Route::get('/years',[YearsController::class, 'years']);
Route::get('/years/{year}',[YearsController::class, 'year']);
Route::get('/name', [NameController::class, 'index']);
Route::get('file-upload', [FileUploadController::class, 'index']);
Route::post('file-upload', [FileUploadController::class, 'store'])->name('file.store');

