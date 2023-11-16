<?php

declare(strict_types = 1);

namespace App\Traits;

use App\Models\CarnetRecette;
use App\Models\RegimeAlimentaire;
use App\Models\User;
use Illuminate\Support\Collection;

trait SuppressionEnDBTrait
{
	public function regimeAlimentaireParIdUser(int $id_user): void
	{
		$regime_alimentaire = new RegimeAlimentaire;

		$regime_alimentaire->where('id_user', $id_user)->
			delete();
	}

	public function carnetRecetteParIdUserEtIdRecette(int $id_user, int $id_recette): void
	{
		$carnet_recettes = new CarnetRecette;

		$carnet_recettes = $carnet_recettes->
			where('id_recette', $id_recette)->
			where('id_user', $id_user)->
			delete();
	}

	public function userParListIdUser(Collection $list_id_user): void
	{
		$users = new User;

		$users->whereIn('id', $list_id_user)->
			delete();
	}

	public function regimeAlimentaireParListIdUser(Collection $list_id_user): void
	{
		$regimes_alimentaires = new RegimeAlimentaire;

		$regimes_alimentaires->whereIn('id_user', $list_id_user)->
			delete();
	}
}
