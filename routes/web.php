<?php

declare(strict_types = 1);

use App\Http\Controllers\AffichageDonneeDeLaVueController;
use App\Http\Controllers\EnvoieFormulaireAjoutRecetteController;
use App\Http\Controllers\EnvoieFormulaireAjoutTagController;
use App\Http\Controllers\EnvoieFormulaireConnexionController;
use App\Http\Controllers\EnvoieFormulaireInscriptionController;
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
		EnvoieFormulaireInscriptionController::class,
		'inscription',
	]
)->name('inscription');

Route::get('connexion', function () {
	return view('connexion');
})->name('connexion');

Route::post(
	'connexion',
	[
		EnvoieFormulaireConnexionController::class,
		'connexion',
	]
)->name('connexion');

Route::get(
	'ajout_tag',
	[
		AffichageDonneeDeLaVueController::class,
		'ajoutTag',
	]
)->name('ajout_tag');

Route::post(
	'ajout_tag',
	[
		EnvoieFormulaireAjoutTagController::class,
		'ajoutTag',
	]
)->name('ajout_tag');

Route::get(
	'ajout_recette',
	function () {
		return view('ajout_recette');
	}
)->name('ajout_recette');

Route::post(
	'ajout_recette',
	[
		EnvoieFormulaireAjoutrecetteController::class,
		'ajoutRecette',
	]
)->name('ajout_recette');
