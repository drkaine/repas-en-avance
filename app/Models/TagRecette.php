<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagRecette extends Model
{
	use HasFactory;

	protected $table = 'tags_recette';

	protected $fillable = [
		'id_recette',
		'id_tag',
	];
}
