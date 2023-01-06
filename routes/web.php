<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\YearsController;
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

Route::get('/', [HomeController::class,'index']);
Route::get('/about', [AboutController::class,'about']);
Route::get('/years',[YearsController::class, 'index'])->name('years');
Route::get('/years/{year}',[YearsController::class, 'show'])->name('years.show');
Route::post('/years/{year}/update',[YearsController::class,'store'])->name('years.store');

Route::get('/years/{year}/{std}',[StdController::class,'index'])->name('stds.index');
Route::post('/years/{year}/{std}/update',[StdController::class,'update'])->name('std-update');
Route::get('/years/{year}/{std}/delete',[StdController::class,'delete'])->name('std-delete');
Route::get('/years/{year}/{std}/download',[StdController::class,'download'])->name('std-download');

Route::get('file-upload', [FileUploadController::class, 'index'])->name('file');
Route::get('file-view', [FileUploadController::class, 'view'])->name('view');
Route::post('file-upload', [FileUploadController::class, 'store'])->name('file.store');

Route::resource('/companies', 'CompanyController');
