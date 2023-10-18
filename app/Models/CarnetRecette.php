<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarnetRecette extends Model
{
	use HasFactory;

	protected $fillable = [
		'id_recette',
		'id_user',
	];
}
