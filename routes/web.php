<?php

declare(strict_types = 1);

use App\Http\Controllers\AffichageDonneesController;
use App\Http\Controllers\AnonymisationDeDonneesController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DeconnexionController;
use App\Http\Controllers\EnvoieFormulaire\AjoutRecetteController;
use App\Http\Controllers\EnvoieFormulaire\AjoutTagController;
use App\Http\Controllers\EnvoieFormulaire\ConnexionController;
use App\Http\Controllers\EnvoieFormulaire\InscriptionController;
use App\Http\Controllers\EnvoieFormulaire\RecuperationDoneesAnonymiserController;
use App\Http\Controllers\ModificationDeDonneesController;
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
		AffichageDonneesController::class,
		'pageinscription',
	]
)->name('inscription');

Route::post(
	'inscription',
	[
		InscriptionController::class,
		'inscription',
	]
)->name('inscription');

Route::get(
	'confirmation_email/{email_user}',
	[
		ConfirmationController::class,
		'confirmationEmail',
	]
)->name('confirmation_email');

Route::get(
	'connexion',
	[
		Controller::class,
		'affichageConnexion',
	]
)->name('connexion');

Route::post(
	'connexion',
	[
		ConnexionController::class,
		'connexion',
	]
)->name('connexion');

Route::get(
	'deconnexion',
	[
		DeconnexionController::class,
		'user',
	]
)->name('deconnexion');

Route::get(
	'ajout_tag',
	[
		AffichageDonneesController::class,
		'pageAjoutTag',
	]
)->name('ajout_tag');

Route::post(
	'ajout_tag',
	[
		AjoutTagController::class,
		'ajoutTag',
	]
)->name('ajout_tag');

Route::get(
	'ajout_recette',
	[
		AffichageDonneesController::class,
		'affichageAjoutRecette',
	]
)->name('ajout_recette');

Route::post(
	'ajout_recette',
	[
		AjoutRecetteController::class,
		'ajoutRecette',
	]
)->name('ajout_recette');

Route::get(
	'mon_compte',
	[
		AffichageDonneesController::class,
		'pageMonCompte',
	]
)->name('mon_compte');

Route::get(
	'anonymisation_du_compte',
	[
		AnonymisationDeDonneesController::class,
		'compteUser',
	]
)->name('anonymisation_du_compte');

Route::post(
	'modification_user',
	[
		ModificationDeDonneesController::class,
		'monCompte',
	]
)->name('modification_user');

Route::get(
	'recuperation_compte',
	function () {
		return view('recuperation_compte');
	}
)->name('recuperation_compte');

Route::post(
	'recuperation_compte',
	[
		RecuperationDoneesAnonymiserController::class,
		'monCompte',
	]
)->name('recuperation_compte');

Route::get(
	'catalogue_recettes',
	[
		AffichageDonneesController::class,
		'pageCatalogueRecettes',
	]
)->name('catalogue_recettes');
