<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PageController
 */
class PageControllerTest extends TestCase
{
    /** @test */
    public function about_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $response = $this->get(route('about'));

        $response->assertOk();
        $response->assertViewIs('page.aboutus');

        // TODO: perform additional assertions
    }

    /** @test */
    public function blacklist_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $response = $this->get(route('blacklist'));

        $response->assertOk();
        $response->assertViewIs('page.blacklist');
        $response->assertViewHas('clients');

        // TODO: perform additional assertions
    }

    /** @test */
    public function index_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $pages = \App\Models\Page::factory()->times(3)->create();

        $response = $this->get(route('pages.index'));

        $response->assertOk();
        $response->assertViewIs('page.index');
        $response->assertViewHas('pages', $pages);

        // TODO: perform additional assertions
    }

    /** @test */
    public function internal_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $internals = \App\Models\Internal::factory()->times(3)->create();

        $response = $this->get(route('internal'));

        $response->assertOk();
        $response->assertViewIs('page.internal');
        $response->assertViewHas('internals', $internals);

        // TODO: perform additional assertions
    }

    /** @test */
    public function show_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $page = \App\Models\Page::factory()->create();

        $response = $this->get(route('pages.show', ['id' => $page->id]));

        $response->assertOk();
        $response->assertViewIs('page.page');
        $response->assertViewHas('page', $page);

        // TODO: perform additional assertions
    }

    /** @test */
    public function staff_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $response = $this->get(route('staff'));

        $response->assertOk();
        $response->assertViewIs('page.staff');
        $response->assertViewHas('staff');

        // TODO: perform additional assertions
    }

    // test cases...
}
