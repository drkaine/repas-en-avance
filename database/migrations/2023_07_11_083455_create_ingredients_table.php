<?php

declare(strict_types = 1);

use App\Models\Recette;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('ingredients', function (Blueprint $table): void {
			$table->foreignIdFor(Tag::class, 'id_tag');
			$table->foreignIdFor(Recette::class, 'id_recette');
			$table->string('quantite');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('ingredients');
	}
};
