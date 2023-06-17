<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagUser extends Model
{
	use HasFactory;

	protected $table = 'tags_user';

	protected $fillable = [
		'id_user',
		'id_tag',
	];
}
