<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Forum;
use App\Models\User;
use Database\Seeders\RolesTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ForumController
 */
class ForumControllerTest extends TestCase
{
    /** @test */
    public function index_returns_an_ok_response(): void
    {
        $this->seed(UsersTableSeeder::class);
        $this->seed(RolesTableSeeder::class);

        $user = User::factory()->create();

        $this->actingAs($user)->get(route('forums.index'))
            ->assertOk()
            ->assertViewIs('forum.index')
            ->assertViewHas('categories')
            ->assertViewHas('num_posts')
            ->assertViewHas('num_forums')
            ->assertViewHas('num_topics');
    }

    /** @test */
    public function latest_posts_returns_an_ok_response(): void
    {
        $this->seed(UsersTableSeeder::class);
        $this->seed(RolesTableSeeder::class);

        $user = User::factory()->create();

        $this->actingAs($user)->get(route('forum_latest_posts'))
            ->assertOk()
            ->assertViewIs('forum.latest_posts')
            ->assertViewHas('results')
            ->assertViewHas('user')
            ->assertViewHas('num_posts')
            ->assertViewHas('num_forums')
            ->assertViewHas('num_topics');
    }

    /** @test */
    public function latest_topics_returns_an_ok_response(): void
    {
        $this->seed(UsersTableSeeder::class);
        $this->seed(RolesTableSeeder::class);

        $user = User::factory()->create();

        $this->actingAs($user)->get(route('forum_latest_topics'))
            ->assertOk()
            ->assertViewIs('forum.latest_topics')
            ->assertViewHas('results')
            ->assertViewHas('user')
            ->assertViewHas('num_posts')
            ->assertViewHas('num_forums')
            ->assertViewHas('num_topics');
    }

    /** @test */
    public function search_topics_returns_an_ok_response(): void
    {
        $this->seed(UsersTableSeeder::class);
        $this->seed(RolesTableSeeder::class);

        $user = User::factory()->create();

        $this->actingAs($user)->get(route('forum_search_form'))
            ->assertOk()
            ->assertViewIs('forum.results_topics')
            ->assertViewHas('categories')
            ->assertViewHas('results')
            ->assertViewHas('user')
            ->assertViewHas('name')
            ->assertViewHas('body')
            ->assertViewHas('num_posts')
            ->assertViewHas('num_forums')
            ->assertViewHas('num_topics')
            ->assertViewHas('params');
    }

    /** @test */
    public function search_posts_returns_an_ok_response(): void
    {
        $this->seed(UsersTableSeeder::class);
        $this->seed(RolesTableSeeder::class);

        $user = User::factory()->create();

        $this->actingAs($user)->call('GET', route('forum_search_form', ['body' => 1]))
            ->assertOk()
            ->assertViewIs('forum.results_posts')
            ->assertViewHas('categories')
            ->assertViewHas('results')
            ->assertViewHas('user')
            ->assertViewHas('name')
            ->assertViewHas('body')
            ->assertViewHas('num_posts')
            ->assertViewHas('num_forums')
            ->assertViewHas('num_topics')
            ->assertViewHas('params');
    }

    /*public function show_category_returns_an_ok_response(): void
    {
        $this->seed(UsersTableSeeder::class);
        $this->seed(RolesTableSeeder::class);

        // This Forum has a parent Forum, which makes it a "Forum Category".

        $parentForum = Forum::factory()->create();

        $forum = Forum::factory()->create([
            'parent_id' => $parentForum->id,
        ]);

        $user = User::factory()->create();

        $this->actingAs($user)->get(route('forums.show', ['id' => $forum->id]))
            ->assertViewIs('forum.display')
            ->assertViewHas('forum')
            ->assertViewHas('topics')
            ->assertViewHas('category')
            ->assertViewHas('num_posts')
            ->assertViewHas('num_forums')
            ->assertViewHas('num_topics');
    }*/

    /** @test */
    public function show_forum_returns_an_ok_response(): void
    {
        $this->seed(UsersTableSeeder::class);
        $this->seed(RolesTableSeeder::class);

        // This Forum does not have a parent, which makes it a proper Forum
        // (and not a "Forum Category").

        $forum = Forum::factory()->create([
            'parent_id' => 0,
        ]);

        $user = User::factory()->create();

        $this->actingAs($user)->get(route('forums.show', ['id' => $forum->id]))
            ->assertRedirect(route('forums.categories.show', ['id' => $forum->id]));
    }

    /** @test */
    public function subscriptions_returns_an_ok_response(): void
    {
        $this->seed(UsersTableSeeder::class);
        $this->seed(RolesTableSeeder::class);

        $user = User::factory()->create();

        $this->actingAs($user)->get(route('forum_subscriptions'))
            ->assertOk()
            ->assertViewIs('forum.subscriptions')
            ->assertViewHas('results')
            ->assertViewHas('user')
            ->assertViewHas('name')
            ->assertViewHas('body')
            ->assertViewHas('num_posts')
            ->assertViewHas('num_forums')
            ->assertViewHas('num_topics')
            ->assertViewHas('params')
            ->assertViewHas('forum_neos')
            ->assertViewHas('topic_neos');
    }
}
