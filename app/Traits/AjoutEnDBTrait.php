<?php

declare(strict_types = 1);

namespace App\Traits;

use App\Models\Recette;
use App\Models\RelationTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

trait AjoutEnDBTrait
{
	public function user(Request $request): void
	{
		$user = new User;
		$user->create([
			'nom' => $request->nom,
			'email' => $request->email,
			'password' => bcrypt($request->password),
		]);
	}

	public function tag(Request $request): int
	{
		$tag = new Tag;
		$tag = $tag->create([
			'nom' => $request->nom,
		]);

		return $tag->id;
	}

	public function RelationTagsParent(int $id_tag_enfant, Request $request): void
	{
		foreach ($request->id_tags_parent as $id_tag_parent) {
			$this->RelationTag($id_tag_parent, $id_tag_enfant);
		}
	}

	public function RelationTagsEnfant(int $id_tag_parent, Request $request): void
	{
		foreach ($request->id_tags_enfant as $id_tag_enfant) {
			$this->RelationTag($id_tag_parent, $id_tag_enfant);
		}
	}

	public function RelationTag(int $id_tag_parent, int $id_tag_enfant): void
	{
		$relation_tag = new RelationTag;
		$relation_tag->create([
			'id_tag_parent' => $id_tag_parent,
			'id_tag_enfant' => $id_tag_enfant,
		]);
	}

	public function recette(Request $request): void
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
}
