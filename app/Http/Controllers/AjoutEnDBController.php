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

	public function tag(): void
	{
		Tag::create([
			'nom' => $this->request->nom,
		]);
	}

	public function RelationTagsParent(): void
	{
		foreach ($this->request->nom_tags_parent as $tag_parent) {
			$this->RelationTag($tag_parent, $this->request->nom);
		}
	}

	public function RelationTagsEnfant(): void
	{
		foreach ($this->request->nom_tags_enfant as $tag_enfant) {
			$this->RelationTag($this->request->nom, $tag_enfant);
		}
	}

	public function RelationTag(string $nom_tag_parent, string $nom_tag_enfant): void
	{
		RelationTag::create([
			'nom_tag_parent' => $nom_tag_parent,
			'nom_tag_enfant' => $nom_tag_enfant,
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
