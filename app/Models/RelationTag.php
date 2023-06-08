<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationTag extends Model
{
	use HasFactory;

	protected $fillable = [
		'nom_tag_parent',
		'nom_tag_enfant',
	];
}
