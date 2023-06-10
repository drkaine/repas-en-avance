<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
	use HasFactory;

	protected $fillable = [
		'nom',
		'temps_preparation',
		'temps_cuisson',
		'temps_repos',
		'lien',
		'instruction',
		'description',
		'reference_livre',
	];
}
