<?php

declare(strict_types = 1);
use Carbon\Carbon;

$date = new Carbon;

return [
	'user' => [
		'nom' => 'Test user',
		'email' => 'email@test.fr',
		'password' => 'password',
	],
	'user_modifie' => [
		'nom' => 'Test user modifié',
		'email' => 'email_modifie@test.fr',
	],
	'user_anonyme' => [
		'email' => 'anonyme1@anonyme.fr',
		'nom' => 'Anonyme',
		'password' => 'anonyme',
		'email_verified_at' => null,
		'derniere_connexion' => $date->now()->subMonths(7),
	],
	'user_anonyme_recupere' => [
		'email_anonyme' => 'anonyme1@anonyme.fr',
		'email' => 'test@test.fr',
		'nom' => 'test',
		'password' => 'anonyme',
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
			'id_tag_parent' => 1,
			'id_tag_enfant' => 3,
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
	'tag_user' => [
		'id_user' => 1,
		'id_tag' => 2,
	],
	'tag_user_modifie' => [
		'id_user' => 1,
		'id_tag' => 3,
	],
	'tag_recette' => [
		'id_recette' => 1,
		'id_tag' => 2,
	],
	'ustensile' => [
		[
			'nom' => 'Ustensiles',
		],
		[
			'nom' => 'Cuillère',
		],
	],
];
