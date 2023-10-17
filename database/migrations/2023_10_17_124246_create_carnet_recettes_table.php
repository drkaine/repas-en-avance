<?php

declare(strict_types = 1);

use App\Models\Recette;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('carnet_recettes', function (Blueprint $table): void {
			$table->foreignIdFor(Recette::class, 'id_recette');
			$table->foreignIdFor(User::class, 'id_user');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('carnet_recette');
	}
};
