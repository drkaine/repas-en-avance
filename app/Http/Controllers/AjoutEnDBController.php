<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\RelationTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class AjoutEnDBController extends Controller
{
	public function __construct(private Request $request)
	{

	}

	public function user(): void
	{
		User::create([
			'nom' => $this->request->nom,
			'email' => $this->request->email,
			'password' => bcrypt($this->request->password),
		]);
	}

	public function tag(): int
	{
		$tag = Tag::create([
			'nom' => $this->request->nom,
		]);

		return $tag->id;
	}

	public function RelationTagsParent(int $id_tag_enfant): void
	{
		foreach ($this->request->id_tags_parent as $id_tag_parent) {
			$this->RelationTag($id_tag_parent, $id_tag_enfant);
		}
	}

	public function RelationTagsEnfant(int $id_tag_parent): void
	{
		foreach ($this->request->id_tags_enfant as $id_tag_enfant) {
			$this->RelationTag($id_tag_parent, $id_tag_enfant);
		}
	}

	public function RelationTag(int $id_tag_parent, int $id_tag_enfant): void
	{
		RelationTag::create([
			'id_tag_parent' => $id_tag_parent,
			'id_tag_enfant' => $id_tag_enfant,
		]);
	}

	public function recette(): void
	{
		Recette::create([
			'nom' => $this->request->nom,
			'temps_preparation' => $this->request->temps_preparation,
			'temps_cuisson' => $this->request->temps_cuisson,
			'temps_repos' => $this->request->temps_repos,
			'lien' => $this->request->lien,
			'instruction' => $this->request->instruction,
			'description' => $this->request->description,
			'reference_livre' => $this->request->reference_livre,
		]);
	}
}
