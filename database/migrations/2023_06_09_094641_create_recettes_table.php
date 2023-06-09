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
		Schema::create('recettes', function (Blueprint $table): void {
			$table->id();
			$table->timestamps();
			$table->integer('temps_preparation');
			$table->string('nom');
			$table->integer('temps_cuisson')->nullable();
			$table->integer('temps_repos')->nullable();
			$table->string('lien')->nullable();
			$table->string('instruction')->nullable();
			$table->string('description')->nullable();
			$table->string('reference_livre')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('recettes');
	}
};
