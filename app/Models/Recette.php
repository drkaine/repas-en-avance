<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recette extends Model
{
	use HasFactory;

	protected $fillable = [
		'nom',
		'temps_preparation',
		'temps_cuisson',
		'temps_repos',
		'lien',
		'url',
		'instruction',
		'description',
		'reference_livre',
	];

	public function recuperationIngredient(): BelongsToMany
	{
		return $this->belongsToMany(Tag::class, 'ingredients', 'id_recette', 'id_tag');
	}
}
