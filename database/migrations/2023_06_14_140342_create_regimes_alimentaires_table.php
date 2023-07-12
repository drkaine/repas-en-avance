<?php

declare(strict_types = 1);

use App\Models\Tag;
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
		Schema::create('regimes_alimentaires', function (Blueprint $table): void {
			$table->foreignIdFor(Tag::class, 'id_tag');
			$table->foreignIdFor(User::class, 'id_user');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('regimes_alimentaires');
	}
};
