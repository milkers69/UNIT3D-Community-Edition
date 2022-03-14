<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

/**
 * @see \App\Http\Controllers\RssController
 */
class RssControllerTest extends TestCase
{
    /** @test */
    public function create_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $categories = \App\Models\Category::factory()->times(3)->create();
        $types = \App\Models\Type::factory()->times(3)->create();
        $resolutions = \App\Models\Resolution::factory()->times(3)->create();
        $genres = \App\Models\Genre::factory()->times(3)->create();

        $response = $this->get(route('rss.create'));

        $response->assertOk();
        $response->assertViewIs('rss.create');
        $response->assertViewHas('categories', $categories);
        $response->assertViewHas('types', $types);
        $response->assertViewHas('resolutions', $resolutions);
        $response->assertViewHas('genres', $genres);
        $response->assertViewHas('user');

        // TODO: perform additional assertions
    }

    /** @test */
    public function destroy_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $rss = \App\Models\Rss::factory()->create();

        $response = $this->delete(route('rss.destroy', ['id' => $rss->id]));

        $response->assertOk();
        $this->assertDeleted($rss);

        // TODO: perform additional assertions
    }

    /** @test */
    public function edit_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $rss = \App\Models\Rss::factory()->create();
        $categories = \App\Models\Category::factory()->times(3)->create();
        $types = \App\Models\Type::factory()->times(3)->create();
        $resolutions = \App\Models\Resolution::factory()->times(3)->create();
        $genres = \App\Models\Genre::factory()->times(3)->create();

        $response = $this->get(route('rss.edit', ['id' => $rss->id]));

        $response->assertOk();
        $response->assertViewIs('rss.edit');
        $response->assertViewHas('categories', $categories);
        $response->assertViewHas('types', $types);
        $response->assertViewHas('resolutions', $resolutions);
        $response->assertViewHas('genres', $genres);
        $response->assertViewHas('user');
        $response->assertViewHas('rss', $rss);

        // TODO: perform additional assertions
    }

    /** @test */
    public function index_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $rsses = \App\Models\Rss::factory()->times(3)->create();

        $response = $this->get(route('rss.index'));

        $response->assertOk();
        $response->assertViewIs('rss.index');
        $response->assertViewHas('hash');
        $response->assertViewHas('public_rss');
        $response->assertViewHas('private_rss');
        $response->assertViewHas('user');

        // TODO: perform additional assertions
    }

    /** @test */
    public function show_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $user = \App\Models\User::factory()->create();
        $rss = \App\Models\Rss::factory()->create();

        $response = $this->get(route('rss.show.rsskey', ['id' => $rss->id, 'rsskey' => $rss->rsskey]));

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /** @test */
    public function store_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $response = $this->post(route('rss.store'), [
            // TODO: send request data
        ]);

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /** @test */
    public function update_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $rss = \App\Models\Rss::factory()->create();

        $response = $this->patch(route('rss.update', ['id' => $rss->id]), [
            // TODO: send request data
        ]);

        $response->assertOk();

        // TODO: perform additional assertions
    }

    // test cases...
}
