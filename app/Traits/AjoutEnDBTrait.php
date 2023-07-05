<?php

declare(strict_types = 1);

namespace App\Traits;

use App\Models\Recette;
use App\Models\RelationTag;
use App\Models\Tag;
use App\Models\TagUser;
use App\Models\User;
use Illuminate\Http\Request;

trait AjoutEnDBTrait
{
	public function nouveauUser(Request $request): User
	{
		$user = new User;
		$user = $user->create([
			'nom' => $request->nom,
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

	public function relationTagsParent(int $id_tag_enfant, Request $request): void
	{
		foreach ($request->id_tags_parent as $id_tag_parent) {
			$this->nouvelleRelationTag($id_tag_parent, $id_tag_enfant);
		}
	}

	public function relationTagsEnfant(int $id_tag_parent, Request $request): void
	{
		foreach ($request->id_tags_enfant as $id_tag_enfant) {
			$this->nouvelleRelationTag($id_tag_parent, $id_tag_enfant);
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

	public function nouvelleRecette(Request $request): void
	{
		$recette = new Recette;
		$recette->create([
			'nom' => $request->nom,
			'temps_preparation' => $request->temps_preparation,
			'temps_cuisson' => $request->temps_cuisson,
			'temps_repos' => $request->temps_repos,
			'lien' => $request->lien,
			'instruction' => $request->instruction,
			'description' => $request->description,
			'reference_livre' => $request->reference_livre,
		]);
	}

	public function tagsUser(array $regimes_alimentaires, int $id_user): void
	{
		foreach ($regimes_alimentaires as $id_tag) {
			$this->nouveauTagUser($id_tag, $id_user);
		}
	}

	private function nouveauTagUser(int $id_tag, $id_user): void
	{
		$user_tag = new TagUser;

		$user_tag->create([
			'id_user' => $id_user,
			'id_tag' => $id_tag,
		]);
	}
}
