<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
	use HasFactory;

	protected $fillable = [
		'nom',
	];

	public function recuperationTagParents(): BelongsToMany
	{
		return $this->belongsToMany(Tag::class, 'relation_tags', 'id_tag_enfant', 'id_tag_parent');
	}

	public function recuperationTagEnfants(): BelongsToMany
	{
		return $this->belongsToMany(Tag::class, 'relation_tags', 'id_tag_parent', 'id_tag_enfant');
	}

	public function recuperationUsers(): BelongsToMany
	{
		return $this->belongsToMany(User::class, 'regimes_alimentaires', 'id_tag', 'id_user');
	}
}
