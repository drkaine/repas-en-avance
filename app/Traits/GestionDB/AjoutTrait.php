<?php

declare(strict_types = 1);

namespace App\Traits\GestionDB;

use App\Models\Auteur;
use App\Models\CarnetRecette;
use App\Models\Ingredient;
use App\Models\ModeDeCuisson;
use App\Models\Photo;
use App\Models\Recette;
use App\Models\RegimeAlimentaire;
use App\Models\RelationTag;
use App\Models\Tag;
use App\Models\User;
use App\Models\Ustensile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait AjoutTrait
{
	public function nouveauUser(Request $request): User
	{
		$user = new User;
		$user = $user->create([
			'nom' => $request->nom,
			'prenom' => $request->prenom,
			'email' => $request->email,
			'password' => bcrypt($request->password),
		]);

		return $user;
	}

	public function nouveauTag(Request $request): int
	{
		$tag = new Tag;
		$tag = $tag->create([
			'nom' => $request->nom,
		]);

		return $tag->id;
	}

	public function relationTagsParent(int $id_tag_enfant, array $tags_parent): void
	{
		foreach ($tags_parent as $id_tag_parent) {
			$this->nouvelleRelationTag((int) $id_tag_parent, $id_tag_enfant);
		}
	}

	public function relationTagsEnfant(int $id_tag_parent, array $tags_enfant): void
	{
		foreach ($tags_enfant as $id_tag_enfant) {
			$this->nouvelleRelationTag($id_tag_parent, (int) $id_tag_enfant);
		}
	}

	public function nouvelleRelationTag(int $id_tag_parent, int $id_tag_enfant): void
	{
		$relation_tag = new RelationTag;
		$relation_tag->create([
			'id_tag_parent' => $id_tag_parent,
			'id_tag_enfant' => $id_tag_enfant,
		]);
	}

	public function nouvelleRecette(Request $request): Recette
	{
		$recette = new Recette;
		$recette = $recette->create([
			'nom' => $request->nom,
			'temps_preparation' => $request->temps_preparation,
			'temps_cuisson' => $request->temps_cuisson,
			'temps_repos' => $request->temps_repos,
			'lien' => $request->lien,
			'url' => Str::slug($request->nom),
			'instruction' => $request->instruction,
			'description' => $request->description,
			'reference_livre' => $request->reference_livre,
		]);

		return $recette;
	}

	public function nouvelAuteur(string $nom, string $prenom, ?int $id): Auteur
	{
		$auteur = new Auteur;
		$auteur = $auteur->create([
			'nom' => $nom,
			'prenom' => $prenom,
			'id_user' => $id,
		]);

		return $auteur;
	}

	public function regimesAlimentaires(array $regimes_alimentaires, int $id_user): void
	{
		foreach ($regimes_alimentaires as $id_tag) {
			$this->nouveauRegimeAlimentaire((int) $id_tag, $id_user);
		}
	}

	public function ustensile(array $tag, int $id_recette): void
	{
		foreach ($tag as $id_tag) {
			$this->nouvelUstensile((int) $id_tag, $id_recette);
		}
	}

	public function modeDeCuisson(array $tag, int $id_recette): void
	{
		foreach ($tag as $id_tag) {
			$this->nouveauModeDeCuisson((int) $id_tag, $id_recette);
		}
	}

	public function ingredient(array $tag, array $quantitees, int $id_recette): void
	{
		foreach ($tag as $id_tag) {
			$this->nouvelIngredient((int) $id_tag, (int) $quantitees[$id_tag], $id_recette);
		}
	}

	private function nouveauRegimeAlimentaire(int $id_tag, $id_user): void
	{
		$user_tag = new RegimeAlimentaire;

		$user_tag->create([
			'id_user' => $id_user,
			'id_tag' => $id_tag,
		]);
	}

	private function nouvelUstensile(int $id_tag, $id_recette): void
	{
		$recette_tag = new Ustensile;

		$recette_tag->create([
			'id_recette' => $id_recette,
			'id_tag' => $id_tag,
		]);
	}

	private function nouveauModeDeCuisson(int $id_tag, $id_recette): void
	{
		$recette_tag = new ModeDeCuisson;

		$recette_tag->create([
			'id_recette' => $id_recette,
			'id_tag' => $id_tag,
		]);
	}

	private function nouvelIngredient(int $id_tag, int $quantite, int $id_recette): void
	{
		$recette_tag = new Ingredient;

		$recette_tag->create([
			'id_recette' => $id_recette,
			'id_tag' => $id_tag,
			'quantite' => $quantite,
		]);
	}

	private function nouvellePhoto(Recette $recette): void
	{
		$photo = new Photo;

		$photo->create([
			'id_recette' => $recette->id,
			'nom' => $recette->url,
			'description' => $recette->description,
			'dossier' => 'storage/images/',
		]);
	}

	private function nouveauCarnetRecettes(int $id_user, int $id_recette): void
	{
		$caret_recettes = new CarnetRecette;

		$caret_recettes->create([
			'id_user' => $id_user,
			'id_recette' => $id_recette,
		]);
	}
}
