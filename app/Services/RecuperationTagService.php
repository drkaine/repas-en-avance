<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Tag;

class RecuperationTagService
{
	private Tag $tag;

	public function __construct()
	{
		$this->tag = new Tag;
	}

	public function premierParNom(string $nom): Tag
	{
		$tag_recupere = $this->tag->select('id')->
			where('nom', $nom)->
			first();

		return $tag_recupere;
	}
}
