<?php

declare(strict_types = 1);

use App\Http\Controllers\AffichageDonneesController;
use App\Http\Controllers\AffichageRecetteController;
use App\Http\Controllers\AnonymisationDeDonneesController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DeconnexionController;
use App\Http\Controllers\EnvoieFormulaire\AjoutRecetteController;
use App\Http\Controllers\EnvoieFormulaire\AjoutTagController;
use App\Http\Controllers\EnvoieFormulaire\ConnexionController;
use App\Http\Controllers\EnvoieFormulaire\DemandeMotDePasseOublieController;
use App\Http\Controllers\EnvoieFormulaire\InscriptionController;
use App\Http\Controllers\EnvoieFormulaire\MotDePasseOublieController;
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
	[
		AffichageDonneesController::class,
		'pageAccueil',
	]
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
	'confirmation-email/{email_user}',
	[
		ConfirmationController::class,
		'confirmationEmail',
	]
)->name('confirmation-email');

Route::post(
	'mot-de-passe-oublie',
	[
		MotDePasseOublieController::class,
		'validationFormulaire',
	]
)->name('mot-de-passe-oublie-post');

Route::get(
	'mot-de-passe-oublie/{identifiant_user}',
	[
		Controller::class,
		'affichageMotDePasseOublie',
	]
)->name('mot-de-passe-oublie');

Route::post(
	'demande-mot-de-passe-oublie',
	[
		DemandeMotDePasseOublieController::class,
		'validationFormulaire',
	]
)->name('demande-mot-de-passe-oublie');

Route::get(
	'demande-mot-de-passe-oublie',
	[
		Controller::class,
		'affichageDemandeMotDePasseOublie',
	]
)->name('demande-mot-de-passe-oublie');

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
	'ajout-tag',
	[
		AffichageDonneesController::class,
		'pageAjoutTag',
	]
)->name('ajout-tag');

Route::post(
	'ajout-tag',
	[
		AjoutTagController::class,
		'ajoutTag',
	]
)->name('ajout-tag');

Route::get(
	'ajout-recette',
	[
		AffichageDonneesController::class,
		'affichageAjoutRecette',
	]
)->name('ajout-recette');

Route::post(
	'ajout-recette',
	[
		AjoutRecetteController::class,
		'ajoutRecette',
	]
)->name('ajout-recette');

Route::get(
	'mon-compte',
	[
		AffichageDonneesController::class,
		'pageMonCompte',
	]
)->name('mon-compte');

Route::get(
	'anonymisation-du-compte',
	[
		AnonymisationDeDonneesController::class,
		'compteUser',
	]
)->name('anonymisation-du-compte');

Route::post(
	'modification-user',
	[
		ModificationDeDonneesController::class,
		'monCompte',
	]
)->name('modification-user');

Route::get(
	'recuperation-compte',
	function () {
		return view('recuperation_compte');
	}
)->name('recuperation-compte');

Route::post(
	'recuperation-compte',
	[
		RecuperationDoneesAnonymiserController::class,
		'monCompte',
	]
)->name('recuperation-compte');

Route::get(
	'catalogue-recettes',
	[
		AffichageDonneesController::class,
		'pageCatalogueRecettes',
	]
)->name('catalogue-recettes');

Route::get(
	'recette/{nom_recette}',
	[
		AffichageRecetteController::class,
		'Recette',
	]
)->name('recette');
