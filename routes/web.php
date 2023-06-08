<?php

declare(strict_types = 1);

use App\Http\Controllers\EnvoieFormulaireController;
use Illuminate\Support\Facades\Route;

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
	return view('accueil');
})->name('accueil');

Route::get('inscription', function () {
	return view('inscription');
})->name('inscription');

Route::post(
	'inscription',
	[
		EnvoieFormulaireController::class,
		'inscription',
	]
)->name('inscription');

Route::get('connexion', function () {
	return view('connexion');
})->name('connexion');

Route::post(
	'connexion',
	[
		EnvoieFormulaireController::class,
		'connexion',
	]
)->name('connexion');
