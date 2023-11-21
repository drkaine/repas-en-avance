<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
	use HasFactory;

	protected $fillable = [
		'nom',
		'prenom',
		'id_user',
	];
}
