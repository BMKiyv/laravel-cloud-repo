<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\YearsController;
use App\Http\Controllers\NameController;
use App\Http\Controllers\API\FileUploadController;
use App\Http\Controllers\StdController;

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
Route::get('/years',[YearsController::class, 'years'])->name('years');
Route::get('/years/{year}',[YearsController::class, 'year'])->name('years.year');
Route::post('/years/{year}/update',[YearsController::class,'update'])->name('years-update');
Route::get('/name', [NameController::class, 'index']);
Route::get('/years/{year}/{std}',[StdController::class,'std'])->name('years.std');
Route::post('/years/{year}/{std}/update',[StdController::class,'update'])->name('std-update');
Route::get('/years/{year}/{std}/delete',[StdController::class,'delete'])->name('std-delete');
Route::get('/years/{year}/{std}/download',[StdController::class,'download'])->name('std-download');
Route::get('file-upload', [FileUploadController::class, 'index'])->name('file');
Route::get('file-view', [FileUploadController::class, 'view'])->name('view');
Route::post('file-upload', [FileUploadController::class, 'store'])->name('file.store');

