<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FormController;

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
    return view('pages.welcome');
})->name('welcome');

Route::resource('/book', BookController::class);

Route::post('/submit', function (Illuminate\Http\Request $request) {
    $username = $request->input('name');
    $nrp = $request->input('nrp');

    // Lakukan sesuatu dengan data ini, misalnya menyimpannya ke database.
    return "Name: $name, NRP: $nrp";
})->name('submitForm');

Route::get('/form/create', [FormController::class, 'create'])->name('form.create');
Route::post('/form/store', [FormController::class, 'store'])->name('form.store');



