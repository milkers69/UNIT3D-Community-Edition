<?php

namespace Tests\Feature\Http\Controllers\Staff;

use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Staff\BanController
 */
class BanControllerTest extends TestCase
{
    /** @test */
    public function index_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $bans = \App\Models\Ban::factory()->times(3)->create();

        $response = $this->get(route('staff.bans.index'));

        $response->assertOk();
        $response->assertViewIs('Staff.ban.index');
        $response->assertViewHas('bans', $bans);

        // TODO: perform additional assertions
    }

    /** @test */
    public function store_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $user = \App\Models\User::factory()->create();
        $privilege = \App\Models\Privilege::factory()->create();
        $role = \App\Models\Role::factory()->create();
        $ban = \App\Models\Ban::factory()->create();

        $response = $this->post(route('staff.bans.store', ['username' => $ban->username]), [
            // TODO: send request data
        ]);

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /** @test */
    public function update_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $user = \App\Models\User::factory()->create();
        $privilege = \App\Models\Privilege::factory()->create();
        $role = \App\Models\Role::factory()->create();
        $ban = \App\Models\Ban::factory()->create();

        $response = $this->post(route('staff.bans.update', ['username' => $ban->username]), [
            // TODO: send request data
        ]);

        $response->assertOk();

        // TODO: perform additional assertions
    }

    // test cases...
}
