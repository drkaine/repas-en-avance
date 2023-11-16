<?php

declare(strict_types = 1);

namespace App\Traits\GestionDB;

use App\Models\CarnetRecette;
use App\Models\Recette;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

trait SelectTrait
{
	public function premierTagParNom(string $nom): Tag
	{
		$tag = new Tag;

		$premier_tag = $tag->select('id')->
			where('nom', $nom)->
			first();

		return $premier_tag;
	}

	public function userParEmail(string $email): User
	{
		$user = new User;

		$user = $user->
			where('email', $email)->
			first();

		return $user;
	}

	public function recetteParUrl(string $nom_recette): Recette
	{
		$recette = new Recette;

		$recette = $recette->with('recuperationIngredient')->
			with('recuperationPhoto')->
			where('url', $nom_recette)->
			first();

		return $recette;
	}

	public function carnetRecettesParUser(User $user): Collection
	{
		$carnet_recettes = $user->
			with('recuperationCarnetRecettes')->
			first()->recuperationCarnetRecettes;

		return $carnet_recettes;
	}

	public function carnetRecetteParIdUserEtListIdRecette(int $id_user, array $list_id_recette): Collection
	{
		$carnet_recette = new CarnetRecette;

		$list_id_recette = $carnet_recette->
				select('id_recette')->
				where('id_user', $id_user)->
				whereIn('id_recette', $list_id_recette)->
				get();

		return $list_id_recette;
	}

	public function toutLesTags(): Collection
	{
		$tag = new Tag;

		$tags = $tag->select('id', 'nom')->
			get();

		return $tags;
	}

	public function toutesLesRecettes(string $filtre = 'id'): Collection
	{
		$recette = new Recette;

		$recettes = $recette->
			with('recuperationIngredient')->
			with('recuperationPhoto')->
			orderByDesc($filtre)->
			get();

		return $recettes;
	}

	public function toutesLesRecettesParListIdRecette(array $id_recette): Collection
	{
		$recette = new Recette;

		$recettes = $recette->
			with('recuperationIngredient')->
			with('recuperationPhoto')->
			whereIn('id', $id_recette)->
			get();

		return $recettes;
	}
}
