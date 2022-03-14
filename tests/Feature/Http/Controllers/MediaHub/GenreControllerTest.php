<?php

namespace Tests\Feature\Http\Controllers\MediaHub;

use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MediaHub\GenreController
 */
class GenreControllerTest extends TestCase
{
    /** @test */
    public function index_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $genres = \App\Models\Genre::factory()->times(3)->create();

        $response = $this->get(route('mediahub.genres.index'));

        $response->assertOk();
        $response->assertViewIs('mediahub.genre.index');
        $response->assertViewHas('genres', $genres);

        // TODO: perform additional assertions
    }

    /** @test */
    public function show_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $genre = \App\Models\Genre::factory()->create();

        $response = $this->get(route('mediahub.genres.show', ['id' => $genre->id]));

        $response->assertOk();
        $response->assertViewIs('mediahub.genre.show');
        $response->assertViewHas('genre', $genre);
        $response->assertViewHas('shows');
        $response->assertViewHas('movies');

        // TODO: perform additional assertions
    }

    // test cases...
}
