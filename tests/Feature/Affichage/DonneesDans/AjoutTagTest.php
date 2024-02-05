<?php

declare(strict_types = 1);
uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

uses(Tests\Traits\ModelDeTestTrait::class);

test('tag dans ajout tag', function (): void {
	$this->userConnecte();

	$this->creation('Tag', 'tag');

	$response = $this->get('/ajout-tag');

	$tags = $response->viewData('tags');

	foreach ($tags as $tag) {
		$response->assertSee($tag->nom);
	}
});
