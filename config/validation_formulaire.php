<?php

declare(strict_types = 1);

return [
	'ajoutRecette' => [
		'nom' => 'required|string|max:255|min:3',
		'temps_preparation' => 'required|integer',
		'lien' => 'string|min:12',
		'instruction' => 'string|min:5',
	],
	'ajoutTag' => [
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
