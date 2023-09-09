<?php

declare(strict_types = 1);

use App\Models\Photo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('photos', function (Blueprint $table): void {
			$table->id();
			$table->foreignIdFor(Photo::class, 'id_recette');
			$table->timestamps();
			$table->string('nom');
			$table->string('dossier');
			$table->text('description');

		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('photos');
	}
};
