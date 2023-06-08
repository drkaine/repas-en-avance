<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('relation_tags', function (Blueprint $table): void {
			$table->string('nom_tag_parent');
			$table->string('nom_tag_enfant');
			$table->timestamps();
			$table->foreign('nom_tag_parent')->references('nom')->on('tags');
			$table->foreign('nom_tag_enfant')->references('nom')->on('tags');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('relation_tags');
	}
};
