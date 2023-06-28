<?php

declare(strict_types = 1);

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
];
