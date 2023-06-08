<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

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

	public function RelationTags(): void
	{
		foreach ($this->request->nom_tags_parent as $key => $nom_tag_parent) {
			$this->RelationTag($nom_tag_parent, $this->request->nom_tags_enfant[$key]);
		}
	}

	public function RelationTag(string $nom_tag_parent, string $nom_tag_enfant): void
	{
		RelationTag::create([
			'nom_tag_parent' => $nom_tag_parent,
			'nom_tag_enfant' => $nom_tag_enfant,
		]);
	}
}
