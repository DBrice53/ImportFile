<?php

use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ImportController::class, 'index'])->name('home');
Route::post('/import', [ImportController::class, 'import'])->name('import');
