<?php

declare(strict_types = 1);

use App\Models\Auteur;
use App\Models\Recette;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('auteur_recettes', function (Blueprint $table): void {
			$table->foreignIdFor(Recette::class, 'id_recette');
			$table->foreignIdFor(Auteur::class, 'id_auteur');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('auteur_recettes');
	}
};
