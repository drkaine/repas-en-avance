<?php

declare(strict_types = 1);

namespace App\Services;

use App\Models\Tag;
use App\Traits\GestionDB\SelectTrait;

class RecuperationTagService
{
	use SelectTrait;

	public function premierParNom(string $nom): Tag
	{
		$premier_tag = $this->premierTagParNom($nom);

		return $premier_tag;
	}
}
