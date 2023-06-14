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

	public function tagParents(): BelongsToMany
	{
		return $this->belongsToMany(Tag::class, 'relation_tags', 'id_tag_enfant', 'id_tag_parent');
	}

	public function tagEnfants(): BelongsToMany
	{
		return $this->belongsToMany(Tag::class, 'relation_tags', 'id_tag_parent', 'id_tag_enfant');
	}

	public function users(): BelongsToMany
	{
		return $this->belongsToMany(User::class, 'tags_users', 'id_tag', 'id_user');
	}
}
