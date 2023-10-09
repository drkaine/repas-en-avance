<?php

declare(strict_types = 1);

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;

$date = new Carbon;

return [
	'user' => [
		'nom' => 'Test user',
		'email' => 'email@test.fr',
		'password' => 'password',
		'email_verified_at' => $date->now(),
	],
	'user_modifie' => [
		'nom' => 'Test user modifié',
		'email' => 'email_modifie@test.fr',
	],
	'user_anonyme' => [
		'email' => 'anonyme1@anonyme.fr',
		'nom' => 'Anonyme',
		'password' => 'password',
		'email_verified_at' => null,
		'derniere_connexion' => $date->now()->subMonths(7),
	],
	'user_anonyme_recupere' => [
		'email_anonyme' => 'anonyme1@anonyme.fr',
		'email' => 'test@test.fr',
		'nom' => 'test',
		'password' => 'password',
	],
	'mot_de_passe_oublie' => [
		'email' => 'email@test.fr',
		'password' => 'password6',
		'password_confirmation' => 'password6',
	],
	'tag' => [
		'nom' => 'Catégorie',
	],
	'tags_regimes_alimentaire' => [
		[
			'nom' => 'Régime alimentaire',
		],
		[
			'nom' => 'Végan',
		],
		[
			'nom' => 'Végétarien',
		],
	],
	'recette' => [
		'temps_preparation' => 1,
		'temps_cuisson' => 2,
		'temps_repos' => 3,
		'lien' => 'https://ici.fr',
		'url' => 'carotte-simple',
		'instruction' => 'Eplucher les carottes',
		'description' => 'Recette simple et rapide',
		'reference_livre' => 'Tous en cuisine page 12',
		'nom' => 'Carotte simple',
	],
	'relation_tags' => [
		[
			'id_tag_parent' => 1,
			'id_tag_enfant' => 2,
		],
		[
			'id_tag_parent' => 2,
			'id_tag_enfant' => 1,
		],
		[
			'id_tag_parent' => 2,
			'id_tag_enfant' => 3,
		],
		[
			'id_tag_parent' => 3,
			'id_tag_enfant' => 4,
		],
		[
			'id_tag_parent' => 4,
			'id_tag_enfant' => 5,
		],
		[
			'id_tag_parent' => 5,
			'id_tag_enfant' => 6,
		],
		[
			'id_tag_parent' => 6,
			'id_tag_enfant' => 7,
		],
		[
			'id_tag_parent' => 7,
			'id_tag_enfant' => 8,
		],
		[
			'id_tag_parent' => 8,
			'id_tag_enfant' => 9,
		],
		[
			'id_tag_parent' => 9,
			'id_tag_enfant' => 10,
		],

	],
	'relation_tag' => [
		'id_tag_parent' => 1,
		'id_tag_enfant' => 2,
	],
	'relation_tag_inverse' => [
		'id_tag_parent' => 2,
		'id_tag_enfant' => 1,
	],
	'regime_alimentaire' => [
		'id_user' => 1,
		'id_tag' => 2,
	],
	'regime_alimentaire_modifie' => [
		'id_user' => 1,
		'id_tag' => 3,
	],
	'ustensile' => [
		'id_recette' => 1,
		'id_tag' => 2,
	],

	'mode_de_cuisson' => [
		'id_recette' => 1,
		'id_tag' => 2,
	],
	'ingredient' => [
		'id_recette' => 1,
		'id_tag' => 2,
		'quantite' => 1,
	],
	'tag_ustensile' => [
		[
			'nom' => 'Ustensiles',
		],
		[
			'nom' => 'Cuillère',
		],
	],
	'tag_mode_de_cuisson' => [
		[
			'nom' => 'Mode de cuisson',
		],
		[
			'nom' => 'Four',
		],
	],

	'tag_ingredient' => [
		[
			'nom' => 'Ingrédients',
		],
		[
			'nom' => 'Carotte',
		],
	],
	'fichier_photo' => UploadedFile::fake()->create(
		'carotte-simple.jpeg',
		1024,
		'images/recettes/'
	),
	'photo' => [
		'nom' => 'carotte-simple',
		'description' => 'Recette simple et rapide',
		'id_recette' => 1,
		'dossier' => 'images/recettes/',
	],
];
