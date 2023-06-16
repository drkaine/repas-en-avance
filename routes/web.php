<?php

declare(strict_types = 1);

use App\Http\Controllers\AffichageDonneeDesVueController;
use App\Http\Controllers\AnonymisationDunUserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DeconnexionUserController;
use App\Http\Controllers\EnvoieFormulaire\EnvoieFormulaireAjoutRecetteController;
use App\Http\Controllers\EnvoieFormulaire\EnvoieFormulaireAjoutTagController;
use App\Http\Controllers\EnvoieFormulaire\EnvoieFormulaireConnexionController;
use App\Http\Controllers\EnvoieFormulaire\EnvoieFormulaireInscriptionController;
use App\Http\Controllers\ModificationDesDonneesDunUserController;
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

Route::get(
	'/',
	function () {
		return view('accueil');
	}
)->name('accueil');

Route::get(
	'inscription',
	[
		AffichageDonneeDesVueController::class,
		'inscription',
	]
)->name('inscription');

Route::post(
	'inscription',
	[
		EnvoieFormulaireInscriptionController::class,
		'inscription',
	]
)->name('inscription');

Route::get(
	'connexion',
	function () {
		return view('connexion');
	}
)->name('connexion');

Route::post(
	'connexion',
	[
		EnvoieFormulaireConnexionController::class,
		'connexion',
	]
)->name('connexion');

Route::get(
	'deconnexion',
	[
		DeconnexionUserController::class,
		'deconnexion',
	]
)->name('deconnexion');

Route::get(
	'ajout_tag',
	[
		AffichageDonneeDesVueController::class,
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
	[
		Controller::class,
		'affichageAjoutRecette',
	]
)->name('ajout_recette');

Route::post(
	'ajout_recette',
	[
		EnvoieFormulaireAjoutrecetteController::class,
		'ajoutRecette',
	]
)->name('ajout_recette');

Route::get(
	'mon_compte',
	[
		AffichageDonneeDesVueController::class,
		'user',
	]
)->name('mon_compte');

Route::get(
	'anonymisation_du_compte',
	[
		AnonymisationDunUserController::class,
		'anonymisationDuCompte',
	]
)->name('anonymisation_du_compte');

Route::post(
	'modification_user',
	[
		ModificationDesDonneesDunUserController::class,
		'ModificationUser',
	]
)->name('modification_user');
