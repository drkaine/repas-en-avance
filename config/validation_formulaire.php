<?php

declare(strict_types = 1);

return [
	'ajout_recette' => [
		'nom' => 'required|string|max:255|min:3',
		'temps_preparation' => 'required|integer',
		'instruction' => 'required|string|min:5',
		'description' => 'required|string|min:5',
		'ingredients' => 'required|array',
		'quantitees' => 'required|array',
	],
	'ajout_tag' => [
		'nom' => 'required|string|max:100|min:3',
	],
	'connexion' => [
		'email' => 'required|string|email|max:255|min:6',
		'password' => 'required|string|min:8|max:255',
	],
	'inscription' => [
		'nom' => 'required|string|max:100|min:3',
		'email' => 'required|string|email|unique:users|max:255|min:6',
		'password' => 'required|string|min:8|confirmed|max:255',
	],
];
