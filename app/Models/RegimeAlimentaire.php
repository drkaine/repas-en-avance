<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegimeAlimentaire extends Model
{
	use HasFactory;

	protected $table = 'regimes_alimentaires';

	protected $fillable = [
		'id_user',
		'id_tag',
	];
}
