<?php

declare(strict_types = 1);

return [
	'ajout_recette' => [
		'nom' => 'required|string|max:255|min:3',
		'temps_preparation' => 'required|integer',
		'ingredients' => 'required|array',
		'quantitees' => 'required|array',
		'photos' => 'required|array',
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
	'demande_mot_de_passe_oublie' => [
		'email' => 'required|string|email|max:255|min:6',
	],
	'mot_de_passe_oublie' => [
		'email' => 'required|string|email|max:255|min:6',
		'password' => 'required|string|min:8|max:255|confirmed',
	],
	'recuperation_compte' => [
		'nom' => 'required|string|max:100|min:3',
		'email' => 'required|string|email|unique:users|max:255|min:6',
		'password' => 'required|string|min:8|max:255',
	],
];
