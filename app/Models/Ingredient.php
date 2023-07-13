<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingredient extends Model
{
	use HasFactory;

	protected $fillable = [
		'id_recette',
		'id_tag',
		'quantite',
	];

	public function recuperationRecette(): BelongsTo
	{
		return $this->belongsTo(Recette::class, 'id_recette');
	}

	public function recuperationTag(): BelongsTo
	{
		return $this->belongsTo(Tag::class, 'id_tag');
	}
}
